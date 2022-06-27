const registerForm = $("form#register"),loginForm = $("form#login");
if (registerForm[0]) 
  registerForm[0].addEventListener("submit", e => DUPLICATE(e, "register", registerForm));
else if (loginForm[0]) 
  loginForm[0].addEventListener("submit", e => DUPLICATE(e, "login", loginForm));
function DUPLICATE(e, page, form) {
  e.preventDefault();
  const information = JSON.stringify(form.serializeArray());
  fetch(page === "register" ? 
  `server/${page}.php?${page}=${information}` : 
  `../server/${page}.php?${page}=${information}`)
  .then(response => response.json())
  .then(response => { 
    Swal.fire({
      icon: 'info',
      title: response.data,
    })
  }) 
}
