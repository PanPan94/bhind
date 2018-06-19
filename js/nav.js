let toggler = document.querySelector('#nav-toggler')
let nav = document.querySelector('#nav-nav')
let opened = false
toggler.addEventListener('click', () => {
    if(!opened) {
        nav.style.transform = 'translateX(0)'
        opened = true
    }else if(opened) {
        nav.style.transform = 'translateX(100%)'
        opened = false
    }
})