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

<body class="bg-slate-950 flex justify-center items-center min-h-screen p-4">
    <!-- updated entire layout to dark theme with centered card design -->
    <div class="w-full max-w-md">
        <!-- added dark background card with border and shadow -->
        <div class="bg-slate-800 border border-slate-700 rounded-xl p-8 shadow-lg">
            
            <!-- improved header with title and subtitle styling -->
            <h1 class="text-3xl font-bold text-white mb-2">Se connecter</h1>
            <p class="text-slate-400 mb-6">Accédez à votre compte</p>

            <!-- updated success message styling for dark theme -->
            <?php if (isset($_GET['registered'])): ?>
                <div class="bg-green-600/20 border border-green-600 text-green-200 p-3 rounded-lg mb-6">
                    Compte créé avec succès ! Vous pouvez maintenant vous connecter.
                </div>
            <?php endif; ?>

            <!-- updated error message styling for dark theme -->
            <?php if (isset($error)): ?>
                <div class="bg-red-600/20 border border-red-600 text-red-200 p-3 rounded-lg mb-6">
                    <?= $error ?>
                </div>
            <?php endif; ?>

            <form action="" method="POST">

                <!-- updated label and input styling to match dark theme -->
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
                    Se connecter
                </button>
            </form>

            <!-- updated link styling for dark theme -->
            <p class="text-center text-slate-400">
                Pas de compte ?
                <a href="register.php" class="text-blue-400 hover:text-blue-300 transition">Créer un compte</a>
            </p>

        </div>
    </div>

</body>
</html>
