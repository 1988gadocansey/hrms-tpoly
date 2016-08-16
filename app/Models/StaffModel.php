<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class StaffModel extends Model
{
    //
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tpoly_workers';
    
    protected $primaryKey="ID";
    protected $guarded = ['ID'];
    public $timestamps = false;
    public function department(){
        return $this->belongsTo('App\Models\DepartmentModel::', "department","id");
    }
    
}
