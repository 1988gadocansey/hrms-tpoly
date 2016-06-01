<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class LabModel extends Model
{
    //
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tpoly_lab';
    
    protected $primaryKey="ID";
    protected $guarded = ['ID'];
    public $timestamps = false;
     
}
