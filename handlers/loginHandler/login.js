document.addEventListener("DOMContentLoaded", () => {
  const loginForm = document.getElementById("loginForm");
  const userInfo = document.getElementById("userInfo");

  // Check if userEmail exists in session storage
  const userEmail = sessionStorage.getItem("userEmail");
  const userName = sessionStorage.getItem("userName");
  const userRole = sessionStorage.getItem("userRole"); // Add role check

  if (userEmail) {
    // User is already logged in
    loginForm.style.display = "none"; // Hide the login form
    userInfo.style.display = "block"; // Show the user info
    userInfo.innerHTML = `
            <div style="background-color: #f8d7da; color: #721c24; padding: 20px; border: 1px solid #f5c6cb; border-radius: 10px; text-align: center; margin: 150px auto; max-width: 500px; box-shadow: 0px 4px 8px rgba(0,0,0,0.2);">
                <h2 style="font-size: 2rem; font-weight: bold;">Welcome, ${
                  userName || "user"
                }!</h2>
                <p style="font-size: 1.2rem;">Your email: <strong>${userEmail}</strong></p>
                <p style="font-size: 1.2rem;">Your role: <strong>${userRole}</strong></p>
                <button id="logoutBtn" class="btn btn-danger" style="margin-top: 20px; padding: 10px 20px; font-size: 1rem;">Logout</button>
            </div>
        `;
  } else {
    // User is not logged in
    loginForm.style.display = "block"; // Show the login form
    userInfo.style.display = "none"; // Hide the user info
  }

  // User to login to the website
  const loginBtn = document.getElementById("loginBtn");

  loginBtn.addEventListener("click", async (e) => {
    e.preventDefault();

    const username = document.getElementById("username").value.trim();
    const password = document.getElementById("password").value.trim();

    if (!username || !password) {
      Swal.fire({
        icon: "warning",
        title: "Empty Fields",
        text: "Please fill out all fields before logging in.",
      });
      return;
    }

    try {
      const response = await fetch(
        "http://localhost:8888/ShoeLand-eCommerce/handlers/loginHandler/loginHandler.php",
        {
          method: "POST",
          headers: {
            "Content-Type": "application/x-www-form-urlencoded", // Use URL-encoded format
          },
          body: new URLSearchParams({ username, password }).toString(), // Format data correctly
        }
      );

      if (!response.ok) {
        throw new Error("Server error: Unable to process your request.");
      }

      const data = await response.json();

      if (data.status === "success") {
        // Save user details in session storage
        sessionStorage.setItem("userEmail", data.email);
        sessionStorage.setItem("userName", data.name);
        sessionStorage.setItem("userRole", data.role); // Store the user's role

        Swal.fire({
          icon: "success",
          title: "Login Successful!",
          text: data.message,
          showConfirmButton: false,
          timer: 1500,
        }).then(() => {
          // Redirect based on role
          if (data.role === "admin") {
            window.location.href = "../admin/dashboard.php"; // Redirect to admin dashboard
          } else if (data.role === "customer") {
            window.location.href = "products.php"; // Redirect to products page
          } else {
            // Default fallback
            window.location.href = "products.php";
          }
        });
      } else {
        Swal.fire({
          icon: "error",
          title: "Login Failed",
          text: data.message || "Invalid username or password.",
        });
      }
    } catch (error) {
      Swal.fire({
        icon: "error",
        title: "Server Error",
        text: error.message || "Something went wrong. Please try again later.",
      });
    }
  });

  // Logout logic
  document.addEventListener("click", (e) => {
    if (e.target.id === "logoutBtn") {
      sessionStorage.removeItem("userEmail");
      sessionStorage.removeItem("userName");
      sessionStorage.removeItem("userRole"); // Remove role on logout
      Swal.fire({
        icon: "info",
        title: "Logged Out",
        text: "You have been logged out successfully.",
        showConfirmButton: false,
        timer: 1500,
      }).then(() => {
        location.reload(); // Reload the page to show the login form
      });
    }
  });
});