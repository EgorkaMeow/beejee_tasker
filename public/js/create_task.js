'use strict';

const openCreateTaskWindow = () => {
    document.getElementById('create_task__container').style.display = 'flex';
}

const closeCreateTaskWindow = () => {
    document.getElementById('create_task__container').style.display = 'none';
}

const validateEmail = (email) => {
    const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
};

const sendCreateTask = async (e) => {
    e.preventDefault();

    let errors = {
        empty: {
            elements: [],
            err_text: 'Заполните пустые поля.',
        },
        email: {
            elements: [],
            err_text: 'Некорректный email.',
        }
    };

    const user = document.querySelector('[name=user]');
    const user_value = document.querySelector('[name=user]').value;
    const email = document.querySelector('[name=email]');
    const email_value = document.querySelector('[name=email]').value;
    const text = document.querySelector('[name=text]');
    const text_value = document.querySelector('[name=text]').value;

    if(user_value.trim().length == 0){
        errors.empty.elements.push(user);
    }
    if(email_value.trim().length == 0){
        errors.empty.elements.push(email);
    }
    if(text_value.trim().length == 0){
        errors.empty.elements.push(text);
    }
    if(!validateEmail(email_value)){
        errors.email.elements.push(email);
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

    if(errors.email.elements.length != 0){
        alert(errors.email.err_text);
        for(let el of errors.email.elements){
            el.classList.add('is-invalid');
            (setTimeout(() => {
                el.classList.remove('is-invalid');
            }, 1000))(el);
        }
        return;
    }

    let result = await (await fetch('./task', {
        method: 'POST', 
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            user: user_value,
            email: email_value,
            text: text_value,
        }) 
    })).text();

    result = result.slice(0, result.indexOf('<!-- zzz'));

    if(!isNaN(result)){
        alert('Задача успешно создана');
        window.location.reload();
    }
    else {
        alert('Произошла ошибка, попробуйте ещё раз.');
    }
};

window.addEventListener('load', () => {
    document.querySelector('#header__auth-link-create').addEventListener('click', openCreateTaskWindow);
    document.querySelector('.create_task-close').addEventListener('click', closeCreateTaskWindow);
    document.querySelector('#create_form').addEventListener('submit', sendCreateTask);
});