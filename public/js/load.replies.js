const hideReplyBtn = document.querySelectorAll('.hide-replies');
const loadReplyBtn = document.querySelectorAll('.load-replies');


hideReplyBtn.forEach(hide => {
    hide.addEventListener('click', () => {
        const parent = hide.parentElement;
        hide.parentElement.classList.toggle('reply-section-hide');
        parent.previousElementSibling.classList.toggle('load-replies-active');
        console.log(hide.previousElementSibling)
    })
})

loadReplyBtn.forEach(load => {
    load.addEventListener('click', () => { 
        load.nextElementSibling.classList.toggle('reply-section-hide');
        load.classList.toggle('load-replies-active');
    })
})