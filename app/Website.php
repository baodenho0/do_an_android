<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Website extends Model
{
    protected $table = "website";

    protected $fillable = [
        'id',
        'name',
        'url',
        'image',
        'status',
        'created_at',
        'updated_at',
    ];

    protected $guarded = [];

    public static function get(){
        return self::select('id','name','url','image')
                    ->where('status',1)
                    ->get();
    }
}
