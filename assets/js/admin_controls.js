let adminContent = document.querySelector(".admin-content");
let navbarButtons = document.querySelectorAll(".admin-navbar .navbar-item");

let editWrapper = document.querySelector(".edit-wrapper");

let editMenu = editWrapper.querySelector(".edit-menu");
let editContent = editMenu.querySelector("textarea");
let editForm = editMenu.querySelector("form");

let deleteMenu = editWrapper.querySelector(".delete-menu");
let deleteForm = deleteMenu.querySelector("form");

let addMenu = document.querySelector(".add-menu");
let productForm = document.getElementById('product');
let categoryForm = document.getElementById('category');

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
    getPage(page);
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

let sendDeleteQuery = function (id, page) {
  let request = new XMLHttpRequest();

  request.onload = function () {
    getPage(page);
  }

  request.open("POST", "assets/php/admin_pages/admin_edit.php");
  request.setRequestHeader(
    "Content-Type",
    "application/x-www-form-urlencoded; charset=UTF-8"
  );
  request.send(
    "id=" + 
    encodeURIComponent(id) +
    "&current_page=" +
    encodeURIComponent(currentPage) +
    "&delete=" +
    encodeURIComponent("true")
  );
}

let sendAddQuery = function (obj, page) {
  let request = new XMLHttpRequest();

  request.onload = function () {
    getPage(page);
  }

  request.open("POST", "assets/php/admin_pages/admin_edit.php");
  request.setRequestHeader(
    "Content-Type",
    "application/x-www-form-urlencoded; charset=UTF-8"
  );

  switch(page) {
    case 'product': 
      request.send(
        "category_id=" + 
        encodeURIComponent(obj.category_id) +
        "&name=" + 
        encodeURIComponent(obj.name) +
        "&description=" +
        encodeURIComponent(obj.description) +
        "&year=" +
        encodeURIComponent(obj.year) +
        "&price=" +
        encodeURIComponent(obj.price) +
        "&img_url=" +
        encodeURIComponent(obj.img_url) +
        "&qnt=" +
        encodeURIComponent(obj.qnt) +
        "&add=" +
        encodeURIComponent("true") +
        "&current_page=" +
        encodeURIComponent(currentPage)
      )
    break;
    case 'category': 
      request.send(
        "name=" + 
        encodeURIComponent(obj.name) +
        "&add=" +
        encodeURIComponent("true") +
        "&current_page=" +
        encodeURIComponent(currentPage)
      )
    break;
  }
}

editForm.addEventListener('submit', function(evt) {
  evt.preventDefault();
  sendEditQuery(itemId, toEdit, editContent.value, currentPage);
  editContent.value = " ";
  editWrapper.style.visibility = 'hidden';
  editMenu.style.display = 'none';
});

editForm.addEventListener('reset', function(evt) {
  editWrapper.style.visibility = 'hidden';
  editMenu.style.display = 'none';
});

deleteForm.addEventListener('submit', function(evt) {
  evt.preventDefault();
  sendDeleteQuery(itemId, currentPage);
  editWrapper.style.visibility = 'hidden';
  deleteMenu.style.display = 'none';
});

deleteForm.addEventListener('reset', function(evt) {
  editWrapper.style.visibility = 'hidden';
  deleteMenu.style.display = 'none';
})

productForm.addEventListener('submit', function(evt) {
  evt.preventDefault();

  formData = {
    category_id: document.querySelector("input[name='category_id']").value,
    name:        document.querySelector("input[name='name']").value,
    description: document.querySelector("input[name='description']").value,
    year:        document.querySelector("input[name='year']").value,
    price:       document.querySelector("input[name='price']").value,
    img_url:     document.querySelector("input[name='img_url']").value,
    qnt:         document.querySelector("input[name='qnt']").value,
  };

  sendAddQuery(formData, currentPage);
  editWrapper.style.visibility = 'hidden';
  addMenu.style.display = 'none';
});

productForm.addEventListener('reset', function(evt) {
  editWrapper.style.visibility = 'hidden';
  addMenu.style.display = 'none';
})

categoryForm.addEventListener('submit', function(evt) {
  evt.preventDefault();

  formData = {
    name: document.querySelector("input[name='category_name']").value
  };

  sendAddQuery(formData, currentPage);
  editWrapper.style.visibility = 'hidden';
  addMenu.style.display = 'none';
});

categoryForm.addEventListener('reset', function(evt) {
  editWrapper.style.visibility = 'hidden';
  addMenu.style.display = 'none';
})

let formData = {

};

let itemId = '';
let toEdit = '';

let setControls = function (page) {
  //General controls
  let tableCells = document.getElementsByTagName("td");

  let addButtonEl = document.createElement("div");
  addButtonEl.classList.add("add-button");
  addButtonEl.textContent = "Добавить";

  let addButton = adminContent.appendChild(addButtonEl);

  addButton.addEventListener("click", function() {
    editWrapper.style.visibility = 'visible';
    addMenu.style.display = "block";

    switch(currentPage) {
      case 'product': 
        categoryForm.style.display = "none";
        productForm.style.display = "block";
      break;
      case 'category': 
        productForm.style.display = "none";
        categoryForm.style.display = "block";
      break;
    }
  });

  for (let i = 0; i < tableCells.length; i++) {
    //Creating edit button on every editable cell
    if(!(tableCells[i].classList.contains('non-edit'))) 
    {let editButton = document.createElement("div");
    editButton.classList.add("edit-button");

    tableCells[i].appendChild(editButton);
    }

    //Creating delete button on id cell
    if(tableCells[i].classList.contains('id') && tableCells[i].classList.contains('non-edit')) {
      let deleteButton = document.createElement("div");
      deleteButton.classList.add("edit-button");
      deleteButton.classList.add("delete-button");

      tableCells[i].appendChild(deleteButton);
    }
  }

  let editButtons = document.querySelectorAll(".edit-button");

  for (let i = 0; i < editButtons.length; i++) {
    editButtons[i].addEventListener("click", function () {
      itemId = editButtons[i].parentElement.parentElement.dataset.id;
      toEdit = editButtons[i].parentElement.dataset.section;
      editWrapper.style.visibility = 'visible';
      if(!editButtons[i].classList.contains('delete-button')) {
        editMenu.style.display = 'block';
      } else {
        deleteMenu.style.display = 'block';
      }
      // editContent.value = editButtons[i].textContent; //Current text should appear in edit menu
    });
  }


  //Controls for items page

  //Controls for category page

  //Controls for orders page
};

for (let i = 0; i < navbarButtons.length; i++) { //Navbar buttons
  navbarButtons[i].addEventListener("click", function (evt) {
    evt.preventDefault();
    getPage(navbarButtons[i].dataset.id);
  });
}

getPage(defaultPage);
