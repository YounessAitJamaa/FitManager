<?php

    require "../config/db.php";

    if(isset($_GET['id'])) {

        $id = $_GET['id'];

        $query = "SELECT * FROM cours WHERE id_cours = $id";

        $result = mysqli_query($conn, $query);

        $cour = mysqli_fetch_assoc($result);

        if(!$cour) {
            echo "Cour not found";
            exit;
        }

    }


    if(isset($_POST['submit'])) {
       
        $nom = $_POST['nom'];
        $category = $_POST['category'];
        $date_cour = $_POST['date_cour'];
        $heure = $_POST['heure'];
        $duree = $_POST['duree'];
        $maxParticipants = $_POST['maxParticipants'];



        if(empty($nom) || empty($category) || empty($date_cour) || empty($heure) || empty($duree) || empty($maxParticipants)){
            $error = 'Fill All the inputs';
        }else {
            $query = "  UPDATE cours 
                        SET nom='$nom', category='$category', date_cour='$date_cour', heure='$heure', duree='$duree', max_participants='$maxParticipants'
                        WHERE id_cours = $id";

            if(mysqli_query($conn, $query)) {
                header("Location: cours.php");
                exit;
            }else {
                echo "Error While editing the cour";
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
    <title>Add Cours</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script> 
</head>
<body class="flex">
    <?php require "../includes/sidebar.php"; ?>


<!-- Main content -->
    <div class="flex-1 p-8">

        <h1 class="text-3xl font-bold mb-6">Modifier un cour</h1>

        <!-- Error message -->
        <?php if (!empty($error)): ?>
            <div class="bg-red-500 text-white p-3 rounded mb-4">
                <?= $error ?>
            </div>
        <?php endif; ?>

        <form action="" method="POST" class="bg-white p-6 rounded shadow w-1/2">

            <label class="block mb-3">
                <span class="font-semibold">Nom du cour :</span>
                <input type="text" name="nom" value="<?= $cour['nom'] ?>" class="w-full p-2 border rounded mt-1">
            </label>

            <label class="block mb-3">
                <span class="font-semibold">Catégorie :</span>
                <select name="category" class="w-full p-2 border rounded mt-1">
                    <option <?= ($cour['category'] == 'Yoga') ? "selected" : "" ?> >Yoga</option>
                    <option <?= ($cour['category'] == 'Cardio') ? "selected" : "" ?>>Cardio</option>
                    <option <?= ($cour['category'] == 'Musculation') ? "selected" : "" ?> >Musculation</option>
                </select>
            </label>

            <label class="block mb-3">
                <span class="font-semibold">Date :</span>
                <input type="date" name="date_cour" value="<?= $cour['date_cour'] ?>" class="w-full p-2 border rounded mt-1">
            </label>

            <label class="block mb-3">
                <span class="font-semibold">Heure :</span>
                <input type="time" name="heure" value="<?= $cour['heure'] ?>" class="w-full p-2 border rounded mt-1">
            </label>

            <label class="block mb-3">
                <span class="font-semibold">Durée (minutes) :</span>
                <input type="number" name="duree" value="<?= $cour['duree'] ?>" class="w-full p-2 border rounded mt-1">
            </label>

            <label class="block mb-3">
                <span class="font-semibold">Nombre max de participants :</span>
                <input type="number" name="maxParticipants" value="<?= $cour['max_participants'] ?>" class="w-full p-2 border rounded mt-1">
            </label>

            <button type="submit" name="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Modifier
            </button>

            <a href="cours.php" class="ml-3 text-gray-700 hover:underline">Annuler</a>
        </form>

    </div>
</body>
</html>