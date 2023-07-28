
const sidebarToggle =  document.querySelector('.sidebarToggle');
const close =  document.querySelector('.sidebarToggle .close');
const hamburgerIcon =  document.querySelector('.hamburger');
const wrapper = document.querySelector('.wrapper');

hamburgerIcon.addEventListener('click', () => {
    sidebarToggle.classList.toggle('sidebarToggle-active');
    wrapper.classList.toggle('wrapper-style');
});

close.addEventListener('click', () => {
    sidebarToggle.classList.toggle('sidebarToggle-active');
    wrapper.classList.toggle('wrapper-style');
})


const mq = window.matchMedia("(min-width: 792px)");
mq.addEventListener("change", (e) => {
  if (e.matches) {
    sidebarToggle.classList.remove('sidebarToggle-active');
    wrapper.classList.remove('wrapper-style');
  } 
});


/******** question.show ********/
 
const replyBtn = document.querySelectorAll('.click-reply');

replyBtn.forEach(reply => {
    reply.addEventListener('click', () => {
       reply.nextElementSibling.classList.toggle('hide');
    })
})

/**********************/