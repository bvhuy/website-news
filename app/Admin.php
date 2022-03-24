<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
class Admin extends Authenticatable
{
	use Notifiable;
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'email',
		'admin_name',
		'two_factor_code',
        'two_factor_expires_at',
		'is_active',
		'email_verification_code',
		'email_verified_at'
    ];

	protected $dates = [
		'updated_at',
		'created_at',
		'two_factor_expires_at',
		'deleted_at',
		'email_verified_at'
	];

	protected $hidden = [
        'admin_password', 'remember_token'
    ];

	protected $visible = [
        'admin_password', 'remember_token'
    ];
    protected $primaryKey = 'admin_id';
 	protected $table = 'tbl_admin';

 	public function roles(){
 		return $this->belongsToMany('App\Roles');
 	}

 	public function getAuthPassword(){
 		return $this->admin_password;
 	}
 	
 	public function hasAnyRoles($roles){
 		return null !==  $this->roles()->whereIn('name',$roles)->first();
 	}
 	public function hasRole($role){
 		return null !==  $this->roles()->where('name',$role)->first();
 	}

	public function generateTwoFactorCode()
	{
		date_default_timezone_set('asia/ho_chi_minh');
		$this->timestamps = false;
		$this->two_factor_code = rand(100000, 999999);
		$this->two_factor_expires_at = now()->addMinutes(10);
		$this->save();
	}

	public function resetTwoFactorCode()
	{
		$this->timestamps = false;
		$this->two_factor_code = null;
		$this->two_factor_expires_at = null;
		$this->save();
	}
	
}
