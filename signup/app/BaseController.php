<?php

class BaseController {
	protected $smarty;
	protected $db;
	protected $mail;
	protected $session;

	public function __construct($smarty, $db, $mailer) {
		$this->smarty = $smarty;
		$this->db = $db;
		$this->mail = $mailer;
		$this->session = isset($_SESSION) ? $_SESSION : array();
	}

	public function __destruct ()
	{
		$_SESSION = $this->session;
	}
}
