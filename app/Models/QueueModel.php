<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class QueueModel extends Model
{
    //
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tpoly_hrm_patientque';
    
    protected $primaryKey="ID";
    protected $guarded = ['ID'];
    public $timestamps = false;
    public function patient(){
        return $this->belongsTo('App\Models\PatientModel', "PATIENT","hospital_id");
    }
    public function doctor(){
        return $this->belongsTo('App\Models\WorkersModel', "DOCTOR","id");
    }
    
}
