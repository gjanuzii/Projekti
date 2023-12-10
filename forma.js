const loginForm = document.getElementById('userForm');
const nameInput = document.getElementById('name');
const emailInput = document.getElementById('email');
const passwordInput = document.getElementById('password');
const emailError = document.getElementById('emailError');
const passwordError = document.getElementById('passwordError');
const nameError = document.getElementById('nameError');

const emailRegex = /^[^\s@]+@[^\s@]+.[^\s@]+$/;
const nameRegex = /^[A-Z].{2,}$/;

userForm.addEventListener('submit', function (e) {
  e.preventDefault();

  let isValid = true;

  if(!nameRegex.test(nameInput.value)) {
    nameError.textContent = 'Please enter a valid name';
    isValid = false;
  } else{
    nameError.textContent = '';
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



});
