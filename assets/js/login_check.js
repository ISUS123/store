let authBox = document.querySelector(".auth-box");
let submitButton = authBox.querySelector(".submit");
let errorMessage = authBox.querySelector(".error-message");

form.addEventListener("submit", function (evt) {
    evt.preventDefault();

    //Getting form data
    var formData = {
        login: document.querySelector("input[name='login']").value,
        password: document.querySelector("input[name='password']").value
      };
    
      var request = new XMLHttpRequest();
    
      request.addEventListener("load", function () {
        //Errors handlers
        if (request.responseText == '1') {
          errorMessage.textContent = "Аккаунт с данным логином не найден";
          errorMessage.classList.add("show");
        } else if (request.responseText == '2') {
          errorMessage.textContent = "Неверный пароль"
          errorMessage.classList.add("show");
        } else if (request.responseText) {
          document.location.href = 'client_page.php';
          errorMessage.classList.remove("show");
        }
      });
    
      //Sending form data
      request.open("POST", "assets/php/login_handler.php", true);
      request.setRequestHeader(
        "Content-Type",
        "application/x-www-form-urlencoded; charset=UTF-8"
      );
      request.send(
          "login=" +
          encodeURIComponent(formData.login) +
          "&password=" +
          encodeURIComponent(formData.password) +
          "&attach_ip=" +
          encodeURIComponent(formData.attach_ip)
      );
});