<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $table = "rating";

    protected $fillable = [
        'id',
        'user_id',
        'news_id',
        'rate',
        'created_at',
        'updated_at',
    ];

    protected $guarded = [];

    // public function saveRating($userId, $newsId, $rate){
    //     $arr = [
    //         "user_id" => $userId,
    //         "news_id" => $newsId,
    //         "rate" => $rate
    //     ];

    //     return self::create($arr);
    // }

    public function getByNewId($newsId){
        return self::where("news_id",$newsId)
                    ->get();
    }

    public function getByUserIdAndNewsId($userId, $newsId){
        return self::where("news_id",$newsId)
                    ->where("user_id",$userId)
                    ->first();
    }   

    public function updateRating($rating,$newsId,$userId){
        // dd('df');
        $data = self::getByUserIdAndNewsId($userId, $newsId);
        // echo $rating; die;
        $arr = [
                'user_id' => $userId,
                'news_id' => $newsId,
                'rate' => $rating
        ];


        if($data){
            self::where("id",$data->id)->update($arr);
        } else {
            
            self::create($arr);
        }
        return "updated successfully";
    }


}
