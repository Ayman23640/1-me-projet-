// Toggle password visibility
function togglePassword() {
    const passwordInput = document.getElementById('password');
    const toggleButtons = document.querySelectorAll('.toggle-password');
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggleButtons[0].textContent = '🙈';
    } else {
        passwordInput.type = 'password';
        toggleButtons[0].textContent = '👁️';
    }
}

// Toggle confirm password visibility
function toggleConfirmPassword() {
    const confirmInput = document.getElementById('confirm_password');
    const toggleButtons = document.querySelectorAll('.toggle-password');
    
    if (confirmInput.type === 'password') {
        confirmInput.type = 'text';
        toggleButtons[1].textContent = '🙈';
    } else {
        confirmInput.type = 'password';
        toggleButtons[1].textContent = '👁️';
    }
}

// Form validation
const signupForm = document.getElementById('signupForm');
if (signupForm) {
    signupForm.addEventListener('submit', function(e) {
        const username = document.getElementById('username');
        const phone = document.getElementById('phone');
        const password = document.getElementById('password');
        const confirmPassword = document.getElementById('confirm_password');
        
        // Trim whitespace
        username.value = username.value.trim();
        phone.value = phone.value.trim();
        
        // Validate username
        if (username.value.length < 3) {
            e.preventDefault();
            showError('Username must be at least 3 characters');
            return;
        }
        
        // Validate phone (basic check)
        if (phone.value.length < 10) {
            e.preventDefault();
            showError('Phone number must be at least 10 digits');
            return;
        }
        
        // Validate password
        if (password.value.length < 6) {
            e.preventDefault();
            showError('Password must be at least 6 characters');
            return;
        }
        
        // Check password strength
        if (!isStrongPassword(password.value)) {
            e.preventDefault();
            showError('Password must contain letters, numbers, and special characters');
            return;
        }
        
        // Validate passwords match
        if (password.value !== confirmPassword.value) {
            e.preventDefault();
            showError('Passwords do not match');
            return;
        }
    });
}

// Check password strength
function isStrongPassword(password) {
    const hasLetters = /[a-zA-Z]/.test(password);
    const hasNumbers = /[0-9]/.test(password);
    // Allow if it has at least letters and numbers
    return hasLetters && hasNumbers;
}

// Show error message
function showError(message) {
    const authContainer = document.querySelector('.auth-container');
    const existingAlert = authContainer.querySelector('.alert');
    
    if (existingAlert) {
        existingAlert.remove();
    }
    
    const alert = document.createElement('div');
    alert.className = 'alert alert-error';
    alert.innerHTML = `⚠️ ${message}`;
    
    const authHeader = authContainer.querySelector('.auth-header');
    authHeader.insertAdjacentElement('afterend', alert);
    
    // Remove alert after 5 seconds
    setTimeout(() => {
        alert.remove();
    }, 5000);
}

// Real-time password match check
document.addEventListener('DOMContentLoaded', function() {
    const password = document.getElementById('password');
    const confirmPassword = document.getElementById('confirm_password');
    
    if (password && confirmPassword) {
        confirmPassword.addEventListener('input', function() {
            if (confirmPassword.value !== password.value && confirmPassword.value !== '') {
                confirmPassword.style.borderColor = '#ff6b6b';
            } else {
                confirmPassword.style.borderColor = '#e0e0e0';
            }
        });
    }
});

// Add enter key support
document.addEventListener('DOMContentLoaded', function() {
    const inputs = document.querySelectorAll('.form-group input');
    if (inputs.length > 0) {
        inputs[inputs.length - 1].addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                signupForm.submit();
            }
        });
    }
});

// Focus effects
document.addEventListener('DOMContentLoaded', function() {
    const inputs = document.querySelectorAll('.form-group input');
    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.style.transform = 'scale(1.02)';
        });
        input.addEventListener('blur', function() {
            this.parentElement.style.transform = 'scale(1)';
        });
    });
});
