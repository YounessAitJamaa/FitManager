<?php

    require "../config/db.php";

    if(isset($_GET['id'])) {

        $id = $_GET['id'];

        $query = "SELECT * FROM equipements WHERE id_equipement = $id";

        $result = mysqli_query($conn, $query);

        $equipement = mysqli_fetch_assoc($result);
    }

    if(isset($_POST['submit'])) {

        $nom = $_POST['nom'];
        $type = $_POST['type'];
        $quantite = $_POST['quantite'];
        $etat = $_POST['etat'];

        if(empty($nom) || empty($type) || empty($quantite) || empty($etat)) {
            $error = "FIll All the Inputs";
        } else {
            $query = "  UPDATE equipements
                        SET nom='$nom', type_equipement='$type', quantite='$quantite', etat='$etat'
                        WHERE id_equipement = $id";
            if(mysqli_query($conn, $query)) {
                header("Location: equipements.php");
                exit;
            }else {
                echo "Error While editing the equipement";
                exit;
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

        <h1 class="text-3xl font-bold mb-6">Modifier un equipement</h1>

        <!-- Error message -->
        <?php if (!empty($error)): ?>
            <div class="bg-red-500 text-white p-3 rounded mb-4">
                <?= $error ?>
            </div>
        <?php endif; ?>

        <form action="" method="POST" class="bg-white p-6 rounded shadow w-1/2">

            <label class="block mb-3">
                <span class="font-semibold">Nom :</span>
                <input type="text" name="nom" value="<?= $equipement['nom'] ?>" class="w-full p-2 border rounded mt-1">
            </label>

            <label class="block mb-3">
                <span class="font-semibold">Type :</span>
                <select name="type" class="w-full p-2 border rounded mt-1">
                    <option <?= ($equipement['type_equipement'] == 'Tapis de course') ? 'selected' : '' ?>>Tapis de course</option>
                    <option <?= ($equipement['type_equipement'] == 'Halteres') ? 'selected' : '' ?>>Halteres</option>
                    <option <?= ($equipement['type_equipement'] == 'Ballon') ? 'selected' : '' ?>>Ballon</option>
                    <option <?= ($equipement['type_equipement'] == 'Machine musculation') ? 'selected' : '' ?>>Machine musculation</option>
                </select>
            </label>

            <label class="block mb-3">
                <span class="font-semibold">Quantité :</span>
                <input type="number" name="quantite" value="<?= $equipement['quantite'] ?>" class="w-full p-2 border rounded mt-1">
            </label>

            <label class="block mb-3">
                <span class="font-semibold">État :</span>
                <select name="etat" class="w-full p-2 border rounded mt-1">
                    <option <?= ($equipement['etat'] == 'Bon') ? 'selected' : '' ?>>Bon</option>
                    <option <?= ($equipement['etat'] == 'Moyen') ? 'selected' : '' ?>>Moyen</option>
                    <option <?= ($equipement['etat'] == 'A remplacer') ? 'selected' : ''?>>A remplacer</option>
                </select>
            </label>

            <button type="submit" name="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Modifier
            </button>

            <a href="equipements.php" class="ml-3 text-gray-700 hover:underline">Annuler</a>
        </form>

    </div>
</body>
</html>