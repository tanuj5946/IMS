// document.addEventListener("DOMContentLoaded", function () {
//     document.getElementById("loginForm").addEventListener("submit", function (event) {
//         event.preventDefault(); 

//         let username = document.getElementById("username").value.trim();
//         let password = document.getElementById("password").value.trim();

//         if (username === "" || password === "") {
//             alert("Both username and password are required!");
//         } else {
//             alert("Login successful!");
          
//         }
//     });
// });
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    const usernameInput = document.getElementById('username');
    const passwordInput = document.getElementById('password');
    const errorMessage = document.getElementById('error-message');

    form.addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent the default form submission

        // Clear previous error messages
        errorMessage.style.display = 'none';
        errorMessage.textContent = '';

        // Get the values from the input fields
        const username = usernameInput.value.trim();
        const password = passwordInput.value.trim();

        // Basic validation
        if (!username || !password) {
            errorMessage.textContent = 'Please enter both username and password.';
            errorMessage.style.display = 'block';
            return;
        }

        // Simulate an API call for login
        simulateLogin(username, password);
    });

    function simulateLogin(username, password) {
        // Simulated login credentials (for demonstration purposes)
        const validUsername = 'admin';
        const validPassword = 'password123';

        // Simulate a delay for the API call
        setTimeout(() => {
            if (username === validUsername && password === validPassword) {
                // Successful login
                alert('Login successful! Redirecting...');
                // Redirect to the dashboard or home page
                window.location.href = 'dashboard.html'; // Change to your actual dashboard page
            } else {
                // Failed login
                errorMessage.textContent = 'Invalid username or password.';
                errorMessage.style.display = 'block';
            }
        }, 1000); // Simulate a 1-second delay
    }
});