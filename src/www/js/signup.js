let form = document.querySelector('.form__register');
let inputs = form.querySelectorAll('input:not([type="hidden"])');


form.addEventListener('submit', formSubmit);


inputs.forEach(input => {
    input.addEventListener('change', (e) => {
        let result = validateInput(e.target);
        if (result) e.target.classList.remove('invalid');
        else e.target.classList.add('invalid');
    });
});


function formSubmit(e) {
    
}


/**
 * Validates an event targets value.
 * @param {Event} input Change event for an form input.
 * @returns {Boolean} Returns true for valid or empty inputs, for invalid inputs false.
 */
function validateInput(input) {
    if (input.type === 'email') {
        let regex = /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/;
        let result = regex.test(input.value);
        return result;
    }
    if (input.type === 'password') {
        let regexArr = [
            /[A-Z]/, /[a-z]/, /[0-9]/, /[*$%!^]/
        ];
        let result = input.value.length >= 8 ? true : false;
        for (let i = 0; i < regexArr.length; i++) {
            if (!result) break;
            result = regexArr[i].test(input.value);
        }
        return result;
    }
}