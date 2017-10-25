<?php
/**
 * Created by PhpStorm.
 * User: kzzqqut
 * Date: 10/26/17
 * Time: 4:45 AM
 */

namespace App\Http\Controllers;

use App\Categories;
use App\Objects;

class PagesController extends Controller {

    public function index($cat = null) {

        $pages = 8;

        if (!empty($cat)) {

            $category = Categories::find($cat);
            if (!empty($category)) {
                switch ($category->type) {
                    case 'main' :
                        $objects = Objects::where('main_id', $cat)->paginate($pages);
                        break;
                    case 'category' :
                        $objects = Objects::where('category_id', $cat)->paginate($pages);
                        break;
                    case 'subcategory' :
                        $objects = Objects::where('subcategory_id', $cat)->paginate($pages);
                        break;
                    default:
                        $objects = Objects::paginate($pages);
                        break;
                }

            } else {
                return redirect()->route('index');
            }


        } else {
            $objects = Objects::paginate($pages);
        }

        return $this->getIndexResult($objects);


    }

    private function getIndexResult($objects) {

        return view('index', ['objects' => $objects]);
    }

}