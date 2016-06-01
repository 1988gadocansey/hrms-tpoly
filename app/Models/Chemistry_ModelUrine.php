<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Chemistry_ModelUrine extends Model
{
    //
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tpoly_chemistry_urine';
    
    protected $primaryKey="ID";
    protected $guarded=array ('ID');
    
}
