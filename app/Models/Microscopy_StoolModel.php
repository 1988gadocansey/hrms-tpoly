<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Microscopy_StoolModel extends Model
{
    //
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tpoly_microscopy_stool';
    
    protected $primaryKey="ID";
    protected $guarded=array ('ID');
    
}
