<?php
/**
 * Created by PhpStorm.
 * User: kzzqqut
 * Date: 10/25/17
 * Time: 10:35 PM
 */

use Illuminate\Database\Seeder;

class CurrenciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currency = new \App\Currencies();
        $currency->name = 'JPY';
        $currency->symbol = '¥';
        $currency->save();

        $currency = new \App\Currencies();
        $currency->name = 'USD';
        $currency->symbol = '$';
        $currency->save();

        $currency = new \App\Currencies();
        $currency->name = 'EUR';
        $currency->symbol = '€';
        $currency->save();
    }
}