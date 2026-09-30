const loginForm = document.getElementById("login-form");
const registerForm = document.getElementById("register-form");
const passwordReset = document.getElementById("lost-password-link");
const loginField = document.getElementById("keystone-login-fields");
const resetField = document.getElementById("keystone-reset-fields");
const backToLogin = document.getElementById("back-to-login");
const resetBtn = document.getElementById("reset-submit-btn");
const setPasswordBtn = document.getElementById("save-password-btn");

if (passwordReset) {
  passwordReset.addEventListener("click", (e) => {
    e.preventDefault();
    loginField.style.display = "none";
    resetField.style.display = "flex";
    passwordReset.style.display = "none";
    backToLogin.style.display = "block";
  });
}

if (backToLogin) {
  backToLogin.addEventListener("click", (e) => {
    e.preventDefault();
    loginField.style.display = "flex";
    resetField.style.display = "none";
    passwordReset.style.display = "block";
    backToLogin.style.display = "none";
  });
}

if (resetBtn) {
  resetBtn.addEventListener("click", async (e) => {
    e.preventDefault();
    const formData = new FormData();
    const email = document.getElementById("reset-email").value;
    formData.append("email", email);
    formData.append("action", "keystone_reset_password");
    formData.append("security", keystone_auth.nonce);

    try {
      const response = await fetch(keystone_auth.ajax_url, {
        method: "POST",
        body: formData,
      });
      const data = await response.json();
      const loginMessage = document.getElementById("login-message");
      if (data.success) {
        loginMessage.innerHTML = data.data.message;
        loginMessage.classList.add("keystone-auth-success");
      } else {
        loginMessage.innerHTML = data.data.message;
        loginMessage.classList.remove("keystone-auth-success");
      }
    } catch (error) {
      console.log(error);
    }
  });
}

if (setPasswordBtn) {
  setPasswordBtn.addEventListener("click", async (e) => {
    e.preventDefault();

    // 1. Grab all the values, including the hidden ones
    const newPass = document.getElementById("new-password").value;
    const confirmPass = document.getElementById("confirm-new-password").value;
    const resetKey = document.getElementById("reset-key").value;
    const resetLogin = document.getElementById("reset-login").value;
    const loginMessage = document.getElementById("login-message");

    // 2. Frontend Gatekeeper: Do the passwords match?
    if (newPass !== confirmPass) {
      loginMessage.innerHTML = "Passwords do not match.";
      loginMessage.classList.remove("keystone-auth-success");
      return; // This stops the script from continuing!
    }

    // 3. Build the payload
    const formData = new FormData();
    formData.append("action", "keystone_set_new_password");
    formData.append("security", keystone_auth.nonce);
    formData.append("key", resetKey);
    formData.append("login", resetLogin);
    formData.append("password", newPass);

    // 4. Send the request
    try {
      const response = await fetch(keystone_auth.ajax_url, {
        method: "POST",
        body: formData,
      });
      const data = await response.json();

      if (data.success) {
        loginMessage.innerHTML = data.data.message;
        loginMessage.classList.add("keystone-auth-success");

        // Redirect them back to the login page after 3 seconds
        setTimeout(() => {
          window.location.href = window.location.origin + "/login/";
        }, 3000);
      } else {
        loginMessage.innerHTML = data.data.message;
        loginMessage.classList.remove("keystone-auth-success");
      }
    } catch (error) {
      console.log(error);
    }
  });
}

if (loginForm) {
  loginForm.addEventListener("submit", async (event) => {
    event.preventDefault();
    const formData = new FormData(loginForm);
    const username = formData.get("username");
    const password = formData.get("password");
    formData.append("action", "keystone_login_user");
    formData.append("security", keystone_auth.nonce);

    try {
      const response = await fetch(keystone_auth.ajax_url, {
        method: "POST",
        body: formData,
      });
      const data = await response.json();
      if (data.success) {
        window.location.href = window.location.origin + "/";
      } else {
        document.getElementById("login-message").innerHTML = data.data.message;
      }
    } catch (error) {
      console.log(error);
    }
  });
}

if (registerForm) {
  registerForm.addEventListener("submit", async (event) => {
    event.preventDefault();
    const formData = new FormData(registerForm);
    const username = formData.get("username");
    const password = formData.get("password");
    const email = formData.get("email");
    const confirmPassword = formData.get("confirm-password");
    const registerAsAgent = formData.get("agent");
    formData.append("action", "keystone_register_user");
    formData.append("security", keystone_auth.nonce);

    try {
      const response = await fetch(keystone_auth.ajax_url, {
        method: "POST",
        body: formData,
      });
      const data = await response.json();
      if (data.success) {
        window.location.href = window.location.origin + "/";
      } else {
        document.getElementById("register-message").innerHTML =
          data.data.message;
      }
    } catch (error) {
      console.log(error);
    }
  });
}
