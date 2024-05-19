const loginForm = document.getElementById('login-form');
const errorMessage = document.getElementById('error-message');

loginForm.addEventListener('submit', (event) => {
  event.preventDefault();

  const formData = new FormData(loginForm);

  fetch('submit.php', {
    method: 'POST',
    body: formData
  })
  .then(response => {
    if (response.ok) {
      window.location.href = 'index.php'; // Redirect to dashboard on successful login
    } else {
      errorMessage.textContent = 'Invalid username or password';
    }
  })
  .catch(error => {
    console.error('Error:', error);
  });
});
