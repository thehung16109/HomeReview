<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LikeStatus extends Model
{
    protected $fillable = [
        'custome_id', 'review_id', 'news_id', 'like_status', 'created_at', 'updated_at'
    ];
    protected $primaryKey = 'like_id';
    protected $table = 'tbl_like_status';

    public function review(){
        return $this->hasMany('App\Review', 'review_id'); 
    }
}
