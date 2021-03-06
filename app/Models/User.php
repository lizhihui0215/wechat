<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
  	 * One to Many relation
  	 *
  	 * @return Illuminate\Database\Eloquent\Relations\BelongsTo
  	 */
  	public function role()
  	{
  		return $this->belongsTo('App\Models\Role');
  	}

    public function profile()
    {
        return $this->hasOne('App\Models\UserProfile');
    }

    public function followersRelationships()
    {
        return $this->hasMany('App\Models\FollowerRelationship');
    }

    public function followedRelationships()
    {
        return $this->hasMany('App\Models\FollowedRelationship');
    }


}
