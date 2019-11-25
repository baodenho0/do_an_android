<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $table = "activity";

    protected $fillable = [
        'id',
        'user_id',
        'news_id',
        'created_at',
        'updated_at',
    ];

    protected $guarded = [];

    public function saveActivity($userId,$newsId){
        $arr = [
            'user_id' => $userId,
            'news_id' => $newsId
        ];

        return self::create($arr);
    }

    public function getByUserId($userId){
        return self::select(
            "activity.id as activity_id",
            "news_id",
            "title",
            "activity.created_at as created_at"
        )
        ->where("user_id",$userId)
        ->join("news","news.id","news_id")
        ->orderBy("activity.id","desc")
        ->get();
    }


}
