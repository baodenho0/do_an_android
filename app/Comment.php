<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = "comment";

    protected $fillable = [
        'id',
        'user_id',
        'news_id',
        'content',
        'created_at',
        'updated_at',
    ];

    protected $guarded = [];

    public function saveComment($userId, $newsId, $content){
        $arr = [
            "user_id" => $userId,
            "news_id" => $newsId,
            "content" => $content
        ];

        return self::create($arr);
    }

    public function getCommentByNewsId($newsId){
        // dd($newsId);
        return self::select("news_id","name","content","user_id")
                    ->where("news_id",$newsId)
                    ->join("users","user_id","users.id")
                    ->orderBy("comment.id","desc")
                    ->get();
    }


}
