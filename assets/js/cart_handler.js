let pageButtons = document.querySelectorAll(".cart-menu button");

let passwordWrapper = document.querySelector(".password-wrapper");
let passwordClose = passwordWrapper.querySelector("input[type='reset']");
let passwordAccept = passwordWrapper.querySelector("input[type='submit']");

for (let i = 0; i < pageButtons.length; i++) {
  pageButtons[i].addEventListener("click", function (evt) {
    evt.preventDefault();
    getItems(pageButtons[i].value);
  });
}

let getItems = function (page) {
  let cartContent = document.querySelector(".cart-content");
  let isChangingPage = true;
  let request = new XMLHttpRequest();

  request.onload = function () {
    cartContent.innerHTML = request.response;
    if (page == "cart") updateItemButtons(); //If at order page, don't adding event listeners
  };

  request.open("POST", "assets/php/cart_handler.php");
  request.setRequestHeader(
    "Content-Type",
    "application/x-www-form-urlencoded; charset=UTF-8"
  );
  request.send(
    "page=" +
      encodeURIComponent(page) +
      "&is_changing_page=" +
      encodeURIComponent(isChangingPage)
  );
};

let acceptId;
let errorMessage = passwordWrapper.querySelector(".error-message");

passwordAccept.addEventListener("click", function (evt) {
  evt.preventDefault();
  let passwordInput = passwordWrapper.querySelector("input[name='pass']");
  checkPassword(passwordInput.value, acceptId);
  passwordInput.value = "";
});

let checkPassword = function (pass, acceptId) {
  let requestPassword = new XMLHttpRequest();

  requestPassword.onload = function () {
    if (requestPassword.response == "1") {
      errorMessage.style.display = "none";
      sendAccept(acceptId);
      passwordWrapper.style.display = "none";
    } else {
      errorMessage.style.display = "block";
      errorMessage.textContent = "Неверный пароль";
    }
  };

  //Sending form data
  requestPassword.open("POST", "assets/php/cart_handler.php");
  requestPassword.setRequestHeader(
    "Content-Type",
    "application/x-www-form-urlencoded; charset=UTF-8"
  );
  requestPassword.send(
    "password=" + encodeURIComponent(pass) + "&type=" + encodeURIComponent(4)
  );
};

let sendAccept = function (acceptId) {
  let formData = {
    type: 3,
    cart_id: acceptId,
  };

  sendRequest(formData);
  let itemToDelete = document.querySelector(
    '.cart-item[data-id="' + formData.cart_id + '"]'
  );
  itemToDelete.style.animation = "accept 0.5s ease";
  setTimeout(function () {
    itemToDelete.remove();
    getItems("cart");
  }, 500);
};

passwordClose.addEventListener("click", function () {
  passwordWrapper.style.display = "none";
  errorMessage.style.display = "none";
});

let sendRequest = function (obj, i) {
  let request = new XMLHttpRequest();

  request.onload = function () {
    //Errors handlers
    let responseCode = request.responseText.split("=");
    switch (responseCode[0]) {
      case "1": {
        let cost = document.querySelectorAll(".cost span");
        cost[i].textContent = responseCode[1] + " р.";
        break;
      }
      case "2": {
        // enterButton.style.display = "none";
        break;
      }
      default: {
        // errorMessage.style.display = "none";
      }
    }
  };

  request.open("POST", "assets/php/cart_handler.php", true);
  request.setRequestHeader(
    "Content-Type",
    "application/x-www-form-urlencoded; charset=UTF-8"
  );

  let keys = Object.keys(obj); //Formatting input obj data to match xhr query requirements

  request.send(
    keys[0] +
      "=" + //Adds "=" to end of first obj element
      encodeURIComponent(obj[keys[0]]) + //Places obj element into encodeURIComponent
      "&" + //Adds "&" to start of second obj element
      keys[1] +
      "=" +
      encodeURIComponent(obj[keys[1]]) +
      "&" +
      keys[2] +
      "=" +
      encodeURIComponent(obj[keys[2]])
  );
};

let updateItemButtons = function () {
  let items = document.querySelectorAll(".cart-item");
  let qntButtons = document.querySelectorAll("input[name='qnt']");
  let deleteButtons = document.querySelectorAll(".hide");
  let acceptButtons = document.querySelectorAll("input[name='accept']");

  let addButtonClickHandler = function (button, i) {
    let formData = {};
    switch (button.getAttribute("data-name")) {

      case "qnt": {

        button.addEventListener("change", function () {

          if(parseInt(button.value) > parseInt(button.max)) {
            button.value = button.max;
          } else if (parseInt(button.value) < parseInt(button.min)) {
            button.value = 1;
          }

          let formData = {
            type: 1,
            qnt: button.value,
            product_id: button.getAttribute("data-id"),
          };
          
          sendRequest(formData, i);
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
            getItems("cart");
          }, 500);
        });
        break;
      }

      case "accept":
        {
          button.addEventListener("click", function () {
            passwordWrapper.style.display = "flex";
            acceptId = button.getAttribute("data-id");
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
};

getItems("cart");
