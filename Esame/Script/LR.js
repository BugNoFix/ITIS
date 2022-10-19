const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const container = document.getElementById('container');

signUpButton.addEventListener('click', () => {
	container.classList.add("right-panel-active");
});

signInButton.addEventListener('click', () => {
	container.classList.remove("right-panel-active");
});

// Check if button of menu was login or register
var url = new URL(window.location.href);
var x = url.searchParams.get("x");
if (x == 2)
	container.classList.add("right-panel-active");
else
	container.classList.remove("right-panel-active");