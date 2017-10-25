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

    public function currency() {
        return $this->belongsTo('App\Currencies');
    }

    public function mainCategory() {
        return $this->belongsTo('App\Categories','main_id');
    }

    public function category() {
        return $this->belongsTo('App\Categories','category_id');
    }

    public function subcategory() {
        return $this->belongsTo('App\Categories','subcategory_id');
    }

    public function mainPhoto() {
        return $this->hasOne('App\Photos','object_id')->where('is_main',1);
    }

    public function type() {
        return $this->belongsTo('App\Types');
    }
}