<?php

class LoginController
{

	public function actionIndex()
	{
		require_once (ROOT.'/views/site/header.php');
		require_once (ROOT.'/views/site/login.php');
		require_once (ROOT.'/views/site/footer.php');
		return true;
	}
}