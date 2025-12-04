<?php
    require "../config/db.php"; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script> 
    <title>Cours</title>
</head>
<body class="flex min-h-screen bg-gray-100">
    
    <?php require "../includes/sidebar.php"; ?>

    <div class="flex-1 p-8">

        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold">Liste des Cours</h1>

            <a href="add_cours.php" 
               class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                + Ajouter un cour
            </a>
        </div>

        <!-- Table -->
        <table class="w-full border-collapse shadow">
            <thead>
                <tr class="bg-gray-800 text-white">
                    <th class="p-3">Nom</th>
                    <th class="p-3">Catégorie</th>
                    <th class="p-3">Date</th>
                    <th class="p-3">Heure</th>
                    <th class="p-3">Durée</th>
                    <th class="p-3">Max Participants</th>
                    <th class="p-3">Actions</th>
                </tr>
            </thead>

            <tbody>
            <?php
                $result = mysqli_query($conn, "SELECT * FROM cours");

                while($row = mysqli_fetch_assoc($result)) {
                    echo "
                        <tr class='border-b'>
                            <td class='p-3'>{$row['nom']}</td>
                            <td class='p-3'>{$row['category']}</td>
                            <td class='p-3'>{$row['date_cour']}</td>
                            <td class='p-3'>{$row['heure']}</td>
                            <td class='p-3'>{$row['duree']} min</td>
                            <td class='p-3'>{$row['max_participants']}</td>
                            <td class='p-3 flex gap-2'>
                                <a href='edit_cours.php?id={$row['id_cours']}'
                                    class='bg-yellow-500 text-white px-3 py-1 rounded'>Modifier</a>

                                <a href='delete_cours.php?id={$row['id_cours']}'
                                    class='bg-red-600 text-white px-3 py-1 rounded'>Supprimer</a>
                        </tr>
                    ";
                }

            ?>
            <tbody>
        </table>
    </div>
</body>
</html>