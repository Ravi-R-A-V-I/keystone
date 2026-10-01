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
          submitBtn.innerHTML = "Failed to Save";
          setTimeout(() => {
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
