<?php
/**
 * Created by PhpStorm.
 * User: kzzqqut
 * Date: 10/25/17
 * Time: 8:53 PM
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    public function categoriesTree(array $categories, $parentId = 0) {

        $branch = array();

        foreach ($categories as $element) {
            if ($element['parent_id'] == $parentId) {
                $children = $this->categoriesTree($categories, $element['id']);
                if ($children) {
                    $element['children'] = $children;
                }
                $branch[] = $element;
            }
        }

        return $branch;

    }
}