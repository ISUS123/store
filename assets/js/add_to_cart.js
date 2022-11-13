let buttons = document.querySelectorAll(".to-cart");
let error = document.querySelector(".error-wrapper");
let errorWindow = error.querySelector(".error");
let errorMessage = errorWindow.querySelector(".error p");
let enterButton = errorWindow.querySelector(".enter");
let cart = document.querySelector(".button-cart");

let showHint = function (button, responseCode) { //Shows hint that removes after 1sec
  let hint = document.createElement("div"); //Making hint element
  hint.classList.add("hint");
  switch (
    responseCode[0] //Changing hint text
  ) {
    case "3":
      hint.textContent = "Товар добавлен в корзину";
      break;
    case "4":
      hint.textContent =
        "Кол-во данного товара в корзине обновлено: " +
        responseCode[1] +
        " шт.";
      break;
    case "5":
      hint.textContent = "Недостаточно товара в наличии";
      break;
  }
  button.after(hint); //Adding hint to the button which is pressed

  let coord = button.getBoundingClientRect(); //Getting the coordinates of the pressed button
  hint.top = coord.top; //Align hint coords to button coords
  hint.left = coord.left;
  hint.style.animation = "hint 1s ease"; //Adding reveal and hide animation to hint
  setTimeout(function () {
    //Removing element on the end of animation
    hint.remove();
  }, 1000);
};

let changeButtonText = function (button, responseCode) { //Changes add to cart button text
  switch (responseCode[0]) {
    case "3": {
      button.textContent = "Товар добавлен в корзину";
      break;
    }
    case "4": {
      button.textContent =
        "Кол-во данного товара в корзине обновлено: " +
        responseCode[1] +
        " шт.";
      break;
    }
    case "5": {
      button.textContent = "Недостаточно товара в наличии";
      break;
    }
  }
};

let showError = function (text) {
  error.style.animation = "reveal 0.5s ease";
  errorMessage.textContent = text;
  error.style.display = "flex";
};

let addButtonClickHandler = function (button) {
  button.addEventListener("click", function () {
    var formData = {
      product_id: button.getAttribute("data-id"),
    };

    var request = new XMLHttpRequest();

    request.addEventListener("load", function () {
      //Errors handlers
      let responseCode = request.responseText.split("=");
      switch (responseCode[0]) {
        case "1": {
          showError(
            "Для добавления товара в корзину необходимо войти в аккаунт"
          );
          enterButton.style.display = "block";
          break;
        }
        case "2": {
          showError("Не удалось подлючиться к базе данных");
          enterButton.style.display = "none";
          break;
        }
        default: {
          errorMessage.style.display = "none";

          //If in the catalog page, using hint
          if (document.location.pathname == "/catalog.php") {
            showHint(button, responseCode);
          } else {
            //Else changing button text
            changeButtonText(button, responseCode);
          }
        }
      }
    });

    //Sending form data
    request.open("POST", "assets/php/add_to_cart_handler.php", true);
    request.setRequestHeader(
      "Content-Type",
      "application/x-www-form-urlencoded; charset=UTF-8"
    );
    request.send("product_id=" + encodeURIComponent(formData.product_id));
  });
};

for (let i = 0; i < buttons.length; i++) {
  addButtonClickHandler(buttons[i]);
}

errorWindow.addEventListener("click", function () {
  error.style.animation = "hide 0.3s ease";
  setTimeout(function() {
    error.style.display = "none";
  }, 290);
  
});
