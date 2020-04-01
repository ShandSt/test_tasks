			<table id="tasks" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>Пользователь</th>
						<th>E-mail</th>
						<th style="width: 30%;">Задача</th>
						<th>Выполнил</th>
					</tr>
				</thead>
				<tbody>
					<? foreach($rows as $row) { ?>
					<tr>
						<td><?= $row['user'] ?></td>
						<td><?= $row['email'] ?></td>
						<td style="width: 40%;">
							<div>
								<p><?= $row['task'];?></p>
								<span <?= (($row['edit_admin']) ? 'style="display:block"': '')?>>отредактировано администратором</span>
							</div>
							<? if(!empty($_SESSION['auth'])) {?>
								<i class="fa fa-pencil change_task" aria-hidden="true"></i>
								<i class="fa add_task" data-id="<?= $row['id'] ?>">Сохранить</i>
							<? } ?>
						</td>
						<td>
							<span>
								<?= ($row['status']) ? 'Выполнен' : 'Не выполнен'?>
							</span>
							<? if(!empty($_SESSION['auth'])) {?>
								<i class="fa change_status" data-status="<?= $row['status'] ?>"
								   data-id="<?= $row['id'] ?>">Изменить статус</i>
							<? } ?>
						</td>
					</tr>
					<? } ?>
				</tbody>
			</table>
			<div id="addTaskBlock">
				<div class="row container-fluid">
					<h3 class="text-center">Добавить пользователя</h3>
				</div>
				<div class="row container-fluid">
					<div class="form-group col-md-3 col-xs-12">
						<label for="idUser">Пользователь</label>
						<input name="idUser" class="form-control" id="idUser">
					</div>
					<div class="form-group col-md-3 col-xs-12">
						<label for="addEmail">Email</label>
						<input type="text" name="task" class="form-control" id="addEmail">
					</div>
					<div class="form-group col-md-6 col-xs-12">
						<label for="addTask">Задача</label>
						<textarea name="task" class="form-control" rows="3" id="addTask"></textarea>
					</div>
				</div>
				<div class="row container-fluid">
					<button id="button_task" type="button" name="button_task" class="btn btn-success">
						Добавить
					</button>
				</div>
			</div>