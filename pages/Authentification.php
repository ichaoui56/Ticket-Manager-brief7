<?php
session_start();
if (isset($_SESSION["log"])) {
    header("Location: http://localhost/IlyasChaoui-Ticket-Manager/index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="../src/css/login.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
</head>

<body>
    <article class="wrapper">
    </article>

    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <form action="../includes/LoginTraitement.php" method="post" class="login" enctype="multipart/form-data">
        <h3>Login</h3>

        <label for="username">Username</label>
        <input placeholder="Enter your email" autocomplete="off" class="input" name="email" type="text">

        <label for="password">Password</label>
        <input placeholder="Enter your password" autocomplete="off" class="input" name="password" type="password">

        <div class="btn">
            <button type="submit" name="submit" class="button">
                <span class="button_lg">
                    <span class="button_sl"></span>
                    <span class="button_text">Login Now</span>
                </span>
            </button>
        </div>

        <p>Need an account?<a style="cursor: pointer;" class="registerBtn"> Create an account</a></p>
    </form>

    <form action="../includes/RegisterTraitement.php" method="post" enctype="multipart/form-data" class="register hidden">
        <h3>Register</h3>

        <label class="custum-file-upload" for="file">
            <div class="icon">
                <svg xmlns="http://www.w3.org/2000/svg" fill="" viewBox="0 0 24 24">
                    <g stroke-width="0" id="SVGRepo_bgCarrier"></g>
                    <g stroke-linejoin="round" stroke-linecap="round" id="SVGRepo_tracerCarrier"></g>
                    <g id="SVGRepo_iconCarrier">
                        <path fill="" d="M10 1C9.73478 1 9.48043 1.10536 9.29289 1.29289L3.29289 7.29289C3.10536 7.48043 3 7.73478 3 8V20C3 21.6569 4.34315 23 6 23H7C7.55228 23 8 22.5523 8 22C8 21.4477 7.55228 21 7 21H6C5.44772 21 5 20.5523 5 20V9H10C10.5523 9 11 8.55228 11 8V3H18C18.5523 3 19 3.44772 19 4V9C19 9.55228 19.4477 10 20 10C20.5523 10 21 9.55228 21 9V4C21 2.34315 19.6569 1 18 1H10ZM9 7H6.41421L9 4.41421V7ZM14 15.5C14 14.1193 15.1193 13 16.5 13C17.8807 13 19 14.1193 19 15.5V16V17H20C21.1046 17 22 17.8954 22 19C22 20.1046 21.1046 21 20 21H13C11.8954 21 11 20.1046 11 19C11 17.8954 11.8954 17 13 17H14V16V15.5ZM16.5 11C14.142 11 12.2076 12.8136 12.0156 15.122C10.2825 15.5606 9 17.1305 9 19C9 21.2091 10.7909 23 13 23H20C22.2091 23 24 21.2091 24 19C24 17.1305 22.7175 15.5606 20.9844 15.122C20.7924 12.8136 18.858 11 16.5 11Z" clip-rule="evenodd" fill-rule="evenodd"></path>
                    </g>
                </svg>
            </div>
            <div class="text">
                <span>Click to upload image</span>
            </div>
            <input name="picture" type="file" id="file">
        </label>


        <label for="username">Username</label>
        <input placeholder="Enter your username" autocomplete="off" class="input" name="username" type="text">

        <label for="username">Email</label>
        <input placeholder="Enter your email" autocomplete="off" class="input" name="email" type="text">

        <label for="username">Password</label>
        <input placeholder="Enter your password" autocomplete="off" class="input" name="password" type="password">

        <div class="btn">
            <button type="submit" name="submit" class="button">
                <span class="button_lg">
                    <span class="button_sl"></span>
                    <span class="button_text">Register Now</span>
                </span>
            </button>
        </div>

        <p>Alerady have an account? <a style="cursor: pointer;" class="loginBtn">Login Now</a></a></p>
    </form>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const login = document.querySelector(".login");
            const registerBtn = document.querySelector(".registerBtn");
            const register = document.querySelector(".register");
            const loginBtn = document.querySelector(".loginBtn");

            registerBtn.addEventListener("click", () => {
                login.classList.add("hidden");
                register.classList.remove("hidden");
            });

            loginBtn.addEventListener("click", () => {
                login.classList.remove("hidden");
                register.classList.add("hidden");
            });
        });
    </script>

</body>

</html>