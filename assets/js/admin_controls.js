let adminContent = document.querySelector(".admin-content");
let buttons = document.querySelectorAll(".admin-navbar .navbar-item");

let getPage = function (page) {
  let request = new XMLHttpRequest();

  request.onload = function () {
  adminContent.innerHTML = request.response;
  };

  request.open("POST", "assets/php/admin_pages/get_page.php");
  request.setRequestHeader(
    "Content-Type",
    "application/x-www-form-urlencoded; charset=UTF-8"
  );
  request.send("page=" + encodeURIComponent(page));
};

for (let i = 0; i < buttons.length; i++) {
  buttons[i].addEventListener("click", function (evt) {
    evt.preventDefault();
    getPage(buttons[i].dataset.id);
    setControls(buttons[i].dataset.id);
  });
}

getPage('product');

let setControls = function(page) {
  //General controls

  //Controls for items page

  //Controls for category page

  //Controls for orders page
}

// let navBarControls = function () {

// }