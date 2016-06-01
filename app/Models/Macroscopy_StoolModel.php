<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Macroscopy_StoolModel extends Model
{
    //
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tpoly_macroscopy_stool';
    
    protected $primaryKey="ID";
    protected $guarded=array ('ID');
    
}
