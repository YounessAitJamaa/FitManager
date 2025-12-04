<?php

    require "../../config/db.php";

    session_start();

    if(isset($_POST['submit'])) {

        $email = $_POST['email'];
        $password = $_POST['password'];

        if(empty($email) || empty($password)) {
            $error = "Fill All the Inputs";
        } else {

            $query = "SELECT * FROM users WHERE email = '$email' LIMIT 1";

            $result = mysqli_query($conn, $query);

            if(mysqli_num_rows($result) == 1) {

                $user = mysqli_fetch_assoc($result);

                if(password_verify($password, $user['password'])) {

                    $_SESSION['user_id'] = $user['id_user'];
                    $_SESSION['username'] = $user['username'];

                    header("Location: ../index.php");
                    exit;
                } else {
                    $error = "Password Incorect";
                }
            } else {
                $error = "NO user with that email";
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
    <title>Login</title>
</head>

<body class="bg-gray-100 flex justify-center items-center h-screen">

    <div class="bg-white p-8 rounded shadow w-96">
        
        <h1 class="text-2xl font-bold text-center mb-6">Se connecter</h1>

        <?php if (isset($_GET['registered'])): ?>
            <div class="bg-green-500 text-white p-2 rounded mb-4">
                Compte créé avec succès ! Vous pouvez maintenant vous connecter.
            </div>
        <?php endif; ?>

        <!-- Error -->
        <?php if (isset($error)): ?>
            <div class="bg-red-500 text-white p-2 rounded mb-4">
                <?= $error ?>
            </div>
        <?php endif; ?>

        <form action="" method="POST">

            <label class="block mb-3">
                <span class="font-semibold">Email :</span>
                <input type="email" name="email" class="w-full p-2 border rounded mt-1" required>
            </label>

            <label class="block mb-3">
                <span class="font-semibold">Mot de passe :</span>
                <input type="password" name="password" class="w-full p-2 border rounded mt-1" required>
            </label>

            <button name="submit" class="w-full bg-blue-600 text-white p-2 rounded mt-4 hover:bg-blue-700">
                Se connecter
            </button>
        </form>

        <p class="text-center text-gray-600 mt-4">
            Pas de compte ?
            <a href="register.php" class="text-blue-600 hover:underline">Créer un compte</a>
        </p>

    </div>

</body>
</html>
