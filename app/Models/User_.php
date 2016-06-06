<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class UserModel extends Model
{
    //
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';
    
    protected $primaryKey="ID";
    protected $guarded=array ('ID');
    
}
