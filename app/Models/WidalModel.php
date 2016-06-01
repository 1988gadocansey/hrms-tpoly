<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class WidalModel extends Model
{
    //
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tpoly_widal';
    
    protected $primaryKey="ID";
    protected $guarded=array ('ID');
    
}
