let authBox = document.querySelector(".auth-box");
let submitButton = authBox.querySelector(".submit");
let errorMessage = authBox.querySelector(".error-message");
let content = document.querySelector("content");

function loadScript(url, callback)
{
    // Adding the script tag to the head as suggested before
    let script = document.createElement('script');
    script.type = 'text/javascript';
    script.src = url;

    // Then bind the event to the callback function.
    // There are several events for cross browser compatibility.
    script.onreadystatechange = callback;
    script.onload = callback;

    // Fire the loading
    content.appendChild(script);
}

form.addEventListener("submit", function (evt) {
    evt.preventDefault();

    //Getting form data
    let formData = {
        login: document.querySelector("input[name='login']").value,
        password: document.querySelector("input[name='password']").value
      };
    
      let request = new XMLHttpRequest();
    
      request.addEventListener("load", function () {
        //Errors handlers
        if (request.responseText == '1') {
          errorMessage.textContent = "Аккаунт с данным логином не найден";
          errorMessage.classList.add("show");
        } else if (request.responseText == '2') {
          errorMessage.textContent = "Неверный пароль"
          errorMessage.classList.add("show");
        } else if (request.responseText) { 
          errorMessage.classList.remove("show");
          authBox.style.display = 'none';
          content.innerHTML = request.response;
          loadScript('assets/js/admin_controls.js');
        }
      });
    
      //Sending form data
      request.open("POST", "assets/php/admin_pages/admin_handler.php", true);
      request.setRequestHeader(
        "Content-Type",
        "application/x-www-form-urlencoded; charset=UTF-8"
      );
      request.send(
          "login=" +
          encodeURIComponent(formData.login) +
          "&password=" +
          encodeURIComponent(formData.password)
      );
});