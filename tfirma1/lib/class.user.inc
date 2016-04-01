<?php
class user
{
private $id;
private $username;
private $password;
private $level;
private $jmbg;
	public function update_id($id1=0)
	{
	$this->id=$id1;
	return $this->id;
	}
	public function update_user($user)
	{
	$this->username=$user;
	return $this->username;
	}
	public function update_pass($pass)
	{
	$this->password=$pass;
	return $this->password;
	}
	public function update_level($lvl)
	{
	$this->level=$lvl;
	return $this->level;
	}
	public function update_jmbg($j)
	{
	$this->jmbg=$j;
	return $this->jmbg;
	}
public function id()
{
return $this->id;
}
public function username()
{
return $this->username;
}	
public function pass()
{
return $this->password;
}
public function level()
{
return $this->level;
}
public function jmbg()
{
return $this->jmbg;
}
	
	
	}

?>