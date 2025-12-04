<?php
    require "../config/db.php"; 

    if(isset($_POST['submit'])) {

        $nom = $_POST['nom'];
        $type = $_POST['type'];
        $quantite = $_POST['quantite'];
        $etat = $_POST['etat'];

        if(empty($nom) || empty($type) || empty($quantite) || empty($etat)) {
            $error = "FIll All the Inputs";
        } else {
            $query  = "INSERT INTO equipements (nom, type_equipement, quantite, etat)
                        VALUES ('$nom', '$type', '$quantite', '$etat') ";

            if(mysqli_query($conn, $query)) {
                header("Location: equipements.php");
                exit;
            }else {
                $error = "Error While Adding new equipement";
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
    <title>Document</title>
</head>
<body class="flex">

    <?php require "../includes/sidebar.php"; ?>
    
    <div class="flex-1 p-8">

        <h1 class="text-3xl font-bold mb-6">Ajouter un equipement</h1>

        <!-- Error message -->
        <?php if (!empty($error)): ?>
            <div class="bg-red-500 text-white p-3 rounded mb-4">
                <?= $error ?>
            </div>
        <?php endif; ?>

        <form action="" method="POST" class="bg-white p-6 rounded shadow w-1/2">

            <label class="block mb-3">
                <span class="font-semibold">Nom :</span>
                <input type="text" name="nom" class="w-full p-2 border rounded mt-1">
            </label>

            <label class="block mb-3">
                <span class="font-semibold">Type :</span>
                <select name="type" class="w-full p-2 border rounded mt-1">
                    <option value="">-- Choisir un type --</option>
                    <option value="Tapis de course">Tapis de course</option>
                    <option value="Haltères">Halteres</option>
                    <option value="Ballon">Ballon</option>
                    <option value="Machine musculation">Machine musculation</option>
                </select>
            </label>

            <label class="block mb-3">
                <span class="font-semibold">Quantité :</span>
                <input type="number" name="quantite" class="w-full p-2 border rounded mt-1">
            </label>

            <label class="block mb-3">
                <span class="font-semibold">État :</span>
                <select name="etat" class="w-full p-2 border rounded mt-1">
                    <option value="bon">Bon</option>
                    <option value="moyen">Moyen</option>
                    <option value="A remplacer">A remplacer</option>
                </select>
            </label>

            <button type="submit" name="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Ajouter
            </button>

            <a href="equipements.php" class="ml-3 text-gray-700 hover:underline">Annuler</a>
        </form>

    </div>
</body>
</html>