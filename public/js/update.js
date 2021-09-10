'use strict';

const update = async (e) => {
    e.preventDefault();

    let errors = {
        empty: {
            elements: [],
            err_text: 'Заполните пустые поля.',
        },
    };

    const text = document.querySelector('[name=text]');
    const text_value = document.querySelector('[name=text]').value;
    const done = document.querySelector('[name=done]');

    if(text_value.trim().length == 0){
        errors.empty.elements.push(text);
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

    let result = await (await fetch('/task/' + document.querySelector('[name=task_id]').value, {
        method: 'PATCH', 
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            text: text_value,
            done: done.checked ? 1 : 0,
        }) 
    })).text();



    if(result.indexOf('OK') !== -1){
        alert('Задача обновлена!');
    }
    else if(result.indexOf('NOT AUTH') !== -1){
        alert('Вы не авторизованы!');
        window.location.href = "../../login";
    }
    else {
        alert('Произошла ошибка, попробуйте ещё раз.');
    }
}

window.addEventListener('load', () => {
    document.querySelector('#update_form').addEventListener('submit', update);
});