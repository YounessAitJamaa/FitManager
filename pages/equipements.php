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

            <a href="add_equipements.php" 
               class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                + Ajouter un equipement
            </a>
        </div>

        <!-- Table -->
        <table class="w-full border-collapse shadow">
            <thead>
                <tr class="bg-gray-800 text-white">
                    <th class="p-3">Nom</th>
                    <th class="p-3">Type equipement</th>
                    <th class="p-3">quantite</th>
                    <th class="p-3">etat</th>
                    <th class="p-3">Actions</th>
                </tr>
            </thead>

            <tbody>
            <?php
                $result = mysqli_query($conn, "SELECT * FROM equipements");

                while($row = mysqli_fetch_assoc($result)) {
                    echo "
                        <tr class='border-b'>
                            <td class='p-4'>{$row['nom']}</td>
                            <td class='p-4'>{$row['type_equipement']}</td>
                            <td class='p-4'>{$row['quantite']}</td>
                            <td class='p-4'>{$row['etat']}</td>
                            <td class='p-4 flex gap-2'>
                                <a href='edit_equipement.php?id={$row['id_equipement']}'
                                    class='bg-yellow-500 text-white px-3 py-1 rounded'>Modifier</a>

                                <a href='delete_equipement.php?id={$row['id_equipement']}'
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