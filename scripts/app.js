class Clipboard {
  copy(textToCopy) {
    // navigator clipboard api needs a secure context (https)
    if (navigator.clipboard && window.isSecureContext) {
      // navigator clipboard api method'
      return navigator.clipboard.writeText(textToCopy);
    } else {
      // text area method
      let textArea = document.createElement("textarea");
      textArea.value = textToCopy;
      // make the textarea out of viewport
      textArea.style.position = "fixed";
      textArea.style.left = "-999999px";
      textArea.style.top = "-999999px";
      document.body.appendChild(textArea);
      textArea.focus();
      textArea.select();
      return new Promise((res, rej) => {
        // here the magic happens
        document.execCommand("copy") ? res() : rej();
        textArea.remove();
      });
    }
  }
}

const myBoard = new Clipboard();

const registerForm = $("form#register"),
  loginForm = $("form#login");

const captcha = document.querySelector("#captcha");
const userCode = document.querySelector("#userCode");

const captchaCode = Math.floor(Math.random() * 123456);

captcha.value = captchaCode;
captcha.innerHTML = captcha.value

if (registerForm[0])
  registerForm[0].addEventListener("submit", (e) =>
    DUPLICATE(e, "register", registerForm)
  );
else if (loginForm[0])
  loginForm[0].addEventListener("submit", (e) =>
    DUPLICATE(e, "login", loginForm)
  );
function DUPLICATE(e, page, form) {
  e.preventDefault();
  const information = JSON.stringify(form.serializeArray());

  if (captcha) {
    if (captchaCode.toString().split("").reverse().join("") === userCode.value) {
      fetch(
        page === "register"
          ? `server/${page}.php?${page}=${information}`
          : `../server/${page}.php?${page}=${information}`
      )
        .then((response) => response.json())
        .then((response) => {
          Swal.fire({
            icon: "info",
            title: response.data,
          });
        });
    } else {
      Swal.fire({
        icon: "error",
        title: "درست وارد کن بچه :|",
      });
    }
  }
}

// (B) PREVENT CLIPBOARD COPYING
document.addEventListener(
  "copy",
  (evt) => {
    disableselect()
    myBoard.copy("بشین تا کپی شه :)");
    evt.preventDefault();
  },
  false
);


function disableselect(e) {
  return false
}

function reEnable() {
  return true
}

document.onselectstart = new Function ("return false")

if (window.sidebar) {
  document.onmousedown = disableselect
  document.onclick = reEnable
}
