let btnSwitch = document.querySelector('#btn_switch');
let page = document.querySelector('body');
btnSwitch.onclick = function() {
  // container.classList.remove('light');
  // container.classList.add('dark');
  page.classList.toggle('dark');
  //console.log('click');
}

// var form = document.querySelector("#form");
// form.onsubmit = function(event) {
// 	event.preventDefault();
   
// 	var whom = form.querySelector("input[name='to_user_id']"); 
// 	var from = form.querySelector("input[name='from_user_id']");
// 	var message = form.querySelector("textarea");

//     var info = "send_msg=1" + 
//                  "&to_user_id=" + whom.value +
//                  "&from_user_id=" + from.value +
//                  "&message=" + message.value;

// 	var ajax = new XMLHttpRequest();
// 	    ajax.open("POST", form.action, false);
// 	    ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
// 	    ajax.send(info);

//     var messageList = document.querySelector("#message-list");
//         messageList.innerHTML = ajax.response;
// }

// var formSearch = document.querySelector("#form-search");
// poisk.onsubmit = function(event) {
// 	event.preventDefault();
   
// 	var searchText = form.querySelector("input[name='search-text']");

//     var info = "search-btn=1" + 
//                  "&text=" + text.value;

// 	var ajax = new XMLHttpRequest();
// 	    ajax.open("GET", form.action, false);
// 	    ajax.send(info);

//     var search = document.querySelector("#search");
//         search.innerHTML = ajax.response;
// }