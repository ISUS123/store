let header = document.querySelector('header');
let navTrigger = header.querySelector(".nav-trigger");

navTrigger.addEventListener('click', function() {
    if(header.classList.contains('unfolded')) {
        header.classList.remove('unfolded');
    } else {
        header.classList.add('unfolded');
    }
})