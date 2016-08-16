<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class LabModel extends Model
{
    //
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tpoly_lab';
    
    protected $primaryKey="ID";
    protected $guarded = ['ID'];
    public $timestamps = false;
   public function doctor(){
        return $this->belongsTo('App\User', "CLINICIAN","id");
    }
     public function testName(){
        return $this->belongsTo('App\Models\TestModel', "TEST","ID");
    }
     public function student(){
        return $this->belongsTo('App\Models\StudentModel', "PATIENT","INDEXNO");
    }
}
