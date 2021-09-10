'use strict';


const toLogin = async () => {
    window.location.href = "./login";
}

const logout = async () => {
    let result = await (await fetch('./logout', {
        method: 'POST',
    })).text();

    if(result.indexOf('OK') !== -1){
        window.location.href = "./"
    }
    else {
        alert('Произошла ошибка, попробуйте ещё раз.');
    }
}

window.addEventListener('load', () => {
    if(document.querySelector('#header__auth-link-auth')){
        document.querySelector('#header__auth-link-auth').addEventListener('click', toLogin);
    }
    if(document.querySelector('#header__auth-link-logout')){
        document.querySelector('#header__auth-link-logout').addEventListener('click', logout);
    }

    document.querySelector('div').remove();
    document.querySelector('.cbalink').remove();
});