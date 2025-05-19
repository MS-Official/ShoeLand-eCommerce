// File: register.js

document.addEventListener("DOMContentLoaded", () => {
    const registerForm = document.getElementById("registerForm");

    registerForm.addEventListener("submit", (event) => {
        event.preventDefault();

        const formData = new FormData(registerForm);
        const username = formData.get("username");
        const email = formData.get("email");
        const password = formData.get("password");
        const confirmPassword = formData.get("confirm_password");

        if (password !== confirmPassword) {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Passwords do not match!",
            });
            return;
        }

        // Perform an AJAX request to the server
        $.ajax({
            url: 'http://localhost:8888/ShoeLand-eCommerce/handlers/registerHandler/registerHandler.php',
            type: "POST",
            data: {
                username: username,
                email: email,
                password: password,
            },
            success: (response) => {
                try {
                    // Attempt to parse the response as JSON
                    const res = typeof response === "string" ? JSON.parse(response) : response;

                    if (res.status === "success") {
                        Swal.fire({
                            icon: "success",
                            title: "Registered Successfully!",
                            text: "You can now log in to your account.",
                        }).then(() => {
                            window.location.href = "login.php";
                        });
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Registration Failed",
                            text: res.message || "An unknown error occurred.",
                        });
                    }
                } catch (error) {
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: "Invalid response from the server. Please try again later.",
                    });
                    console.error("Error parsing JSON response:", error, response);
                }
            },
            error: (xhr, status, error) => {
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "Something went wrong. Please try again later.",
                });
                console.error("AJAX request failed:", status, error);
            },
        });
    });
});
