function togglePasswordVisibility() {
    var passwordInput = document.getElementById("senha");
    var eyeOpen = document.getElementById("eye-open");
    var eyeClosed = document.getElementById("eye-closed");

    if (passwordInput.type === "password") {
      passwordInput.type = "text";
      eyeOpen.style.display = "none";
      eyeClosed.style.display = "inline";
    } else {
      passwordInput.type = "password";
      eyeOpen.style.display = "inline";
      eyeClosed.style.display = "none";
    }
  }