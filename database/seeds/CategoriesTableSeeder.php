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
        $category = new \App\Categories();
        $category->name = 'Main';
        $category->parent_id = 0;
        $category->type = 'main';
        $category->save();

        $category = new \App\Categories();
        $category->name = 'Default';
        $category->parent_id = 0;
        $category->type = 'main';
        $category->save();

        for ($i = 0; $i < 10; $i++) {
            $category = new \App\Categories();
            $category->name = 'Category main - ' . $i;
            $category->parent_id = 1;
            $category->type = 'category';
            $category->save();
        }

        for ($i = 0; $i < 10; $i++) {
            $category = new \App\Categories();
            $category->name = 'Category default - ' . $i;
            $category->parent_id = 2;
            $category->type = 'category';
            $category->save();
        }
    }
}