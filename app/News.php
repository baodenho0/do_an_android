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
        'content',
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

    public function saveArrCheckUnique($websiteId, $categoryId, $arr){
        $i = 0;
        foreach ($arr as $value) {
            try {
                $arrSave = [
                    'website_id' => $websiteId,
                    'category_id' => $categoryId,
                    'title' => $value['title'],
                    'url' => $value['url'],
                    'short_content' => $value['short_content'] ?? '',
                    'content' => $value['content'] ?? '',
                    'image' => $value['image'],
                ];

                self::insert($arrSave);
                $i++;

            } catch (\Exception $e) {
                \Log::info($value['url']." have been taken");
                continue;
            }
        }
        return $i;
    }


}
