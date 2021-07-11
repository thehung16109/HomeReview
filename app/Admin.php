<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $fillable = [
        'admin_last_name', 'admin_first_name', 'admin_email', 'admin_password', 'admin_phone', 'admin_avatar', 'created_at', 'updated_at'
    ];
    protected $primaryKey = 'admin_id';
    protected $table = 'tbl_admin';

    public function review(){
        return $this->hasMany('App\Review', 'addmin_id'); //1 admin đăng nhiều bài viết
    }
}
