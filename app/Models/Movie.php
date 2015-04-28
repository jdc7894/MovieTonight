<?php
/**
 * Created by PhpStorm.
 * User: daecheol
 * Date: 4/28/15
 * Time: 12:10 AM
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model {

    public function visitor()
    {
        return $this->belongsTo('App\Models\Visitor', 'visitors', 'id');
    }
}