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
     
}
