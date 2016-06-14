<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class PrescriptionModel extends Model
{
    //
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tpoly_prescription';
    
    protected $primaryKey="ID";
    protected $guarded = ['ID'];
    public $timestamps = false;
   public function doctor(){
        return $this->belongsTo('App\User', "doctor_id","id");
    }
     public function drugName(){
        return $this->belongsTo('App\Models\DrugModel', "drug","ID");
    }
}
