<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "category";

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

    public static function getByWebsiteId($websiteId){
        return self::select('id','website_id','name','image')
                    ->where('website_id',$websiteId)
                    ->where('status',1)
                    ->get();
    }
}
