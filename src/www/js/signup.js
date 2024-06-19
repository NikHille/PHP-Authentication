let form = document.querySelector('.form__register');
let inputs = form.querySelectorAll('input:not([type="hidden"])');

// get error message if available
const queryString = window.location.search;
const urlParams = new URLSearchParams(queryString);
const errorMsg = urlParams.get('error');
if (errorMsg) {
    form.setAttribute('data-error', errorMsg);
}


form.addEventListener('submit', formSubmit);


inputs.forEach(input => {
    input.addEventListener('change', (e) => {
        validateInput(e.target);
    });
});


/**
 * Handle the signup form event. Before sumbitting, check for valid inputs.
 * @param {Event} e The form submit event.
 */
function formSubmit(e) {
    e.preventDefault();
    let validForm = true;
    inputs.forEach(input => {
        if (!validateInput(input)) validForm = false;
    });
    
    if (validForm) {
        form.submit();
    } else form.setAttribute('data-error', 'invalidinput');
}


/**
 * Validates an input value.
 * @param {Element} input Input element which is to be validated.
 * @returns {Boolean} Returns true for valid inputs, false for invalid ones.
 */
function validateInput(input) {
    let result;
    if (input.name === 'email') {
        let regex = /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/;
        result = regex.test(input.value);
        validateInput(inputs[1]);
    }
    if (input.name === 'pwd') {
        let regexArr = [
            /[A-Z]/, /[a-z]/, /[0-9]/, /[*$%!^#]/
        ];
        result = input.value.length >= 8 ? true : false;
        for (let i = 0; i < regexArr.length; i++) {
            if (!result) break;
            result = regexArr[i].test(input.value);
        }
        validateInput(inputs[3]);
    }
    if (input.name === 'email_rpt') {
        result = input.value === form.querySelector('[name="email"]').value;
    }
    if (input.name === 'pwd_rpt') {
        result = input.value === form.querySelector('[name="pwd"]').value;
    }
    updateInput(input, result);
}


function updateInput(input, valid) {
    if (valid) input.classList.remove('invalid');
    else input.classList.add('invalid');
}