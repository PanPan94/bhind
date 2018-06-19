window.addEventListener('load', function() {
    let slideout = new Slideout({
        'panel': document.getElementById('panel'),
        'menu': document.getElementById('menu'),
        'padding': 256,
        'tolerance': 70
    });
    let opened = slideout.isOpen()
    document.querySelector('#navbar-toggler').addEventListener('click', () =>  slideout.toggle())
    document.querySelector('#panel').addEventListener('click', e => {
        if(slideout.isOpen() && document.querySelector('html').classList.contains('slideout-open')) {
            e.preventDefault()
            slideout.close()
        }
    }, true)
    
})