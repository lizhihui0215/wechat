<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    /**
     *  The database table used by the model.
     *  @var string
     */
    protected $table = 'user_profile';


    protected $fillable = ['user_id', 'email', 'password'];
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
