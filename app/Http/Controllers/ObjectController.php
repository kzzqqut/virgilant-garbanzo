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

    public function step1() {

        $object = session('object');
        if (empty($object)) {
            $object = new Objects();
        }


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


        return view('objects.step1',['subcategory' => $subcategory,'category' => $category, 'mainCategory' => $mainCategory]);

    }

    public function postStep1(Request $request) {

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

        return redirect()->route('objects.step1');
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

            return redirect()->route('objects.step1');

        } else {
            return redirect()->route('objects.step1')->with(['error' => 'Nothing for change. Contact Administrator']);
        }



    }


    public function step2()
    {
        $currencies = Currencies::all();
        return view('objects.step2',compact('currencies'));
    }

    public function postStep2($id = null) {
        return redirect()->route('objects.step2');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|min:6|max:120',
            'description' => 'required',
            'price' => 'required|numeric|between:0,999.99',
            'currency_id' => 'required'
        ]);

        $category = Categories::findOrFail($request['category_id']);

        $object = new Objects();
        $object->user_id = Auth::user()->id;
        $object->name = $request['name'];
        $object->description = $request['description'];
        $object->price = $request['price'];
        $object->currency_id = $request['currency_id'];

        if ($category->parent_id == 0 && $category->type == 'main') {
            $object->main_id = $category->id;
        } elseif ($category->type == 'category') {
            $object->category_id = $category->id;
            $mainCategory = Categories::findOrFail($category->parent_id);
            $object->main_id = $mainCategory->id;

        } elseif ($category->type == 'subcategory') {
            $catCategory = Categories::findOrFail($category->parent_id);
            $object->category_id = $catCategory->id;
            $mainCategory = Categories::findOrFail($catCategory->parent_id);
            $object->main_id = $mainCategory->id;
            $object->subcategory_id = $category->id;
        }

        $object->save();

        return redirect()->route('objects.index')->with(['success' => 'Object added successfully!']);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        echo 'show';
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function choseCategory(Request $request) {
        //
    }
}