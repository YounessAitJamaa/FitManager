<?php
    require "../config/db.php"; 

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
            $query = "INSERT INTO cours (nom, category, date_cour, heure, duree, max_participants)
                        VALUES ('$nom', '$category', '$date_cour', '$heure', '$duree', '$maxParticipants')";

            if(mysqli_query($conn, $query)) {
                header("location: cours.php");
                exit;
            }else {
                $error = "Error While Adding the cours";
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
<body class="flex bg-slate-950 text-slate-100 min-h-screen">
    <?php require "../includes/sidebar.php"; ?>

    <div class="flex-1 p-8">
        <!-- Updated header styling to match cours.html design -->
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-white mb-2">Ajouter un cours</h1>
            <p class="text-slate-400">Créez un nouveau cours pour vos participants</p>
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
                <span class="block text-sm font-semibold text-slate-300 mb-2">Nom du cours</span>
                <input type="text" name="nom" 
                    class="w-full px-4 py-2 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-500 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition"
                    placeholder="Entrez le nom du cours">
            </label>

            <label class="block mb-6">
                <span class="block text-sm font-semibold text-slate-300 mb-2">Catégorie</span>
                <select name="category" 
                    class="w-full px-4 py-2 bg-slate-700 border border-slate-600 rounded-lg text-white focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition">
                    <option value="">-- Choisir une catégorie --</option>
                    <option value="Yoga">Yoga</option>
                    <option value="Cardio">Cardio</option>
                    <option value="Musculation">Musculation</option>
                </select>
            </label>

            <label class="block mb-6">
                <span class="block text-sm font-semibold text-slate-300 mb-2">Date</span>
                <input type="date" name="date_cour" 
                    class="w-full px-4 py-2 bg-slate-700 border border-slate-600 rounded-lg text-white focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition">
            </label>

            <label class="block mb-6">
                <span class="block text-sm font-semibold text-slate-300 mb-2">Heure</span>
                <input type="time" name="heure" 
                    class="w-full px-4 py-2 bg-slate-700 border border-slate-600 rounded-lg text-white focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition">
            </label>

            <label class="block mb-6">
                <span class="block text-sm font-semibold text-slate-300 mb-2">Durée (minutes)</span>
                <input type="number" name="duree" 
                    class="w-full px-4 py-2 bg-slate-700 border border-slate-600 rounded-lg text-white focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition"
                    placeholder="0">
            </label>

            <label class="block mb-8">
                <span class="block text-sm font-semibold text-slate-300 mb-2">Nombre max de participants</span>
                <input type="number" name="maxParticipants" 
                    class="w-full px-4 py-2 bg-slate-700 border border-slate-600 rounded-lg text-white focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition"
                    placeholder="0">
            </label>

            <!-- Updated button styling to match cours.html design with hover effects -->
            <div class="flex gap-3">
                <button type="submit" name="submit" 
                    class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-medium">
                    Ajouter
                </button>

                <a href="cours.php" 
                    class="px-6 py-2 bg-slate-700 text-slate-300 rounded-lg hover:bg-slate-600 transition font-medium">
                    Annuler
                </a>
            </div>
        </form>

    </div>
</body>
</html>
