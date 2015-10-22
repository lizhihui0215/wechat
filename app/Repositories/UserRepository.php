<?php
namespace App\Repositories;

use App\Models\User;

/**
 *
 */
class UserRepository extends BaseRepository
{

  function __construct(User $user)
  {
    $this->model = $user;
  }

  private function save($user, $inputs)
  {
    if (isset($inputs['seen'])) {
      $user->seen = $['seen'] == 'true';
    }else {
      $user->username = $inputs['username'];
      $user->email = $inputs['email'];

      $user->save();
    }
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


}


 ?>
