<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class HeamatologyModel extends Model
{
    //
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tpoly_heamatology';
    
    protected $primaryKey="ID";
    protected $guarded=array ('ID');
    
}
