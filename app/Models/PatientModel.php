<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class PatientModel extends Model
{
    //
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tpoly_hrms_patient';
    
    protected $primaryKey="id";
    protected $guarded = ['id'];
    public $timestamps = false;
     
}
