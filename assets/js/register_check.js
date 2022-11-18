let authBox = document.querySelector(".auth-box");
let submitButton = authBox.querySelector(".submit");
let errorMessage = authBox.querySelector(".error-message");
let form = document.querySelector("#form");

form.addEventListener("submit", function (evt) {
  
  evt.preventDefault();
  //Password check
  let input = authBox.querySelectorAll("input[type='password']");
  if (input[0].value != input[1].value) {
    errorMessage.textContent = "Пароли не совпадают";
    errorMessage.classList.add("show");
    return;
  }
    errorMessage.classList.remove("show");

  //Getting form data
  let formData = {
    name: document.querySelector("input[name='name']").value,
    surname: document.querySelector("input[name='surname']").value,
    patronym: document.querySelector("input[name='patronymic']").value,
    login: document.querySelector("input[name='login']").value,
    email: document.querySelector("input[name='email']").value,
    password: document.querySelector("input[name='password']").value,
  };

  let request = new XMLHttpRequest();

  request.addEventListener("load", function () {
    //Login and Email check
    switch(request.responseText) {
      case '1': {
        errorMessage.textContent = "Логин занят";
        errorMessage.classList.add("show");
        return;
      }
      case '2': {
        errorMessage.textContent = "Email занят";
        errorMessage.classList.add("show");
        return;
      }
      case '3': {
        errorMessage.classList.remove("show");
        window.location.href = 'login';
        break;
      }
    }
    if (request.responseText == 1) {
      errorMessage.textContent = "Логин занят";
      errorMessage.classList.add("show");
      return;
    } else if (request.responseText == 2) {
      errorMessage.textContent = "Email занят";
      errorMessage.classList.add("show");
      return;
    } else {
      errorMessage.classList.remove("show");
    }
  });

  //Sending form data
  request.open("POST", "assets/php/register_handler.php", true);
  request.setRequestHeader(
    "Content-Type",
    "application/x-www-form-urlencoded; charset=UTF-8"
  );
  request.send(
    "name=" +
      encodeURIComponent(formData.name) +
      "&surname=" +
      encodeURIComponent(formData.surname) +
      "&patronym=" +
      encodeURIComponent(formData.patronym) +
      "&login=" +
      encodeURIComponent(formData.login) +
      "&email=" +
      encodeURIComponent(formData.email) +
      "&password=" +
      encodeURIComponent(formData.password)
  );
});

/** Jquery */
// let form = $('#form');
// form.on('submit', function(evt) {
//   evt.preventDefault();

//   $.ajax({
//     type: 'POST',
//     url: 'register_handler.php',
//     data: $(this).serialize()
//   }).done(function(response) {
//     console.log(response);
//   })
// })

/** Fetch */
// submitButton.addEventListener('submit', function(evt) {
//   $( "#target" ).submit(function( event ) {
//     alert( "Handler for .submit() called." );
//     event.preventDefault();
//   });
// })
