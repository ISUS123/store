let adminContent = document.querySelector(".admin-content");
let buttons = document.querySelectorAll(".admin-navbar .navbar-item");
let editWrapper = document.querySelector(".edit-wrapper");
let editContent = document.querySelector(".edit-menu textarea");
let editForm = document.querySelector(".edit-menu form");
let defaultPage = "product";
let currentPage = defaultPage;

let getPage = function (page) {
  let request = new XMLHttpRequest();

  request.onload = function () {
    adminContent.innerHTML = request.response;
    currentPage = page;
    setControls(page);
  };

  request.open("POST", "assets/php/admin_pages/get_page.php");
  request.setRequestHeader(
    "Content-Type",
    "application/x-www-form-urlencoded; charset=UTF-8"
  );
  request.send("page=" + encodeURIComponent(page));
};

let sendEditQuery = function (id, toEdit, newContent, page) {
  let request = new XMLHttpRequest();

  request.onload = function () {
    console.log(request.response);
    // getPage(page);
  };

  request.open("POST", "assets/php/admin_pages/admin_edit.php");
  request.setRequestHeader(
    "Content-Type",
    "application/x-www-form-urlencoded; charset=UTF-8"
  );
  request.send(
    "id=" + 
    encodeURIComponent(id) +
    "&to_edit=" +
    encodeURIComponent(toEdit) +
    "&new_content=" +
    encodeURIComponent(newContent) + 
    "&current_page=" + 
    encodeURIComponent(currentPage)
  );
}

let setControls = function (page) {
  //General controls
  let tableCells = document.getElementsByTagName("td");

  for (let i = 0; i < tableCells.length; i++) {
    //Creating edit button on every table cell
    if(!(tableCells[i].classList.contains('id'))) {
      let editButton = document.createElement("div");
      editButton.classList.add("edit-button");
  
      tableCells[i].appendChild(editButton);
    }
  }

  let editButtons = document.querySelectorAll(".edit-button");

  let itemId = '';
  let toEdit = '';

  for (let i = 0; i < editButtons.length; i++) {
    editButtons[i].addEventListener("click", function () {
      itemId = editButtons[i].parentElement.parentElement.dataset.id;
      toEdit = editButtons[i].parentElement.dataset.section;
      editWrapper.style.visibility = 'visible';
      // editContent.textContent = editButtons[i].textContent; //Current text should appear in edit menu
      console.log('item id: ' + itemId);
      console.log('section to edit: ' + toEdit);
    });
  }

  editForm.addEventListener('submit', function(evt) {
    evt.preventDefault();
    sendEditQuery(itemId, toEdit, editContent.value, currentPage);
  });

  editForm.addEventListener('reset', function(evt) {
    editWrapper.style.visibility = 'hidden';
  });

  //Controls for items page

  //Controls for category page

  //Controls for orders page
};

for (let i = 0; i < buttons.length; i++) {
  buttons[i].addEventListener("click", function (evt) {
    evt.preventDefault();
    getPage(buttons[i].dataset.id);
  });
}

getPage(defaultPage);
