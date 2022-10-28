let items = document.querySelectorAll(".cart-item");
let qntButtons = document.querySelectorAll("input[name='qnt']");
let deleteButtons = document.querySelectorAll(".hide");
let acceptButtons = document.querySelectorAll("input[name='accept']");
let passwordWindow = document.querySelector(".password-wrapper");
let passwordClose = passwordWindow.querySelector("input[type='reset']");
let passwordAccept = passwordWindow.querySelector("input[type='submit']");

let checkPassword = function () {
  let passwordInput = passwordWindow.querySelector("input[type='password']");
  let errorMessage = passwordWindow.querySelector(".error-message");
    
    let requestPassword = new XMLHttpRequest();
    requestPassword.addEventListener("load", function () {
      switch (requestPassword.responseText) {
        case "1": {
          errorMessage.style.display = "none";
          return("right");
        }
        case "2": {
          errorMessage.style.display = "block";
          errorMessage.textContent = "Неверный пароль";
          return("wrong");
        }
      }
    });

    //Sending form data
    requestPassword.open("POST", "assets/php/login_handler.php", true);
    requestPassword.setRequestHeader(
      "Content-Type",
      "application/x-www-form-urlencoded; charset=UTF-8"
    );
    requestPassword.send("password_input=" + encodeURIComponent(passwordInput.value));
};

let addButtonClickHandler = function (button, i) {
  var formData = {};

  let sendRequest = function (obj) {
    var request = new XMLHttpRequest();

    request.addEventListener("load", function () {
      //Errors handlers
      let responseCode = request.responseText.split("=");
      switch (responseCode[0]) {
        case "1": {
          let cost = document.querySelectorAll(".cost p");
          cost[i].textContent = "Цена всего: " + responseCode[1] + " р.";
          break;
        }
        case "2": {
          // showError("Не удалось подлючиться к базе данных");
          // enterButton.style.display = "none";
          break;
        }
        default: {
          // errorMessage.style.display = "none";
        }
      }
    });

    request.open("POST", "assets/php/cart_handler.php", true);
    request.setRequestHeader(
      "Content-Type",
      "application/x-www-form-urlencoded; charset=UTF-8"
    );

    let keys = Object.keys(obj);
    request.send(
      keys[0] +
        "=" +
        encodeURIComponent(obj[keys[0]]) +
        "&" +
        keys[1] +
        "=" +
        encodeURIComponent(obj[keys[1]]) +
        "&" +
        keys[2] +
        "=" +
        encodeURIComponent(obj[keys[2]])
    );
  };

  switch (button.getAttribute("data-name")) {
    case "qnt": {
      button.addEventListener("change", function () {
        var formData = {
          type: 1,
          qnt: button.value,
          product_id: button.getAttribute("data-id"),
        };
        sendRequest(formData);
      });
      break;
    }

    case "hide": {
      button.addEventListener("click", function () {
        var formData = {
          type: 2,
          cart_id: button.getAttribute("data-id"),
        };
        sendRequest(formData);
        let itemToDelete = document.querySelector(
          '.cart-item[data-id="' + formData.cart_id + '"]'
        );
        itemToDelete.style.animation = "delete 0.5s ease";
        setTimeout(function () {
          itemToDelete.remove();
        }, 500);
      });
      break;
    }

    case "accept":
      {
        button.addEventListener("click", function () {
          // passwordWindow.style.display = "flex";
          // passwordClose.addEventListener("click", function () {
          // passwordWindow.style.display = "none";
          // });

          // let checkResult = passwordAccept.addEventListener("click", function(evt) {
          //   evt.preventDefault();
          //   let checkResult = checkPassword();
          //   return(checkResult);
          // })
          
          // console.log(checkResult);

          // if (checkResult == "wrong") {
          //   return;
          // } else if(checkResult == "right") {
            var formData = {
              type: 3,
              cart_id: button.getAttribute("data-id"),
            };
            sendRequest(formData);
            let itemToDelete = document.querySelector(
              '.cart-item[data-id="' + formData.cart_id + '"]'
            );
            itemToDelete.style.animation = "accept 0.5s ease";
            setTimeout(function () {
              itemToDelete.remove();
            }, 500);
          // }
        });
      }
      break;
  }
};

for (let i = 0; i < items.length; i++) {
  addButtonClickHandler(qntButtons[i], i);
  addButtonClickHandler(deleteButtons[i]);
  addButtonClickHandler(acceptButtons[i]);
}
