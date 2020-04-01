<!DOCTYPE html>
<html>
<head>
	<title>Приложение задачник</title>
	<meta name="utf8">

	<link rel="shortcut icon" type="image/x-icon" href="/assets/favicon.ico">
	<link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<link rel="stylesheet" href="/assets/plugins/datatables/dataTables.bootstrap.css">

	<link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
	<div class="container">
		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="col-md-2 navbar-header">
					<a class="navbar-brand" href="/">Задачник</a>
				</div>

				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="col-md-8" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						<li <? echo (($_SERVER['REQUEST_URI'] == '/') ? 'class="active"' : '')?>><a href="/">Главная</a></li>
						<li <? echo (($_SERVER['REQUEST_URI'] == '/login') ? 'class="active"' : '')?>><a href="/login">Авторизация</a></li>
					</ul>
				</div><!-- /.navbar-collapse -->

				<div class="col-md-2 navbar-header">
					<? if(!empty($_SESSION['auth'])) { ?>
					<h4>
						<a class="pull-right logout" href="#">Выход</a>
					</h4>
					<? } ?>
				</div>
			</div><!-- /.container-fluid -->
		</nav>
		<section class="starter-template">
