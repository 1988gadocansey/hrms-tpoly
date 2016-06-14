<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class VitalsModel extends Model
{
    //
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tpoly_hrms_vitals';
    
    protected $primaryKey="ID";
    protected $guarded = ['ID'];
    public $timestamps = false;
     
}
