//Quiz

let quizMenu = document.querySelector(".quiz-wrapper");
let quizForm = quizMenu.querySelector(".quiz");
let quizResult = quizMenu.querySelector(".quiz-result");
let quizResultText = quizResult.querySelector(".result-text");
let showQuiz = document.querySelector(".show-quiz");
let hideQuiz = quizMenu.querySelector(".hide");
let form = quizMenu.querySelector(".standard-form");

//Show form
showQuiz.addEventListener("click", function () {
  quizMenu.style.animation = "showQuiz 0.5s ease";
  quizMenu.style.visibility = "visible";
  quizForm.style.animation = "showQuiz 0.5s ease";
  quizForm.style.visibility = "visible";
});
//Hide form (cross button)
hideQuiz.addEventListener("click", function () {
  quizMenu.style.animation = "hideQuiz 0.5s ease";
  quizMenu.style.visibility = "hidden";
  quizForm.style.animation = "hideQuiz 0.5s ease";
  quizForm.style.visibility = "hidden";
});

//Questions for form
questions = [
  {
    q: "Название компании: ",
    a: "copystar",
  },
  {
    q: "Имя основателя: ",
    a: "иван",
  },
  {
    q: "Дата основания: ",
    a: "2004",
  },
  {
    q: "Город в котором находится главный офис: ",
    a: "москва",
  },
  {
    q: "Специализация компании: ",
    a: "копировальное оборудование",
  },
];

//Making form label, input from questions
for (let i = 0; i < questions.length; i++) {
  let div = document.createElement("div");
  form.appendChild(div);
  let label = document.createElement("label");
  label.textContent = questions[i].q;
  div.appendChild(label);
  let input = document.createElement("input");
  input.type = "text";
  input.required = true;
  div.appendChild(input);
}

//Making button for sending form
let button = document.createElement("input");
button.type = "submit";
button.value = "Отправить";
let div = document.createElement("div");
form.appendChild(div);
let div1 = document.createElement("div");
div.appendChild(div1); //Additional div for align right
div.appendChild(button);

let formButton = quizMenu.querySelector("input[type='submit']"); //Button for send form

form.addEventListener("submit", function (evt) {
  evt.preventDefault();
  let score = 0; //Score for right answers
  let answers = quizMenu.querySelectorAll("input[type='text']"); //Get inputs
  for (let i = 0; i < answers.length; i++) {
    if (answers[i].value.toLowerCase() === questions[i].a) {
      score += 1;
    }
    //Clear inputs
    answers.values = "";
  }

  //Hide quiz form
  quizForm.style.animation = "hideQuiz 0.5s ease";
  quizForm.style.visibility = "hidden";
  //Show rezult
  quizResult.style.animation = "showQuiz 0.5s ease";
  quizResult.style.visibility = "visible";

  quizResultText.textContent =
    "Набрано " + score + " из " + questions.length + " баллов";

  quizResult.addEventListener("click", function () { //On result box click, hide result box
    quizResult.style.animation = "hideQuiz 0.5s ease";
    quizResult.style.visibility = "hidden";

    quizMenu.style.animation = "hideQuiz 0.5s ease";
    quizMenu.style.visibility = "hidden";
  });
});

//Slider

let catalogItem = document.querySelectorAll(".catalog-item");
let width = catalogItem[0].getBoundingClientRect().width;
let slider = document.querySelector(".slider");
let sliderContent = document.querySelector(".slider-content");
let sliderContentWidth = sliderContent.getBoundingClientRect().width;

let checkElementAvailability = function (element) {
  let leftButton = document.querySelector(".left");
  let rightButton = document.querySelector(".right");
  if (element.length < 5) {
    //If error, hide slider or show error message
    slider.style.display = "none";
    // leftButton.style.display = "none";
    // rightButton.style.display = "none";
    return;
  }

  let sliderLine = document.querySelector(".slider-line");
  let offset = 0;

  let autoScale = function() {
    sliderContentWidth = sliderContent.getBoundingClientRect().width;
    for(let i = 0; i < catalogItem.length; i++) {
      catalogItem[i].style.minWidth = sliderContentWidth - 20 + "px";
    }
    sliderLine.style.left = 0 + "px";
    offset = 0;
  }

  window.onload = autoScale;

  setTimeout(function() {autoScale();}, 500);
  
  window.onresize = autoScale;

  leftButton.addEventListener("click", function () {
    width = catalogItem[0].getBoundingClientRect().width + 10;
    offset += width;
    if (offset >= width) {
      //if left border reached
      offset = 0; //set first item
      catalogItem[0].classList.add("shake-left");
      catalogItem[0].addEventListener("animationend", animationEndCallback);
    }
    sliderLine.style.left = offset + "px";
  });

  animationEndCallback = function () {
    catalogItem[0].removeEventListener("animationend", animationEndCallback);
    catalogItem[0].classList.remove("shake-left");
    catalogItem[4].removeEventListener("animationend", animationEndCallback);
    catalogItem[4].classList.remove("shake-right");
  };

  rightButton.addEventListener("click", function () {
    width = catalogItem[0].getBoundingClientRect().width + 10;
    offset -= width;
    if (offset <= -width*5) {
      //if right border reached
      offset = offset+width; //set previous item
      catalogItem[4].classList.add("shake-right");
      catalogItem[4].addEventListener("animationend", animationEndCallback);
    }
    sliderLine.style.left = offset + "px";
  });

  for(let i = 0; i < catalogItem.length; i++) {
    catalogItem[i].addEventListener('click', function() {
      let sliderWidth = slider.getBoundingClientRect().width;
      if(sliderWidth <= 677) {
        let itemId = catalogItem[i].dataset.id;
        window.location.href = "product?product_id=" + itemId;
      }
    })
  }
};


checkElementAvailability(catalogItem);
