<?php
class SignUpForm extends CFormModel
{
	public $username;
	public $realname;
	public $password;
	public $email;
	public $languageid;
	public $themeid;
	
	public function rules()
	{
		return array(
			array('realname,email,username,languageid,themeid,password', 'required'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'realname'=>'Real Name',
			'username'=>'User Name',
			'password'=>'Password',
			'email'=>'Email',
			'themeid'=>'Theme',
			'languageid'=>'Language'
		);
	}

	public function signup()
	{
		$user = new Useraccess;
		$user->username = $this->username;
		$user->password = $user->hashPassword($this->password);
		$user->realname = $this->realname;
		$user->email = $this->email;
		$user->themeid = $this->themeid;
		$user->languageid = $this->languageid;
		$user->recordstatus = 1;
		if ($user->save())
		{
			return true;
		}
		else
		{
			return false;
		}
	}
}
