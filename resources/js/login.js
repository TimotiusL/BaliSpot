import { ADMIN, getUsers, saveSession, getSession } from "./auth";

const form = document.getElementById("loginForm");
const message = document.getElementById("loginMessage");

if (form) {

    form.reset();

    document.getElementById("username").value = "";
    document.getElementById("password").value = "";

    const session = getSession();

    if (session) {
        window.location.href = session.role === "admin" ? "/admin" : "/home";
    }

    form.addEventListener("submit", function (e) {

        e.preventDefault();

        const username = document.getElementById("username").value.trim();
        const password = document.getElementById("password").value.trim();

        message.classList.add("hidden");
        message.classList.remove(
            "bg-red-500/20",
            "border",
            "border-red-400/40",
            "text-red-300"
        );
        message.textContent = "";

        if (username === ADMIN.username && password === ADMIN.password) {

            saveSession({
                role: "admin",
                username: "admin"
            });

            window.location.href = "/admin";
            return;
        }

        const user = getUsers().find(u =>
            u.username === username &&
            u.password === password
        );

        if (user) {

            saveSession({
                role: "user",
                username: user.username,
                name: user.name
            });

            window.location.href = "/home";

        } else {

            message.textContent = "Username atau password salah.";

            message.classList.remove("hidden");

            message.classList.add(
                "bg-red-500/20",
                "border",
                "border-red-400/40",
                "text-red-300"
            );

        }

    });

}

