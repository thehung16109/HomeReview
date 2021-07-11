<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'category_name', 'category_slug', 'category_status', 'created_at', 'updated_at'
    ];
    protected $primaryKey = 'category_id';
    protected $table = 'tbl_category';

    public function review(){
        return $this->hasMany('App\Review', 'category_id'); //1 danh mục có nhiều bài viết
    }
}
