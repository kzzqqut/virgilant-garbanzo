<?php
/**
 * Created by PhpStorm.
 * User: kzzqqut
 * Date: 10/26/17
 * Time: 5:00 AM
 */

use Illuminate\Database\Seeder;

class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $type = new \App\Types();
        $type->name = 'Small';
        $type->save();

        $type = new \App\Types();
        $type->name = 'Normal';
        $type->save();

        $type = new \App\Types();
        $type->name = 'Large';
        $type->save();
    }
}