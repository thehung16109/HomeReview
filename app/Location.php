<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = [
        'location_name', 'location_slug', 'region_id', 'location_status', 'created_at', 'updated_at'
    ];
    protected $primaryKey = 'location_id';
    protected $table = 'tbl_location';

    public function region(){
        return $this->belongsTo('App\Region', 'region_id'); //1 địa điểm thuộc 1 vùng
    }

    public function review(){
        return $this->hasMany('App\Review', 'location_id'); //1 địa điểm có nhiều bài viết
    }
}
