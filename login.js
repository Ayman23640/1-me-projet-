// Toggle password visibility
function togglePassword() {
    const passwordInput = document.getElementById('password');
    const toggleButton = document.querySelector('.toggle-password');
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggleButton.textContent = '🙈';
    } else {
        passwordInput.type = 'password';
        toggleButton.textContent = '👁️';
    }
}

// Get form reference
const loginForm = document.getElementById('loginForm');

// Form validation
if (loginForm) {
    loginForm.addEventListener('submit', function(e) {
        const username = document.getElementById('username');
        const password = document.getElementById('password');
        
        // Trim whitespace
        username.value = username.value.trim();
        
        // Validate username
        if (username.value.length < 3) {
            e.preventDefault();
            showError('Username must be at least 3 characters');
            return;
        }
        
        // Validate password
        if (password.value.length < 6) {
            e.preventDefault();
            showError('Password must be at least 6 characters');
            return;
        }
        
        // Save username if remember me is checked
        const rememberCheckbox = document.getElementById('remember');
        if (rememberCheckbox && rememberCheckbox.checked) {
            localStorage.setItem('kafood_username', username.value);
        } else {
            localStorage.removeItem('kafood_username');
        }
    });
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

// Remember me functionality - load saved username on page load
window.addEventListener('load', function() {
    const rememberCheckbox = document.getElementById('remember');
    const usernameInput = document.getElementById('username');
    
    if (usernameInput && rememberCheckbox) {
        const savedUsername = localStorage.getItem('kafood_username');
        if (savedUsername) {
            usernameInput.value = savedUsername;
            rememberCheckbox.checked = true;
        }
    }
});

// Add enter key support
document.addEventListener('DOMContentLoaded', function() {
    const passwordInput = document.getElementById('password');
    if (passwordInput && loginForm) {
        passwordInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                loginForm.submit();
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
