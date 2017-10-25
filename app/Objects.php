<?php
/**
 * Created by PhpStorm.
 * User: kzzqqut
 * Date: 10/25/17
 * Time: 8:53 PM
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class Objects extends Model
{
    public function photos() {
        return $this->hasMany('App\Photos','object_id');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }
}