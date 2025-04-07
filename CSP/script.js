function toggleForm(form) {
    const loginForm = document.getElementById('login-form');
    const signupForm = document.getElementById('signup-form');
    const loginToggle = document.getElementById('login-toggle');
    const signupToggle = document.getElementById('signup-toggle');

    if (form === 'login') {
        loginForm.classList.add('active');
        signupForm.classList.remove('active');
        loginToggle.classList.add('active');
        signupToggle.classList.remove('active');
    } else {
        signupForm.classList.add('active');
        loginForm.classList.remove('active');
        signupToggle.classList.add('active');
        loginToggle.classList.remove('active');
    }
}

