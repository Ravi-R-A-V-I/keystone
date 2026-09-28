const loginForm = document.getElementById("login-form");
const registerForm = document.getElementById("register-form");

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
      console.log(data);
    } catch (error) {
      console.log(error);
    }
  });
}
