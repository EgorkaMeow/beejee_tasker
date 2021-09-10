'use strict';

const login = async (e) => {
    e.preventDefault();

    let errors = {
        empty: {
            elements: [],
            err_text: 'Заполните пустые поля.',
        },
    };

    const login = document.querySelector('[name=login]');
    const login_value = document.querySelector('[name=login]').value;
    const password = document.querySelector('[name=password]');
    const password_value = document.querySelector('[name=password]').value;

    if(login_value.trim().length == 0){
        errors.empty.elements.push(login);
    }
    if(password_value.trim().length == 0){
        errors.empty.elements.push(password);
    }

    if(errors.empty.elements.length != 0){
        alert(errors.empty.err_text);
        for(let el of errors.empty.elements){
            el.classList.add('is-invalid');
            setTimeout(() => {
                el.classList.remove('is-invalid');
            }, 1000);
        }
        return;
    }

    let result = await (await fetch('./login', {
        method: 'POST', 
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            login: login_value,
            password: password_value,
        }) 
    })).text();

    if(result.indexOf('OK') !== -1){
        window.location.href = "./";
    }
    else {
        alert('Введен неверный логин или пароль.');
    }
};

window.addEventListener('load', () => {
    document.querySelector('#login_form').addEventListener('submit', login);
});