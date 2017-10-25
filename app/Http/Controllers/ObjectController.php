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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $main = Categories::where('parent_id',1)->get()->pluck('name','id')->toArray();
        $default = Categories::where('parent_id',2)->get()->pluck('name','id')->toArray();
        $currencies = Currencies::all()->pluck('name','id');

        return view('objects.create',['main' => $main,'default' => $default,'currencies' => $currencies]);
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
        //
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
}