let form = document.querySelector('.form__login');

// get error message if available
const queryString = window.location.search;
const urlParams = new URLSearchParams(queryString);
const errorMsg = urlParams.get('error');
if (errorMsg) {
    form.setAttribute('data-error', errorMsg);
}