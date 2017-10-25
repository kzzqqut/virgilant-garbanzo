<?php
/**
 * Created by PhpStorm.
 * User: kzzqqut
 * Date: 10/25/17
 * Time: 8:58 PM
 */

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 3; $i++) {
            $category = new \App\Categories();
            $category->name = 'Category Parent - ' . $i;
            $category->parent_id = 0;
            $category->type = 'main';
            $category->save();
            $id = $category->id;

            for ($j = 1; $j <= 3; $j++) {
                $category = new \App\Categories();
                $category->name = 'Category Child - ' . $i .' - ' .$j;
                $category->parent_id = $id;
                $category->type = 'category';
                $category->save();
                $id2 = $category->id;
                for ($k = 1; $k <= 3; $k++) {
                    $category = new \App\Categories();
                    $category->name = 'Grandchild - ' . $i . ' - ' . $j . ' - ' . $k;
                    $category->parent_id = $id2;
                    $category->type = 'subcategory';
                    $category->save();
                }
            }
        }
    }
}