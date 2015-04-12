<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class PermExp extends Model
{

    protected $table = 'perm_exps';

    protected $fillable = [
        'title',
        'amount',
        'availability'
    ];

    public static $rules = [
        'title' => 'required|min:3|max:64',
        'amount' => 'required|numeric'
    ];

}
