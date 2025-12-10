<?php
    require "../config/db.php";
    
    $query = "SELECT * FROM equipements";

    $conditions = [];

    if(!empty($_GET['type'])) {
        $type = $_GET['type'];
        $conditions[] = "type_equipement='$type'";
    }

    if(!empty($_GET['etat'])) {
        $etat = $_GET['etat'];
        $conditions[] = "etat='$etat'";
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
    <title>Équipements</title>
</head>
<body class="flex bg-slate-950 text-slate-100 min-h-screen">
    
    <?php require "../includes/sidebar.php"; ?>

    <div class="flex-1 p-8">
        <!-- Header Section -->
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-white mb-2">Liste des Équipements</h1>
            <p class="text-slate-400">Gérez et organisez vos équipements</p>
        </div>

        <!-- Action Bar -->
        <div class="flex flex-col gap-4 mb-8 md:flex-row md:items-center md:justify-between">
            <form action="" method="GET" class="flex gap-2 flex-1 max-w-md">
                <input type="text" name="search" value="<?= htmlspecialchars($search ?? '') ?>" 
                    placeholder="Rechercher un équipement..." 
                    class="flex-1 px-4 py-2 bg-slate-800 border border-slate-700 rounded-lg text-white placeholder-slate-500 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-medium">
                    Chercher
                </button>
            </form>

            <div class="flex gap-3">
                <a href="export_equipements.php?search=<?= urlencode($search ?? '') ?>" 
                   class="px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition font-medium inline-flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2m0 0v-8m0 8l-4-2m4 2l4-2"/></svg>
                    Export CSV
                </a>

                <a href="add_equipements.php" 
                   class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-medium inline-flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Ajouter un équipement
                </a>
            </div>
        </div>

        <form method="GET" class="flex gap-4 mb-6">
            <!-- Filtre par type -->
            <select name="type" class="px-4 py-2 bg-slate-700 text-white rounded-lg">
                <option value="">Toutes les types</option>
                <option value="Tapis de course" <?= (isset($_GET['type_equipement']) && $_GET['type_equipement']=='Tapis de course') ? 'selected' : '' ?>>Tapis de course</option>
                <option value="Halteres" <?= (isset($_GET['type_equipement']) && $_GET['type_equipement']=='Halteres') ? 'selected' : '' ?>>Halteres</option>
                <option value="Ballon" <?= (isset($_GET['type_equipement']) && $_GET['type_equipement']=='Ballon') ? 'selected' : '' ?>>Ballon</option>
                <option value="Machine musculation" <?= (isset($_GET['type_equipement']) && $_GET['type_equipement']== 'Machine musculation') ? 'selected' : '' ?>>Machine musculation</option>
            </select>

            <!-- Tri par etat -->
            <select name="etat" class="px-4 py-2 bg-slate-700 text-white rounded-lg">
                <option value="">Tri par Etat</option>
                <option value="A remplacer" <?= (isset($_GET['etat']) && $_GET['etat']=='A remplacer') ? 'selected' : '' ?>>A remplacer</option>
                <option value="moyen" <?= (isset($_GET['etat']) && $_GET['etat']=='moyen') ? 'selected' : '' ?>>moyen</option>
                <option value="bon" <?= (isset($_GET['etat']) && $_GET['etat']=='bon') ? 'selected' : '' ?>>bon</option>
            </select>

            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Filtrer</button>
        </form>

        <!-- Table -->
        <div class="bg-slate-800 rounded-xl border border-slate-700 overflow-hidden shadow-lg">
            <table class="w-full">
                <thead>
                    <tr class="bg-slate-900 border-b border-slate-700">
                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-300">Nom</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-300">Type</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-300">Quantité</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-300">État</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-300">Actions</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-700">
                <?php
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "
                            <tr class='hover:bg-slate-700/50 transition'>
                                <td class='px-6 py-4 text-sm text-white font-medium'>{$row['nom']}</td>
                                <td class='px-6 py-4 text-sm text-slate-300'>
                                    <span class='px-3 py-1 bg-slate-700 rounded-full text-xs'>{$row['type_equipement']}</span>
                                </td>
                                <td class='px-6 py-4 text-sm text-slate-300'>{$row['quantite']}</td>
                                <td class='px-6 py-4 text-sm text-slate-300'>
                                    <span class='px-3 py-1 bg-slate-700 rounded-full text-xs'>{$row['etat']}</span>
                                </td>
                                <td class='px-6 py-4 text-sm flex gap-2'>
                                    <a href='edit_equipement.php?id={$row['id_equipement']}'
                                        class='px-3 py-1 bg-amber-600 text-white rounded hover:bg-amber-700 transition text-xs font-medium'>
                                        Modifier
                                    </a>

                                    <a href='delete_equipement.php?id={$row['id_equipement']}'
                                        class='px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700 transition text-xs font-medium'
                                        onclick='return confirm(\"Êtes-vous sûr?\")'>
                                        Supprimer
                                    </a>
                                </td>
                            </tr>
                        ";
                    }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
