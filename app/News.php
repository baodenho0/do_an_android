<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = "news";

    protected $fillable = [
        'id',
        'website_id',
        'category_id',
        'title',
        'url',
        'short_content',
        'image',
        'created_at',
        'updated_at',
        'status',
    ];

    protected $guarded = [];

    public static function getByWebsiteIdAndCategoryId($websiteId,$categoryId){
        return self::select('id','website_id','category_id','title','url','short_content','image')
                    ->where('website_id',$websiteId)
                    ->where('category_id',$categoryId)
                    ->where('status',1)
                    ->get();
    }
}
