<?php
/**
 * Created by PhpStorm.
 * User: kzzqqut
 * Date: 10/25/17
 * Time: 9:08 PM
 */

namespace App\Http\Controllers;

use App\Currencies;
use App\Objects;
use Illuminate\Http\Request;
use App\Categories;
use Illuminate\Support\Facades\Auth;

class ObjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            'currency_id' => 'required'
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

    public function changeCategory($type)
    {

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
                return redirect()->route('objects.manage', ['id' => $object->id]);
            }

            return redirect()->route('objects.manage');

        } else {
            return redirect()->route('objects.manage')->with(['error' => 'Nothing for change. Contact Administrator']);
        }
    }
}