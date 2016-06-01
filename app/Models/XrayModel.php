<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class XrayModel extends Model
{
    //
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tpoly_xray';
    
    protected $primaryKey="ID";
    protected $guarded=array ('ID');
    
}
