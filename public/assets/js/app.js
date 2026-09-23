document.addEventListener('DOMContentLoaded', () => {
    const passwordInput = document.getElementById('password');
    const passwordToggle = document.getElementById('passwordToggle');
    const passwordToggleIcon = passwordToggle?.querySelector(
        '.password-toggle-icon'
    );

    if (!passwordInput || !passwordToggle || !passwordToggleIcon) {
        return;
    }

    passwordToggle.addEventListener('click', () => {
        const isPassword = passwordInput.type === 'password';

        passwordInput.type = isPassword ? 'text' : 'password';

        passwordToggleIcon.classList.toggle(
            'bi-eye-slash',
            !isPassword
        );

        passwordToggleIcon.classList.toggle(
            'bi-eye',
            isPassword
        );

        passwordToggle.setAttribute(
            'aria-pressed',
            String(isPassword)
        );

        passwordToggle.setAttribute(
            'aria-label',
            isPassword
                ? 'Sembunyikan password'
                : 'Tampilkan password'
        );
    });
});