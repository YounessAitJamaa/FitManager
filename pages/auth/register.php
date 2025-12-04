<?php

    require "../../config/db.php";

    session_start();

    if(isset($_POST['submit'])) {

        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        if(empty($username) || empty($email) || empty($password)) {
            $error = "FIll All the Inputs";
        }else {

            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $query ="   INSERT INTO users (username, email, password)
                        VALUES ('$username', '$email', '$hashed_password')";
            
            if(mysqli_query($conn, $query)) {
                header("Location: login.php?registered=1");
                exit;
            }else {
                $error = "Email or username already in use";
            }
        }
    }


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script> 
    <title>Register</title>
</head>

<body class="bg-gray-100 flex justify-center items-center h-screen">

    <div class="bg-white p-8 rounded shadow w-96">
        <h1 class="text-2xl font-bold text-center mb-6">Créer un compte</h1>

        <?php if (isset($error)): ?>
            <div class="bg-red-500 text-white p-2 rounded mb-4">
                <?= $error ?>
            </div>
        <?php endif; ?>


        <form action="" method="POST">

            <label class="block mb-3">
                <span class="font-semibold">Nom d'utilisateur :</span>
                <input type="text" name="username" class="w-full p-2 border rounded mt-1" required>
            </label>

            <label class="block mb-3">
                <span class="font-semibold">Email :</span>
                <input type="email" name="email" class="w-full p-2 border rounded mt-1" required>
            </label>

            <label class="block mb-3">
                <span class="font-semibold">Mot de passe :</span>
                <input type="password" name="password" class="w-full p-2 border rounded mt-1" required>
            </label>

            <button class="w-full bg-blue-600 text-white p-2 rounded mt-4 hover:bg-blue-700" name="submit">
                S'inscrire
            </button>

        </form>

        <p class="text-center text-gray-600 mt-4">
            Déjà un compte ?
            <a href="login.php" class="text-blue-600 hover:underline">Se connecter</a>
        </p>
    </div>

</body>
</html>
