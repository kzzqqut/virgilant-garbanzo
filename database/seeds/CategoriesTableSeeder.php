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
        for ($i = 0; $i < 10; $i++) {
            $category = new \App\Categories();
            $category->name = 'Category Parent - ' . $i;
            $category->parent_id = 0;
            $category->type = 'main';
            $category->save();
            $id = $category->id;
            if ($i == 1 || $i == 4 || $i == 7) {
                for ($j = 0; $j < 10; $j++) {
                    $category = new \App\Categories();
                    $category->name = 'Category Child - ' . $j;
                    $category->parent_id = $id;
                    $category->type = 'category';
                    $category->save();
                    $id2 = $category->id;
                    if ($j == 1 || $j == 4 || $j == 7) {
                        for ($k = 0; $k < 10; $k++) {
                            $category = new \App\Categories();
                            $category->name = 'Category Grandchild - ' . $k;
                            $category->parent_id = $id2;
                            $category->type = 'subcategory';
                            $category->save();
                        }

                    }
                }
            }
        }
    }
}