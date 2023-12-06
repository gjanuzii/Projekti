const registerForm = document.getElementById('userForm');
const nameInput = document.getElementById('name');
const surnameInput = document.getElementById('surname');
const emailInput = document.getElementById('email');
const passwordInput = document.getElementById('password');
const cpasswordInput = document.getElementById('cpassword');
const nameError = document.getElementById('nameError');
const surnameError = document.getElementById('surnameError');
const emailError = document.getElementById('emailError');
const passwordError = document.getElementById('passwordError');
const cpasswordError = document.getElementById('cpasswordError');

const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
const nameRegex = /^[A-Z].{2,}$/;
const surnameRegex = /^[A-Z].{4,}$/;

userForm.addEventListener('submit', function (e) {
  e.preventDefault();

  let isValid = true;

  if(!nameRegex.test(nameInput.value)) {
    nameError.textContent = 'Please enter a valid name';
    isValid = false;
  } else{
    nameError.textContent = '';
  }

  if(!surnameRegex.test(surnameInput.value)) {
    surnameError.textContent = 'Please enter a valid surname';
    isValid = false;
  } else{
    surnameError.textContent = '';
  }

  if (!emailRegex.test(emailInput.value)) {
    emailError.textContent = 'Please enter a valid email address';
    isValid = false;
  } else {
    emailError.textContent = '';
  }

  if (passwordInput.value.length < 6) {
    passwordError.textContent = 'Password must be at least 6 characters';
    isValid = false;
  } else {
    passwordError.textContent = '';
  }

  if (!(cpasswordInput.value == passwordInput.value)) {
    cpasswordError.textContent = 'Please write your password correctly';
    isValid = false;
  }else {
    cpasswordError.textContent = '';
  }

});







//LogIn


const loginForm = document.getElementById('userlogForm');

const l_nameInput = document.getElementById('l_name');
const l_nameError = document.getElementById('l_nameError'); 
const l_emailInput = document.getElementById('l_email');
const l_emailError = document.getElementById('l_emailError');
const l_passwordInput = document.getElementById('l_password');
const l_passwordError = document.getElementById('l_passwordError');  

const l_emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
const l_nameRegex = /^[A-Z].{2,}$/;

function validateForm() {
  let isValid = true;

  if (!l_nameRegex.test(l_nameInput.value)) {
    l_nameError.textContent = 'Please enter a valid name';
    isValid = false;
  } else {
    l_nameError.textContent = '';
  }

  if (!l_emailRegex.test(l_emailInput.value)) {
    l_emailError.textContent = 'Please enter a valid email address';
    isValid = false;
  } else {
    l_emailError.textContent = '';
  }

  if (l_passwordInput.value.length < 6) {
    l_passwordError.textContent = 'Password must be at least 6 characters';
    isValid = false;
  } else {
    l_passwordError.textContent = '';
  }

  if (isValid) {
    window.location.href = '../index.html';
  }
}
const loginButton = document.querySelector('.l_button');
loginButton.addEventListener('click', function (e) {
  e.preventDefault();
  validateForm();
});
