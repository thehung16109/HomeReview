<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $fillable = [
        'region_name', 'region_slug', 'region_status'
    ];
    protected $primaryKey = 'region_id';
    protected $table = 'tbl_region';
    

    public function location(){
        return $this->hasMany('App\Location', 'location_id'); //1 vùng có nhiều địa điểm
    }    
}
