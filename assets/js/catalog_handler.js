let item = document.querySelector(".catalog-item");

let checkElementAvailability = function (element) {

  let menu = document.querySelector(".catalog-menu");
  //If query fail hide menu and stop script
  if (!element) {
    menu.style.display = "none";
    return;
  }

  //Getting data from GET for sync script value and page value
  function getAllUrlParams(url) {
    // извлекаем строку из URL или объекта window
    var queryString = url ? url.split("?")[1] : window.location.search.slice(1);

    // объект для хранения параметров
    var obj = {};

    // если есть строка запроса
    if (queryString) {
      // данные после знака # будут опущены
      queryString = queryString.split("#")[0];

      // разделяем параметры
      var arr = queryString.split("&");

      for (var i = 0; i < arr.length; i++) {
        // разделяем параметр на ключ => значение
        var a = arr[i].split("=");

        // обработка данных вида: list[]=thing1&list[]=thing2
        var paramNum = undefined;
        var paramName = a[0].replace(/\[\d*\]/, function (v) {
          paramNum = v.slice(1, -1);
          return "";
        });

        // передача значения параметра ('true' если значение не задано)
        var paramValue = typeof a[1] === "undefined" ? true : a[1];

        // преобразование регистра
        paramName = paramName.toLowerCase();
        paramValue = paramValue.toLowerCase();

        // если ключ параметра уже задан
        if (obj[paramName]) {
          // преобразуем текущее значение в массив
          if (typeof obj[paramName] === "string") {
            obj[paramName] = [obj[paramName]];
          }
          // если не задан индекс...
          if (typeof paramNum === "undefined") {
            // помещаем значение в конец массива
            obj[paramName].push(paramValue);
          }
          // если индекс задан...
          else {
            // размещаем элемент по заданному индексу
            obj[paramName][paramNum] = paramValue;
          }
        }
        // если параметр не задан, делаем это вручную
        else {
          obj[paramName] = paramValue;
        }
      }
    }

    return obj;
  }

  let sortOrder = menu.querySelector("select[name='sort_order']");
  let itemCategory = menu.querySelector("select[name='item_category']");
  let sortType = menu.querySelector("select[name='sort_type']");

  //Syncing form with GET values
  window.onload = function () {
    //Getting value from GET
    let sortTypeGet = getAllUrlParams().sort_type;
    let itemCategoryGet = getAllUrlParams().item_category;
    let sortOrderGet = getAllUrlParams().sort_order;

    //Syncing sortType with GET value
    for (let i = 0; i < sortType.length; i++) {
      if (sortType[i].value === sortTypeGet) sortType[i].selected = true;
    }
    //Syncing itemCategory with GET value
    for (let i = 0; i < itemCategory.length; i++) {
      if (itemCategory[i].value === itemCategoryGet) itemCategory[i].selected = true;
    }
    //Syncing arrow class with GET value
    for (let i = 0; i < sortOrder.length; i++) {
      if (sortOrder[i].value === sortOrderGet) sortOrder[i].selected = true; 
    }
    
  };
};

checkElementAvailability(item);
