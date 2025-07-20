
    function toggleForm(type) {
        const loginForm = document.getElementById("loginForm");
        const registerForm = document.getElementById("registerForm");
        const modalTitle = document.getElementById("modalTitle");

        if (type === "register") {
            loginForm.style.display = "none";
            registerForm.style.display = "block";
            modalTitle.textContent = "Create an account";
        } else {
            loginForm.style.display = "block";
            registerForm.style.display = "none";
            modalTitle.textContent = "Welcome back!";
        }
    }
