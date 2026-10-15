document.addEventListener("DOMContentLoaded", function () {
  console.log("Agent Dashboard and profile settings loaded");
  // 1. Grab any banner that exists on the page
  const alerts = document.querySelectorAll(".success-banner, .danger-banner");

  if (alerts.length > 0) {
    // 2. Set a 3-second timer
    setTimeout(() => {
      alerts.forEach((alert) => {
        // Smoothly fade it out
        alert.style.transition = "opacity 0.5s ease";
        alert.style.opacity = "0";

        // Remove it from the HTML completely after the fade
        setTimeout(() => alert.remove(), 500);
      });

      // 3. The Magic Trick: Silently scrub the '?status=' from the URL
      const cleanUrl = new URL(window.location);
      cleanUrl.searchParams.delete("status");
      window.history.replaceState({}, document.title, cleanUrl);
    }, 3000); // 3000 milliseconds = 3 seconds
  }
});

const agentAvatar = document.getElementById("agent-avatar");
const avatarPreview = document.querySelector("#preview-image");
const uploadText = document.getElementById("upload-text");

if (avatarPreview && !avatarPreview.src) {
  avatarPreview.style.display = "none";
  uploadText.style.display = "block";
}

if (agentAvatar) {
  agentAvatar.addEventListener("change", function () {
    const fileName = this.files[0];
    if (fileName) {
      avatarPreview.src = URL.createObjectURL(fileName);
      uploadText.style.display = "none";
      avatarPreview.style.display = "block";
    } else {
      avatarPreview.style.display = "none";
      avatarPreview.src = "";
      uploadText.style.display = "block";
    }
  });
}

const agentProfileForm = document.getElementById("agent-profile-form");

if (agentProfileForm) {
  agentProfileForm.addEventListener("submit", async (event) => {
    event.preventDefault();

    const submitBtn = agentProfileForm.querySelector(".dashboard-submit-btn");
    const originalText = submitBtn ? submitBtn.innerHTML : "Submit";

    // 1. ADD LOADING FEEDBACK
    if (submitBtn) {
      submitBtn.disabled = true;
      submitBtn.classList.add("is-loading");
      submitBtn.innerHTML = "Saving Changes...";
    }

    const formData = new FormData(agentProfileForm);
    formData.append("action", "keystone_update_agent_profile");
    formData.append("security", agent_dashboard_data.nonce);

    try {
      const response = await fetch(agent_dashboard_data.ajax_url, {
        method: "POST",
        body: formData,
      });
      const data = await response.json();

      // Re-enable button
      if (submitBtn) {
        submitBtn.disabled = false;
        submitBtn.classList.remove("is-loading");
      }

      if (data.success) {
        console.log(data.data.message);

        // 2. SUCCESS FEEDBACK
        if (submitBtn) {
          submitBtn.classList.add("is-success");
          submitBtn.innerHTML = "Saved Successfully!";

          // Revert back to original text after 3 seconds
          setTimeout(() => {
            submitBtn.classList.remove("is-success");
            submitBtn.innerHTML = originalText;
          }, 3000);
        }
      } else {
        console.log(data.data.message);
        if (submitBtn) {
          submitBtn.classList.add("is-error");
          submitBtn.innerHTML = data.data.message;
          setTimeout(() => {
            submitBtn.classList.remove("is-error");
            submitBtn.innerHTML = originalText;
          }, 3000);
        }
      }
    } catch (error) {
      console.log(error);
      if (submitBtn) {
        submitBtn.disabled = false;
        submitBtn.classList.remove("is-loading");
        submitBtn.innerHTML = originalText;
      }
    }
  });
}
