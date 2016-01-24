<?php namespace App\Http\Controllers;

use App\User;

class UsersController extends Controller {

	public function getOrm(){

		$users=User::select('id','first_name')
		->with('profile')
		->where('first_name','<>','Duilio')
		->orderBy('first_name','ASC')
		->get();

		dd($users->toArray());
	}


	public function getIndex()
	{
		$result = \DB::table('users')
			->select(
				'users.*',
				'user_profiles.id as profile_id',
				'user_profiles.twitter'
			)
			->orderBy('id','ASC')
			->leftJoin('user_profiles','users.id','=','user_profiles.user_id')
			->get();

		dd($result);

		return $result;
	}
}
