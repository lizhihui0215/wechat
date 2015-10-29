<?php
namespace App\Repositories;

use App\Models\User;
use App\Models\Role;
use App\Models\UserProfile;
/**
*
*/
class UserRepository extends BaseRepository
{
  /**
  * The Role instance.
  *
  * @var App\Models\Role
  */
  protected $role;


  /**
  * Create a new UserRepository instance.
  *
  * @param  App\Models\User $user
  * @param  App\Models\Role $role
  * @return void
  */
  public function __construct(
  User $user,
  Role $role)
  {
    $this->model = $user;
    $this->role = $role;
  }

  private function save($user, $inputs)
  {
    if(isset($inputs['seen']))
    {
      $user->seen = $inputs['seen'] == 'true';
    } else {

      $user->username = $inputs['username'];
      $user->email = $inputs['email'];

      if(isset($inputs['role'])) {
        $user->role_id = $inputs['role'];
      } else {
        $role_user = $this->role->where('slug', 'user')->first();
        $user->role_id = $role_user->id;
      }
    }
    
    $user->save();
    $user_profile = new UserProfile;
    $user_profile->user()->associate($user);
    $user_profile->save();
  }

  public function store($inputs, $confirmation_code = null)
  {
    $user = new $this->model;
    $user->password = bcrypt($inputs['password']);
    if($confirmation_code) {
      $user->confirmation_code = $confirmation_code;
    } else {
      $user->confirmed = true;
    }

    $this->save($user, $inputs);

    return $user;
  }

  /**
	 * Confirm a user.
	 *
	 * @param  string  $confirmation_code
	 * @return App\Models\User
	 */
	public function confirm($confirmation_code)
	{
		$user = $this->model->whereConfirmationCode($confirmation_code)->firstOrFail();

		$user->confirmed = true;
		$user->confirmation_code = null;
		$user->save();
	}


}


?>
