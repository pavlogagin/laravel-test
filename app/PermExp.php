<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class PermExp extends Model
{

    protected $fillable = [
        'title',
        'amount',
        'availability'
    ];

}
