<?php

class TasksModel {
	private $link;
	public $rows = [];

	public function __construct()
	{
		$db = new Db();
		$this->link = $db->getConnection();
	}

	public function get_all_rows() {
		$sql = "SELECT * FROM tasks";

		if($result = mysqli_query($this->link, $sql)) {
			$this->rows = mysqli_fetch_all($result,MYSQLI_ASSOC);
		}
	}
}