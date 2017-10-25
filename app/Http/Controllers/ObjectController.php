<?php
/**
 * Created by PhpStorm.
 * User: kzzqqut
 * Date: 10/25/17
 * Time: 9:08 PM
 */

namespace App\Http\Controllers;

use App\Photos;
use App\Objects;
use App\Currencies;
use App\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class ObjectController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'isVerified']);
        //isAdmin middleware lets only users with a //specific permission to access these resources
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $objects = Auth::user()->objects()->paginate(5);

        return view('objects.index',['objects' => $objects]);
    }

    public function manage($id = null) {

        $objectSession = session('object');

        if (!empty($id)) {

            $object = Objects::findOrFail($id);
            //if (empty($object->id))

            if (!empty($objectSession->id) && $object->id != $objectSession->id) {
                session(['object' => null]);
            } elseif (!empty($objectSession->id) && $object->id == $objectSession->id) {
                $object->main_id = $objectSession->main_id;
                $object->category_id = $objectSession->category_id;
                $object->subcategory_id = $objectSession->subcategory_id;

            }

            session(['object' => $object]);

        } else {
            $object = new Objects();
            if (!empty($objectSession->main_id)) {
                $object->main_id = $objectSession->main_id;
            }
            if (!empty($objectSession->category_id)) {
                $object->category_id = $objectSession->category_id;
            }
            if (!empty($objectSession->subcategory_id)) {
                $object->subcategory_id = $objectSession->subcategory_id;
            }
            session(['object' => $object]);
        }

        if (empty($object)) {
            $object = new Objects();
        }

        //dd($object);
        //dd($objectSession);

        $subcategory = null;
        if (!empty($object->subcategory_id)) {
            $subcategory = Categories::find($object->subcategory_id);
        }


        $category = null;
        if (!empty($object->category_id)) {
            $category = Categories::find($object->category_id);
        }

        $mainCategory = null;
        if (!empty($object->main_id)) {
            $mainCategory = Categories::find($object->main_id);
        }

        $currencies = Currencies::all();


        return view('objects.create_edit',[
            'object' => $object,
            'subcategory' => $subcategory,
            'category' => $category,
            'mainCategory' => $mainCategory,
            'currencies' => $currencies
        ]);

    }

    public function postManage(Request $request, $id = null) {

        $objectSession = $request->session()->get('object');

        if (empty($objectSession->main_id) || empty($objectSession->category_id) || empty($objectSession->subcategory_id)) {
            return redirect()->back()->with(['error' => 'Please select category']);
        }

        $this->validate($request,[
            'name' => 'required|min:6|max:120',
            'description' => 'required',
            'price' => 'required|numeric|between:0,999.99',
            'currency_id' => 'required',
            'photo.*' => 'image|mimes:jpeg,jpg,png,gif,bmp'
        ]);


        $object = null;
        if (!empty($id)) {
            $object = Objects::findOrFail($id);
        } else {
            $object = new Objects();
        }



        $object->main_id = $objectSession->main_id;
        $object->category_id = $objectSession->category_id;
        $object->subcategory_id = $objectSession->subcategory_id;

        $object->user_id = Auth::user()->id;
        $object->name = $request['name'];
        $object->description = $request['description'];
        $object->price = $request['price'];
        $object->currency_id = $request['currency_id'];
        $object->save();

        if ($request->hasFile('photo')) {


            $files = $request->file('photo');
            $i = 0;
            foreach ($files as $file) {

                $object->load('photos');

                if ($i > 4 || count($object->photos) > 4) {
                    break;
                }

                $image = Image::make($file);
                $thImage = Image::make($file);

                $image->fit(320,320);
                $nameImg = uniqid() . '.' . $file->extension();

                $image->save(public_path('images/'.$nameImg));

                $thName = 'th_' . $nameImg;
                $thImage->fit(100,100);
                $thImage->save(public_path('images/'.$thName));

                $photo = new Photos();
                $photo->object_id = $object->id;
                $photo->name = $nameImg;
                $photo->th_name = $thName;
                if ($i == 0) {
                    $photo->is_main = 1;
                }

                $photo->save();
                $i++;
            }


        }

        $request->session()->put('object', $object);

        $message = 'Object saved successfully!';

        return redirect()->route('objects.manage',['id' => $object->id])->with(['success' => $message]);

    }

    public function postCategory(Request $request) {

        $object = $request->session()->get('object');
        if (empty($object)) {
            $object = new Objects();
        }

        if (!empty($request['main'])) {
            $object->main_id = $request['main'];
            $object->category_id = null;
            $object->subcategory_id = null;
        }
        if (!empty($request['category'])) {
            $object->category_id = $request['category'];
            $object->subcategory_id = null;

        }
        if (!empty($request['subcategory'])) {
            $object->subcategory_id = $request['subcategory'];
        }

        $request->session()->put('object', $object);

        if (!empty($object->id)) {
            return redirect()->route('objects.manage',['id' => $object->id]);
        }

        return redirect()->route('objects.manage');
    }

    public function changeCategory($type) {

        $object = session('object');

        if (!empty($object)) {
            switch ($type) {
                case 'main' :
                    $object->main_id = null;
                    $object->category_id = null;
                    $object->subcategory_id = null;
                    break;
                case 'category' :
                    $object->category_id = null;
                    $object->subcategory_id = null;
                    break;
                case 'subcategory' :
                    $object->subcategory_id = null;
                    break;
            }
            session(['object' => $object]);

            if (!empty($object->id)) {
                return redirect()->route('objects.manage',['id' => $object->id]);
            }

            return redirect()->route('objects.manage');

        } else {
            return redirect()->route('objects.manage')->with(['error' => 'Nothing for change. Contact Administrator']);
        }

    }

    public function photoRemove($id) {

        $photo = Photos::findOrFail($id);
        if (!empty($photo->object) && !empty($photo->object->user) && ($photo->object->user->id == Auth::user()->id)) {
            unlink(public_path() .'/images/' . $photo->name);
            unlink(public_path() .'/images/' . $photo->th_name);
            $photo->forceDelete();
            return redirect()->route('objects.manage',['id' => $photo->object->id])->with(['success' => 'Photo removed']);
        }

        return redirect()->back();

    }

    public function destroy($id) {

        //Find a user with a given id and delete
        $object = Objects::findOrFail($id);
        $object->delete();

        return redirect()->route('objects.index')->with('success','Object successfully deleted.');
    }
}