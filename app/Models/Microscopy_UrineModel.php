<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Microscopy_UrineModel extends Model
{
    //
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tpoly_microscopy_urine';
    
    protected $primaryKey="ID";
    protected $guarded=array ('ID');
    
}
