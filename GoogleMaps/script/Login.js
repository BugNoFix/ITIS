const sign_in_btn = document.querySelector("#sign-in-btn");
const sign_up_btn = document.querySelector("#sign-up-btn");
const container = document.querySelector(".container");

sign_up_btn.addEventListener("click", () => {
  container.classList.add("sign-up-mode");
});

sign_in_btn.addEventListener("click", () => {
  container.classList.remove("sign-up-mode");
});

var url = new URL(window.location.href);
var x = url.searchParams.get("x");
if (x == 1)
	container.classList.add("sign-up-mode");
else
	container.classList.remove("sign-up-mode");