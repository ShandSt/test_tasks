<?php

class Db
{
	public static function getConnection()
	{
		$paramsPath = ROOT . '/config/db_params.php';
		$params = include($paramsPath);

		$link = mysqli_connect($params['host'], $params['user'], $params['password'], $params['dbname']);

		if($link === false){
			die("ERROR: Could not connect. " . mysqli_connect_error());
		}

		return $link;
	}

	public static function closeConnection($link)
	{
		mysqli_close($link);
	}
}