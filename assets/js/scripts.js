$(function () {
	if (url == '/') {
		$("#tasks").DataTable({
			"bPaginate": true,
			"bLengthChange": false,
			"bFilter": false,
			"bInfo": false,
			"bAutoWidth": false,
			"order": [],
			"oLanguage": {
				"sZeroRecords": "Ничего не найдено - извините",
				"oPaginate": {
					"sFirst": "Первая",
					"sLast": "Посл.",
					"sNext": "След.",
					"sPrevious": "Пред.",
				}
			},
			"pageLength": 3
		});
	}

	$('#button_task').click(function () {
		var user = $('#idUser');
		var email = $('#addEmail');
		var task = $('#addTask');
		var error = false;

		$(".error").remove();

		if (user.val().length < 1) {
			user.after('<span class="error">Это поле обязательно к заполнению</span>');

			error = true;
		}
		if (task.val().length < 1) {
			task.after('<span class="error">Это поле обязательно к заполнению</span>');

			error = true;
		}
		if (email.val().length < 1) {
			email.after('<span class="error">Это поле обязательно к заполнению</span>');

			error = true;
		} else {
			if ((email.val().match(/.+?\@.+/g) || []).length !== 1) {
				email.after('<span class="error">Введите правильный email</span>');

				error = true;
			}
		}

		if(!error) {

			$.ajax({
				type: "POST",
				url: "/ajax",
				data: {
					user: user.val(),
					email: email.val(),
					task: task.val(),
					type: 1
				}
			}).done(function (data){
				if (data == 'ok') {
					alert('Задача успешно добавлена!');

					document.location.reload(true);
				}
			});
		}
	});

	$('#button_auth').click(function () {
		var login = $('#login');
		var pass = $('#pass');
		var error = false;

		$(".error").remove();

		if (login.val().length < 1) {
			login.after('<span class="error">Это поле обязательно к заполнению</span>');

			error = true;
		}
		if (pass.val().length < 1) {
			pass.after('<span class="error">Это поле обязательно к заполнению</span>');

			error = true;
		}

		if(!error) {

			$.ajax({
				type: "POST",
				url: "/ajax",
				data: {
					login: login.val(),
					pass: pass.val(),
					type: 2
				}
			}).done(function (data){
				if (data == 'ok') {
					alert('Авторизация успешна!');

					document.location.reload(true);
				}
				else {
					$('#auth h3').after('<p class="error text-center">Не верный логин или пароль</p>');
				}
			});
		}
	});

	$('.logout').click(function (e) {
		e.preventDefault();

		$.ajax({
			type: "POST",
			url: "/ajax",
			data: {
				type: 3
			}
		}).done(function (data){
			if (data == 'ok') document.location.reload(true);
		});
	});

	$('body').on('click', '.change_status', function (e) {
		e.preventDefault();

		var change_status = $(this);
		var status;
		var status_text;

		if ($(this).attr('data-status') == 1) {
			status_text = 'Не выполнено';
			status = 0;
		} else {
			status_text = 'Выполнено';
			status = 1;
		}

		$.ajax({
			type: "POST",
			url: "/ajax",
			data: {
				id: $(this).data('id'),
				status: status,
				type: 4
			}
		}).done(function (data){
			if (data == 'ok') {
				change_status.closest('td').find('span').text(status_text);
				change_status.data('status', status);
			}
		});
	});

	$('body').on('click', '.change_task', function (e) {
		e.preventDefault();

		var task = $(this).closest('td').find('div');
		var task_text = task.find('p').text();
		task.text('');
		$(this).closest('td').find('div').append('<textarea>' + task_text + '</textarea>');
		$(this).hide();
		$(this).closest('td').find('.add_task').show();
	});

	$('body').on('click', '.add_task', function (e) {
		var task = $(this).closest('td').find('div');
		var task_td = $(this).closest('td');
		var task_add = $(this);
		var task_val = task.find('textarea').val();

		$.ajax({
			type: "POST",
			url: "/ajax",
			dataType: 'json',
			data: {
				id: $(this).data('id'),
				task: task_val,
				type: 5
			}
		}).done(function (data){
			console.log(data);
			if (data.status == 'ok') {
				task_td.find('textarea').remove();

				if (data.edit_admin == 1) {
					task.append('<p>' + task_val + '</p><span style="display:block">отредактировано администратором</span>');
				}
				else task.append('<p>' + task_val + '</p>');


				task_add.hide();
				task_td.find('.change_task').show();
			}
			if (data.status == 'no') {
				alert('Нельзя сохранять пустое поле!');
			}
			if (data.status == 'no2') {
				alert('Нужно авторизироваться!');
			}
		});
	});
});