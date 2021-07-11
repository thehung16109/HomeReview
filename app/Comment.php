<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'comment_content', 'comment_status', 'review_id', 'customer_id', 'created_at', 'updated_at'
    ];
    protected $primaryKey = 'comment_id';
    protected $table = 'tbl_comment';

    public function review(){
        return $this->belongsTo('App\Review', 'review_id'); //1 bình luận cho 1 bài viết
    }

    public function customer(){
        return $this->belongsTo('App\Customer', 'customer_id'); //1 bình luận của 1 khách hàng
    }
}
