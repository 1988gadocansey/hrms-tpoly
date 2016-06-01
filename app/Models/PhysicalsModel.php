<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class PhysicalsModel extends Model
{
    //
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tpoly_physicals';
    
    protected $primaryKey="ID";
    protected $guarded = ['ID'];
    
     
}
