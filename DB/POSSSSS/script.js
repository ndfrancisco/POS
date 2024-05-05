const loginForm = document.getElementById('login-form');
const errorMessage = document.getElementById('error-message');

loginForm.addEventListener('submit', (event) => {
  event.preventDefault();

  // Simulate authentication (replace with actual authentication logic)
  const username = document.getElementById('username').value;
  const password = document.getElementById('password').value;

  if (username === 'admin' && password === 'password') {
    window.location.href = 'index.php'; // Redirect to dashboard on successful login
  } else {
    errorMessage.textContent = 'Invalid username or password';
  }
});