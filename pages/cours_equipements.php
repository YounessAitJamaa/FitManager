<?php
require "../config/db.php";

$query = "
    SELECT c.id_cours, c.nom AS course_name, GROUP_CONCAT(e.nom SEPARATOR ', ') AS equipements
    FROM cours c
    LEFT JOIN cours_equipements ce ON c.id_cours = ce.id_cours
    LEFT JOIN equipements e ON ce.id_equipement = e.id_equipement
    GROUP BY c.id_cours
";

$conditions = [];
if(!empty($_GET['search'])) {
    $search = $_GET['search'];
    $conditions[] = "c.nom LIKE '%$search%'";
}

if(!empty($conditions)) {
    $query .= " WHERE " . implode(" AND ", $conditions);
}

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Cours & Équipements</title>
</head>
<body class="flex bg-slate-950 text-slate-100 min-h-screen">
    <?php require "../includes/sidebar.php"; ?>

    <div class="flex-1 p-8">
        <!-- Updated header with title and subtitle -->
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-white mb-2">Cours & Équipements</h1>
            <p class="text-slate-400">Consultez les équipements associés à chaque cours</p>
        </div>

        <!-- Added search and action bar -->
        <div class="flex flex-col gap-4 mb-8 md:flex-row md:items-center md:justify-between">
            <form action="" method="GET" class="flex gap-2 flex-1 max-w-md">
                <input type="text" name="search" value="<?= htmlspecialchars($_GET['search'] ?? '') ?>" 
                    placeholder="Rechercher un cours..." 
                    class="flex-1 px-4 py-2 bg-slate-800 border border-slate-700 rounded-lg text-white placeholder-slate-500 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-medium">
                    Chercher
                </button>
            </form>

            <div class="flex gap-3">
                <a href="edit_cours_equipements.php" 
                   class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-medium inline-flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Ajouter une liaison
                </a>
            </div>
        </div>

        <!-- Updated table styling to match index.html design -->
        <div class="bg-slate-800 rounded-xl border border-slate-700 overflow-hidden shadow-lg">
            <table class="w-full">
                <thead>
                    <tr class="bg-slate-900 border-b border-slate-700">
                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-300">Cours</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-300">Équipements associés</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-300">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-700">
                    <?php while($row = mysqli_fetch_assoc($result)): ?>
                        <tr class="hover:bg-slate-700/50 transition">
                            <td class="px-6 py-4 text-sm text-white font-medium"><?= htmlspecialchars($row['course_name']) ?></td>
                            <td class="px-6 py-4 text-sm text-slate-300">
                                <span class="px-3 py-1 bg-slate-700 rounded-full text-xs"><?= htmlspecialchars($row['equipements'] ?? 'Aucun') ?></span>
                            </td>
                            <td class="px-6 py-4 text-sm flex gap-2">
                                <a href="edit_cours_equipements.php?id=<?= $row['id_cours'] ?>" 
                                   class="px-3 py-1 bg-amber-600 text-white rounded hover:bg-amber-700 transition text-xs font-medium">
                                    Modifier
                                </a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
