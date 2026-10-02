(() => {
    const form = document.querySelector('#login-form');
    const emailInput = document.querySelector('#login-email');
    const passwordInput = document.querySelector('#login-password');

    const emailError = document.querySelector('#email-error');
    const passwordError = document.querySelector('#password-error');

    const togglePasswordButton = document.querySelector('#toggle-password');
    const passwordVisibilityIcon = document.querySelector(
        '#password-visibility-icon'
    );

    const submitButton = document.querySelector('#login-submit');
    const statusMessage = document.querySelector('#login-status');

    if (
        !form ||
        !emailInput ||
        !passwordInput ||
        !emailError ||
        !passwordError ||
        !togglePasswordButton ||
        !passwordVisibilityIcon ||
        !submitButton ||
        !statusMessage
    ) {
        return;
    }

    function showFieldError(input, errorElement, message) {
        input.setAttribute('aria-invalid', 'true');
        errorElement.textContent = message;
        errorElement.hidden = false;
    }

    function clearFieldError(input, errorElement) {
        input.removeAttribute('aria-invalid');
        errorElement.textContent = '';
        errorElement.hidden = true;
    }

    function clearStatus() {
        statusMessage.textContent = '';
        statusMessage.removeAttribute('data-state');
    }

    function showStatus(message, state = 'info') {
        statusMessage.dataset.state = state;
        statusMessage.textContent = message;
    }

    function validateEmail() {
        emailInput.value = emailInput.value.trim();

        if (emailInput.value === '') {
            showFieldError(
                emailInput,
                emailError,
                'Please enter your email address.'
            );

            return false;
        }

        if (!emailInput.validity.valid) {
            showFieldError(
                emailInput,
                emailError,
                'Enter a valid email address, such as you@example.com.'
            );

            return false;
        }

        clearFieldError(emailInput, emailError);

        return true;
    }

    function validatePassword() {
        if (passwordInput.value.length === 0) {
            showFieldError(
                passwordInput,
                passwordError,
                'Please enter your password.'
            );

            return false;
        }

        clearFieldError(passwordInput, passwordError);

        return true;
    }

    function setPasswordVisibility(visible) {
        passwordInput.type = visible ? 'text' : 'password';

        togglePasswordButton.setAttribute(
            'aria-label',
            visible ? 'Hide password' : 'Show password'
        );

        togglePasswordButton.setAttribute(
            'aria-pressed',
            String(visible)
        );

        passwordVisibilityIcon.setAttribute(
            'href',
            visible ? '#icon-eye-off' : '#icon-eye'
        );
    }

    togglePasswordButton.addEventListener('click', () => {
        const shouldShowPassword = passwordInput.type === 'password';

        setPasswordVisibility(shouldShowPassword);
    });

    emailInput.addEventListener('blur', () => {
        validateEmail();
    });

    passwordInput.addEventListener('blur', () => {
        validatePassword();
    });

    emailInput.addEventListener('input', () => {
        clearStatus();

        if (emailInput.getAttribute('aria-invalid') === 'true') {
            clearFieldError(emailInput, emailError);
        }
    });

    passwordInput.addEventListener('input', () => {
        clearStatus();

        if (passwordInput.getAttribute('aria-invalid') === 'true') {
            clearFieldError(passwordInput, passwordError);
        }
    });

    form.addEventListener('submit', (event) => {
        event.preventDefault();
        clearStatus();

        const emailIsValid = validateEmail();
        const passwordIsValid = validatePassword();

        if (!emailIsValid || !passwordIsValid) {
            showStatus(
                'Please check the highlighted fields.',
                'error'
            );

            if (!emailIsValid) {
                emailInput.focus();
            } else {
                passwordInput.focus();
            }

            return;
        }

        setPasswordVisibility(false);
        passwordInput.value = '';

        showStatus(
            'The form preview is working. Account verification is not connected yet, so you have not been signed in. No sign-in details were sent or saved.'
        );
    });

    form.noValidate = true;
    togglePasswordButton.disabled = false;
    submitButton.disabled = false;
})();