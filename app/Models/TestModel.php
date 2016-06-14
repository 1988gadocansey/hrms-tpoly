<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class TestModel extends Model
{
    //
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tpoly_tests';
    
    protected $primaryKey="id";
    protected $guarded = ['id'];
    public $timestamps = false;
     
     
}
