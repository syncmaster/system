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
			$utcdiff = $this->session['utcdiff'];
			$this->smarty->assign('user', $user);
			$this->smarty->assign('utcdiff', $utcdiff);
		}

		if (empty($user)) {
			header("refresh: 5,url=auth/login");
		}

		return $this->smarty->fetch("myprofile.html");

	}
}

