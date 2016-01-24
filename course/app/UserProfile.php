<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model {

	protected $table = 'user_profiles';//Si cumple con la convención, no es necesario

	public function getAgeAttribute(){

		return \Carbon\Carbon::parse($this->birthdate)->age;

	}

}
