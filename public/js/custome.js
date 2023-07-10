window.onload = function(){
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
    
}