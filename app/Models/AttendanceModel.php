<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class AttendanceModel extends Model
{
    //
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tpoly_hrms_attendance';
    
    protected $primaryKey="ID";
    protected $guarded = ['ID'];
    public $timestamps = false;
    public function patient(){
        return $this->belongsTo('App\Models\PatientModel', "patient","hospital_id");
    }
    public function doctor(){
        return $this->belongsTo('App\User', "user","id");
    }
    
}
