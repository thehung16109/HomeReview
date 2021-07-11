<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'customer_last_name', 'customer_first_name', 'customer_email', 'customer_password', 'customer_avatar', 'code', 'time_code', 'created_at', 'updated_at'
    ];
    protected $primaryKey = 'customer_id';
    protected $table = 'tbl_customer';

    public function comment(){
        return $this->hasMany('App\Comment', 'customer_id'); //1 bài viết có nhiều bình luận
    }  
}
