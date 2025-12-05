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

<body class="bg-slate-950 flex justify-center items-center min-h-screen p-4">
    <!-- updated entire layout to dark theme with centered card design -->
    <div class="w-full max-w-md">
        <!-- added dark background card with border and shadow -->
        <div class="bg-slate-800 border border-slate-700 rounded-xl p-8 shadow-lg">
            
            <!-- improved header with title and subtitle styling -->
            <h1 class="text-3xl font-bold text-white mb-2">Créer un compte</h1>
            <p class="text-slate-400 mb-6">Inscrivez-vous pour accéder</p>

            <!-- updated error message styling for dark theme -->
            <?php if (isset($error)): ?>
                <div class="bg-red-600/20 border border-red-600 text-red-200 p-3 rounded-lg mb-6">
                    <?= $error ?>
                </div>
            <?php endif; ?>

            <form action="" method="POST">

                <!-- updated label and input styling to match dark theme -->
                <label class="block mb-6">
                    <span class="block text-sm font-semibold text-slate-300 mb-2">Nom d'utilisateur</span>
                    <input type="text" name="username" 
                        class="w-full px-4 py-2 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-500 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition"
                        placeholder="Entrez votre nom d'utilisateur"
                        required>
                </label>

                <label class="block mb-6">
                    <span class="block text-sm font-semibold text-slate-300 mb-2">Email</span>
                    <input type="email" name="email" 
                        class="w-full px-4 py-2 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-500 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition"
                        placeholder="Entrez votre email"
                        required>
                </label>

                <label class="block mb-8">
                    <span class="block text-sm font-semibold text-slate-300 mb-2">Mot de passe</span>
                    <input type="password" name="password" 
                        class="w-full px-4 py-2 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-500 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition"
                        placeholder="Entrez votre mot de passe"
                        required>
                </label>

                <!-- updated button styling to match dark theme with hover effects -->
                <button name="submit" 
                    class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition font-medium mb-4">
                    S'inscrire
                </button>

            </form>

            <!-- updated link styling for dark theme -->
            <p class="text-center text-slate-400">
                Déjà un compte ?
                <a href="login.php" class="text-blue-400 hover:text-blue-300 transition">Se connecter</a>
            </p>

        </div>
    </div>

</body>
</html>
