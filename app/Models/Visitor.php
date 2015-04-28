<?php
/**
 * Created by PhpStorm.
 * User: daecheol
 * Date: 4/27/15
 * Time: 11:58 PM
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Validator;

class Visitor extends Model {
    public static function validate($input)
    {
        return Validator::make($input, [
           'name'=> 'required'
        ]);
    }
    public function movie()
    {
        return $this->hasMany('App\Models\Movie');
    }

}