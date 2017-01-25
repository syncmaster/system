<?php

class Home extends BaseController {
	public function index() {
		$this->smarty->display("home.html");
	}
	
	public function myProfile() 
	{
		$user = array();
		if(isset($this->session['user'])) {
			$user = $this->session['user'];
			$this->smarty->assign('user', $user);
			$this->smarty->assign('utcdiff', $this->session['utcdiff']);
		}

		if (empty($user)) {
			header("refresh: 5,url=auth/login");
		}

		return $this->smarty->fetch("myprofile.html");

	}
}

