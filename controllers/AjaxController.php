<?php

class AjaxController
{

    public function actionIndex()
    {
    	if (empty($_POST['type'])) return false;

		$db = new Db();
		$link = $db->getConnection();

		if($_POST['type'] == 1 && !empty($_POST['user']) && !empty($_POST['email']) && !empty($_POST['task'])) {
			$_POST['task'] = str_ireplace('<script>', '', $_POST['task']);
			$_POST['task'] = str_ireplace('</script>', '', $_POST['task']);

			$sql = "INSERT INTO tasks (user, email, task, status) VALUES ('".$_POST['user']."', '".$_POST['email']."', '".$_POST['task']."', 0)";
			if(mysqli_query($link, $sql)){
				echo 'ok';
			} else{
				echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
			}
		}

		if ($_POST['type'] == 2 && !empty($_POST['login']) && !empty($_POST['pass']) && $_POST['login'] == 'admin' && $_POST['pass'] == '123') {
			$_SESSION['auth'] = 1;
			echo 'ok';
		}

		if ($_POST['type'] == 3) {
			unset($_SESSION['auth']);

			echo 'ok';
		}

		if ($_POST['type'] == 4 && !empty($_POST['id']) && !is_null($_POST['status'])) {
			$sql = "UPDATE tasks SET status = '".$_POST['status']."' WHERE id=".$_POST['id'];
			if ($link->query($sql) === TRUE) {
				echo "ok";
			} else {
				echo "Error updating record: " . $link->error;
			}
		}

		if ($_POST['type'] == 5 && !empty($_POST['id']) && !empty($_POST['task'])) {
			$sql = "SELECT task, edit_admin FROM tasks WHERE id=".$_POST['id'];
			if($result = mysqli_query($link, $sql)) {
				$row = mysqli_fetch_assoc($result);
			}

			$edit_admin = 0;
			if ($row['edit_admin'] == 1) $edit_admin = 1;

			$data = [
				'status' 		=> 'ok',
				'edit_admin' 	=> $edit_admin,
			];


			if ($row['task'] != $_POST['task'] && $_SESSION['auth']) {

				$sql = "UPDATE tasks SET task = '" . $_POST['task'] . "', edit_admin = 1 WHERE id=" . $_POST['id'];
				if ($link->query($sql) === TRUE) {
					$data = [
						'status' 		=> 'ok',
						'edit_admin' 	=> '1',
					];
				} else {
					echo "Error updating record: " . $link->error;
					$data = ['status' => 'error'];
				}
			}

			if (!empty($_SESSION['auth'])) {
				$data = ['status' => 'no2'];
			}

			echo json_encode($data);
		}

		if ($_POST['type'] == 5 && empty($_POST['task'])) {
			echo json_encode(['status' => 'no']);
		}

		$db->closeConnection($link);
    }
}