<?php
/**
 * Created by PhpStorm.
 * User: kzzqqut
 * Date: 10/25/17
 * Time: 9:12 PM
 */

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new \App\User();
        $user->name = 'admin';
        $user->email = 'admin@example.org';
        $user->password = bcrypt('qwerty13');
        $user->plain = 'qwerty13';
        $user->save();
    }
}