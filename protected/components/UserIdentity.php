<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
    private $_id;
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
        
        //$user=Users::model()->findByAttributes(array('email'=>$this->email));
        $user=Users::model()->findByAttributes(array('email'=>$this->username));
        if($user===null) {
            $this->errorCode=self::ERROR_USERNAME_INVALID;
        }
        else if($user->activate==0) {
            $this->errorCode=100;
        }
        else if(!Users::model()->validatePassword($this->password, $user->password)) {
            $this->errorCode=self::ERROR_PASSWORD_INVALID;
        }
        else
        {
            $this->_id=$user->id;
            $this->username=$user->name;
            $this->setState('name', $this->username);
            $this->setState('photo', $user->photo);
            $this->setState('member', $user->member);
            $this->setState('role', $user->occupation_id);
            if($user->member_type=='') $user->member_type='client';
            $this->setState('member_type', $user->member_type);
            $this->setState('freefoto', $user->freefoto);
            $this->setState('isCrm', ($user->crm==1)?true:false);
            $this->errorCode=self::ERROR_NONE;
        }
        return $this->errorCode==self::ERROR_NONE;
    }
    
    public function getId() {
        return $this->_id;
    }
}