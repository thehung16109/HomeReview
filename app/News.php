<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = [
        'news_title', 'news_slug', 'news_desc', 'news_content', 'news_images', 'news_tags', 
        'news_status', 'admin_id', 'created_at', 'updated_at', 'view_count', 'like_count'
    ];
    protected $primaryKey = 'news_id';
    protected $table = 'tbl_news';

    public function admin(){
        return $this->belongsTo('App\Admin', 'admin_id'); //1 tin tức do 1 admin đăng bài
    }

    public function comment(){
        return $this->hasMany('App\Comment', 'review_id'); //1 tin tức có nhiều bình luận
    }  
}
