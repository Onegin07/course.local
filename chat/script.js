// Отправка сообщений без перезагрузки страницы
var formSendMessage = document.querySelector("#form");
formSendMessage.onsubmit = function(form) {
	form.preventDefault(); // предотвращение действия по-умолчанию
	var toUser = formSendMessage.querySelector("input[name='to_user_id']"); // кому отправляется
	var fromUser = formSendMessage.querySelector("input[name='from_user_id']"); // кто отправляет
	var message = formSendMessage.querySelector("textarea"); // текст сообщения

	// строка параметров POST-запроса формы отправки сообщения
	var formData = "send_msg=1" +
					"&to_user_id=" + toUser.value +
					"&from_user_id=" + fromUser.value +
					"&message=" + message.value;

	var ajax = new XMLHttpRequest(); // объект для отправки http-запроса
		ajax.open('POST', formSendMessage.action, false); // открываем ссылку, передав метод запроса
		ajax.setRequestHeader( "Content-type", "application/x-www-form-urlencoded" ); // устанавливаем значения HTTP-заголовков
		ajax.send(formData); // отправляем запрос с параметрами

	var messageList = document.querySelector("#message-list"); // выбираем блок списка сообщений по ID
	messageList.innerHTML = ajax.response; // изменяем содержимое списка #message-list

	message.value = ""; // очищаем поле ввода сообщений
}

// Поиск юзеров без перезагрузки страницы
var formSearch = document.querySelector("#form-search");
formSearch.onsubmit = function(form) {
	form.preventDefault();

	var searchText = formSearch.querySelector("input"); // берем текст поиска из формы

	// строка параметров POST-запроса формы поиска
	var formData = "search-btn=1&search-text=" + searchText.value;

	var ajax = new XMLHttpRequest(); // объект для отправки http-запроса
		ajax.open('POST', formSearch.action, false); // открываем ссылку, передав метод запроса
		ajax.setRequestHeader( "Content-type", "application/x-www-form-urlencoded" ); // устанавливаем значения HTTP-заголовков
		ajax.send(formData); // отправляем запрос с параметрами

	var usersList = document.querySelector("#list"); // выбираем блок списка юзеров по ID
	usersList.innerHTML = ajax.response; // изменяем содержимое списка юзеров	
}


