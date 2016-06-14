<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class DrugModel extends Model
{
    //
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tpoly_drugs';
    
    protected $primaryKey="ID";
    protected $guarded = ['ID'];
    public $timestamps = false;
     
     
}
