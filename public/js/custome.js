// new MetisMenu("#side-menu");
window.onload = function(){
    // Alert
    let simpleAlert = document.getElementsByClassName('simple-alert');
    let closeBtn = document.getElementsByClassName('alert-close');
    // Convert HTMLCollection to an array
    let closeBtnArr = Array.from(closeBtn);
    let simpleAlertArr = Array.from(simpleAlert);

    closeBtnArr.forEach((btn, index) => {
        btn.addEventListener('click', () => {
            let alert = btn.closest('.simple-alert');
            alert.classList.remove('simple-alert-show')
        });
    })
    
    // Menu
    if(window.innerWidth <= 1138){
        let activeMenu = document.getElementsByClassName('mm-active')[0];
        activeMenu.querySelector('ul').classList.remove('mm-collapsing');
        activeMenu.querySelector('ul').style.height = 'auto';
    
        let sideMenu = document.getElementById('side-menu');
        let menus = sideMenu.getElementsByTagName('li');
        menus.forEach((item) => {
            item.addEventListener('click', function(){
                // item.querySelector('ul').classList.toggle('mm-collapse')
                item.querySelector('ul').classList.toggle('mm-show')
                let itemHeight = item.querySelector('ul').style.height
                if(itemHeight == 'auto'){
                    itemHeight = '0';
                    // item.querySelector('a').classList.remove('nav-menu')
                    item.querySelector('a').classList.toggle('nav-menu-open')
                }else{
                    itemHeight = 'auto';
    
                    // item.querySelector('a').classList.remove('nav-menu-open')
                    item.querySelector('a').classList.toggle('nav-menu-open')
    
                }
            })
        })
    }
    

    

    
    
}

