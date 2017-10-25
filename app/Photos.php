<?php
/**
 * Created by PhpStorm.
 * User: kzzqqut
 * Date: 10/26/17
 * Time: 3:10 AM
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photos extends Model
{
    public function object() {
        return $this->belongsTo('App\Objects');
    }
}