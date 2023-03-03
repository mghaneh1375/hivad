<?php

namespace App\models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * An Eloquent Model: 'User'
 *
 * @property integer $id
 * @property integer $sex
 * @property integer $creator
 * @property integer $status
 * @property integer $level
 * @property string $username
 * @property string $password
 * @property string $first_name
 * @property string $phone_num
 * @property string $nid
 * @property string $last_name
 * @property int $city_id
 * @property string $img
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereUsername($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereNid($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereLevel($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User wherePhoneNum($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereCreator($value)
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @mixin \Eloquent
 */

class User extends Authenticatable{

	use Notifiable;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */


	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */

	protected $fillable = [
		'first_name', 'last_name', 'password', 'phone'
	];

	protected $hidden = array('password', 'remember_token');

	public function getRememberToken()
	{
		return $this->remember_token;
	}

	public function setRememberToken($value)
	{
		$this->remember_token = $value;
	}

	public function getRememberTokenName()
	{
		return 'remember_token';
	}

	public function getAuthIdentifier() {
		return $this->getKey();
	}
	public function getAuthPassword() {
		return $this->password;
	}

	public static function whereId($value) {
		return User::find($value);
	}
}
