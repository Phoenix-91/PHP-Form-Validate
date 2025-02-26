// DOM Elements
const loginForm = document.getElementById('login-form');
const registerForm = document.getElementById('register-form');
const toggleBtn = document.getElementById('toggle-btn');
const sideTitle = document.getElementById('side-title');
const sideText = document.getElementById('side-text');

// State
let isLoginForm = true;

// Toggle between login and register forms
toggleBtn.addEventListener('click', () => {
    if (isLoginForm) {
        // Switch to register form
        loginForm.classList.add('hidden');
        registerForm.classList.remove('hidden');
        registerForm.classList.add('animate-fadeIn');
        toggleBtn.textContent = 'Login';
        sideTitle.textContent = 'Welcome Back!';
        sideText.textContent = 'Already have an account?';
    } else {
        // Switch to login form
        registerForm.classList.add('hidden');
        loginForm.classList.remove('hidden');
        loginForm.classList.add('animate-fadeIn');
        toggleBtn.textContent = 'Register';
        sideTitle.textContent = 'Hello, Welcome!';
        sideText.textContent = 'Don\'t have an account?';
    }
    
    isLoginForm = !isLoginForm;
});

// Form validation and submission
document.getElementById('loginForm').addEventListener('submit', function(e) {
    const username = document.getElementById('login-username').value;
    const password = document.getElementById('login-password').value;
    
    if (!username || !password) {
        e.preventDefault();
        alert('Please fill in all fields');
    }
});

document.getElementById('registerForm').addEventListener('submit', function(e) {
    const username = document.getElementById('register-username').value;
    const email = document.getElementById('register-email').value;
    const password = document.getElementById('register-password').value;
    
    if (!username || !email || !password) {
        e.preventDefault();
        alert('Please fill in all fields');
    }
    
    // Basic email validation
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        e.preventDefault();
        alert('Please enter a valid email address');
    }
    
    // Basic password validation (at least 6 characters)
    if (password.length < 6) {
        e.preventDefault();
        alert('Password must be at least 6 characters long');
    }
});

// Add smooth hover effects to all buttons
const buttons = document.querySelectorAll('button');
buttons.forEach(button => {
    button.addEventListener('mouseenter', () => {
        button.style.transition = 'all 0.3s ease';
    });
});