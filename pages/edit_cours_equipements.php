<?php

    require "../config/db.php";

    // Check if course ID is provided
    if (!isset($_GET['id'])) {
        header("Location: cours_equipements.php");
        exit;
    }

    $id_cours = intval($_GET['id']);

    // Get course info
    $courseQuery = "SELECT * FROM cours WHERE id_cours = $id_cours";
    $courseResult = mysqli_query($conn, $courseQuery);
    $course = mysqli_fetch_assoc($courseResult);

    // Get all equipments
    $equipQuery = "SELECT * FROM equipements";
    $equipements = mysqli_query($conn, $equipQuery);

    // Get associated equipments
    $linkedQuery = "SELECT id_equipement FROM cours_equipements WHERE id_cours = $id_cours";
    $linkedResult = mysqli_query($conn, $linkedQuery);

    $linked = [];
    while ($row = mysqli_fetch_assoc($linkedResult)) {
        $linked[] = $row['id_equipement']; // store linked equipment IDs
    }

    // Handle form submit
    if (isset($_POST['submit'])) {
        // Delete old associations
        mysqli_query($conn, "DELETE FROM cours_equipements WHERE id_cours = $id_cours");

        // Add new associations
        if (!empty($_POST['equipements'])) {
            foreach ($_POST['equipements'] as $equip_id) {
                $equip_id = intval($equip_id);
                mysqli_query($conn, "INSERT INTO cours_equipements (id_cours, id_equipement)
                                    VALUES ($id_cours, $equip_id)");
            }
        }

        header("Location: cours_equipements.php?updated=1");
        exit;
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Associer des Équipements</title>
</head>

<body class="flex bg-slate-950 text-slate-100 min-h-screen">

    <?php require "../includes/sidebar.php"; ?>

    <div class="flex-1 p-8">
        <h1 class="text-3xl font-bold mb-6">
            Associer les équipements au cours : 
            <span class="text-blue-400"><?= htmlspecialchars($course['nom']) ?></span>
        </h1>

        <form action="" method="POST" class="bg-slate-800 p-6 rounded-lg shadow-lg border border-slate-700 max-w-xl">

            <h2 class="text-xl font-semibold mb-4">Équipements disponibles :</h2>

            <div class="space-y-3">
                <?php while ($equip = mysqli_fetch_assoc($equipements)): ?>
                    <label class="flex items-center gap-3 bg-slate-700 p-3 rounded-lg hover:bg-slate-600 transition cursor-pointer">
                        <input type="checkbox" 
                            name="equipements[]"
                            value="<?= $equip['id_equipement'] ?>"
                            class="w-5 h-5"
                            <?= in_array($equip['id_equipement'], $linked) ? 'checked' : '' ?>
                        >
                        <span>
                            <?= htmlspecialchars($equip['nom']) ?> 
                            <span class="text-slate-400 text-sm">(<?= $equip['type_equipement'] ?>)</span>
                        </span>
                    </label>
                <?php endwhile; ?>
            </div>

            <button type="submit" name="submit"
                class="mt-6 px-4 py-2 bg-blue-600 rounded-lg hover:bg-blue-700 transition">
                Enregistrer les changements
            </button>

        </form>
    </div>


</body>
</html>