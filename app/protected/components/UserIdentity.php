<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
			$users = [
					'admin'=>'qwerty',
					'admin2'=>'Worldinchange!',
					'admin3'=>'3DRg{1h0gr8HYdGo4HPZsXtVi@',
					'admin4'=>'3coZ@RzGtcc}thqfWHTDAvv7kE'
			];
			if(!isset($users[$this->username]))
					$this->errorCode=self::ERROR_USERNAME_INVALID;
			elseif ($this->password !== $users[$this->username])
					$this->errorCode=self::ERROR_PASSWORD_INVALID;
			else
			{
					$this->errorCode=self::ERROR_NONE;
			}
			return $this->errorCode;
	}
}
