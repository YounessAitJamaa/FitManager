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
    <title>Ajouter Équipement</title>
</head>
<body class="flex bg-slate-950 text-slate-100 min-h-screen">

    <?php require "../includes/sidebar.php"; ?>
    
    <div class="flex-1 p-8">

        <!-- Updated header styling to match cours.html design -->
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-white mb-2">Modifier un équipement</h1>
            <p class="text-slate-400">Modifier équipement</p>
        </div>

        <!-- Updated error message styling to match dark theme -->
        <?php if (!empty($error)): ?>
            <div class="bg-red-600/20 border border-red-600 text-red-200 p-4 rounded-lg mb-6">
                <?= $error ?>
            </div>
        <?php endif; ?>

        <!-- Updated form styling with dark theme, rounded corners, and proper spacing -->
        <form action="" method="POST" class="bg-slate-800 border border-slate-700 rounded-xl p-8 max-w-2xl shadow-lg">

            <!-- Updated label and input styling for dark theme -->
            <label class="block mb-6">
                <span class="block text-sm font-semibold text-slate-300 mb-2">Nom</span>
                <input type="text" name="nom" value="<?= $equipement['nom'] ?>"
                    class="w-full px-4 py-2 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-500 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition"
                    placeholder="Entrez le nom de l'équipement">
            </label>

            <label class="block mb-6">
                <span class="block text-sm font-semibold text-slate-300 mb-2">Type</span>
                <select name="type" 
                    class="w-full px-4 py-2 bg-slate-700 border border-slate-600 rounded-lg text-white focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition">
                    <option value="">-- Choisir un type --</option>
                    <option value="Tapis de course" <?= ($equipement['type_equipement'] == 'Tapis de course') ? 'selected' : '' ?>>Tapis de course</option>
                    <option value="Haltères" <?= ($equipement['type_equipement'] == 'Halteres') ? 'selected' : ''?>>Halteres</option>
                    <option value="Ballon" <?= ($equipement['type_equipement'] == 'Ballon') ? 'selected' : '' ?>>Ballon</option>
                    <option value="Machine musculation" <?= ($equipement['type_equipement'] == 'Machine musculation') ? 'selected' : '' ?>>Machine musculation</option>
                </select>
            </label>

            <label class="block mb-6">
                <span class="block text-sm font-semibold text-slate-300 mb-2">Quantité</span>
                <input type="number" name="quantite" value="<?= $equipement['quantite'] ?>"
                    class="w-full px-4 py-2 bg-slate-700 border border-slate-600 rounded-lg text-white focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition"
                    placeholder="0">
            </label>

            <label class="block mb-8">
                <span class="block text-sm font-semibold text-slate-300 mb-2">État</span>
                <select name="etat"
                    class="w-full px-4 py-2 bg-slate-700 border border-slate-600 rounded-lg text-white focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition">
                    <option value="bon" <?= ($equipement['etat'] == 'Bon') ? 'selected' : '' ?>>Bon</option>
                    <option value="moyen" <?= ($equipement['etat'] == 'Moyen') ? 'selected' : '' ?>>Moyen</option>
                    <option value="A remplacer" <?= ($equipement['etat'] == 'A remplacer') ? 'selected' : '' ?>>A remplacer</option>
                </select>
            </label>

            <!-- Updated button styling to match cours.html design with hover effects -->
            <div class="flex gap-3">
                <button type="submit" name="submit" 
                    class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-blue-700 transition font-medium">
                    Modifier
                </button>

                <a href="equipements.php" 
                    class="px-6 py-2 bg-slate-700 text-slate-300 rounded-lg hover:bg-slate-600 transition font-medium">
                    Annuler
                </a>
            </div>
        </form>

    </div>
</body>
</html>