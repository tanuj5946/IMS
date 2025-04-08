document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    const successMessage = document.getElementById('success-message');
    const errorMessage = document.getElementById('error-message');

    form.addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent the default form submission

        // Simulate an API call
        const email = document.getElementById('email').value;

        if (email) {
            // Simulate success
            successMessage.style.display = 'block';
            errorMessage.style.display = 'none';
        } else {
            // Simulate error
            errorMessage.textContent = 'Please enter a valid email address.';
            errorMessage.style.display = 'block';
            successMessage.style.display = 'none';
        }
    });
});