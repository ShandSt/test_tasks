<?php
require_once (ROOT.'/models/TasksModel.php');

class IndexController
{

    public function actionIndex()
    {
		$task = new TasksModel;
		$task->get_all_rows();
		$rows = $task->rows;

		require_once (ROOT.'/views/site/header.php');
        require_once (ROOT.'/views/site/index.php');
        require_once (ROOT.'/views/site/footer.php');

        return true;
    }
}