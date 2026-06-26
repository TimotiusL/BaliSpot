import { getUsers, saveUsers } from "./auth";

const form = document.getElementById("registerForm");
const message = document.getElementById("registerMessage");

if (form) {

    form.addEventListener("submit", function (e) {

        e.preventDefault();

        let users = getUsers();

        const name = document.getElementById("name").value.trim();
        const email = document.getElementById("email").value.trim();
        const username = document.getElementById("username").value.trim();
        const password = document.getElementById("password").value;
        const confirmPassword = document.getElementById("confirmPassword").value;

        message.classList.add("hidden");
        message.classList.remove(
            "bg-red-500/20",
            "border-red-400/40",
            "text-red-300",
            "bg-green-500/20",
            "border-green-400/40",
            "text-green-300"
        );

        message.textContent = "";

        if (password !== confirmPassword) {

            message.textContent = "Password dan Confirm Password tidak sama.";

            message.classList.remove("hidden");

            message.classList.add(
                "bg-red-500/20",
                "border",
                "border-red-400/40",
                "text-red-300"
            );

            return;
        }

        const exist = users.find(user => user.username === username);

        if (exist) {

            message.textContent = "Username sudah digunakan.";

            message.classList.remove("hidden");

            message.classList.add(
                "bg-red-500/20",
                "border",
                "border-red-400/40",
                "text-red-300"
            );

            return;
        }

        users.push({
            name,
            email,
            username,
            password
        });

        saveUsers(users);

        message.textContent = "Register berhasil!";

        message.classList.remove("hidden");

        message.classList.add(
            "bg-green-500/20",
            "border",
            "border-green-400/40",
            "text-green-300"
        );

        setTimeout(() => {

            window.location.href = "/";

        }, 1000);

    });

}