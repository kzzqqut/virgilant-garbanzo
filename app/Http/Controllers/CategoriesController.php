<?php
/**
 * Created by PhpStorm.
 * User: kzzqqut
 * Date: 10/25/17
 * Time: 9:35 PM
 */

namespace App\Http\Controllers;

use App\Categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'isAdmin']);
        //isAdmin middleware lets only users with a //specific permission to access these resources
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categoriesList = Categories::all()->toArray();
        $categories = Categories::categoriesTree($categoriesList);

        return view('admin.categories.index')->with('categories', $categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categoriesList = Categories::all()->toArray();
        $categories = Categories::categoriesTree($categoriesList);

        return view('admin.categories.create',['categories' => $categories]);
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
            'name' => 'required|min:4',
            'parent_id' => 'required'
        ]);

        $parentCategory = Categories::findOrFail($request['parent_id']);
        if ($parentCategory->parent_id == 0) {
            $type = 'category';
        } else {
            $type = 'subcategory';
        }

        $category = new Categories();
        $category->parent_id = $parentCategory->id;
        $category->name = $request['name'];
        $category->type = $type;
        $category->save();

        //Redirect to the categories.index view and display message
        return redirect()->route('categories.index')->with('success','Category successfully added.');



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect('categories');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categoryData = Categories::findOrFail($id); //Get category with specified id
        $categoriesList = Categories::all()->except($categoryData->id)->toArray();
        $categories = Categories::categoriesTree($categoriesList);

        return view('admin.categories.edit', compact('categoryData','categories')); //pass category data to view
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
        $category = Categories::findOrFail($id);

        $this->validate($request, [
            'name'=>'required|min:4|max:120',
        ]);


        if ($category->type != 'main') {

            $parentCategory = Categories::findOrFail($request['parent_id']);

            if ($parentCategory->parent_id == 0) {
                $type = 'category';
            } else {
                $type = 'subcategory';
            }
            $category->parent_id = $parentCategory->id;
            $category->type = $type;
        }


        $category->name = $request['name'];

        $category->save();

        return redirect()->route('categories.index')->with('success','Category successfully edited.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Categories::findOrFail($id);
        $category->delete();

        return redirect()->route('categories.index')->with('success','Category successfully deleted.');
    }
}