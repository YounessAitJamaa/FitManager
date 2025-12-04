<?php
    require "../config/db.php"; 

    session_start();

    if(!isset($_SESSION['user_id'])){
        header("Location: ../pages/auth/login.php");
        exit;
    }

    $username = $_SESSION['username'];

    // Cours 
    $coursQuery = mysqli_query($conn, "SELECT COUNT(*) AS total FROM cours");
    $coursCount = mysqli_fetch_assoc($coursQuery)['total'];

    // equipements
    $equipementQuery = mysqli_query($conn, "SELECT COUNT(*) AS total FROM equipements");
    $equipementsCount = mysqli_fetch_assoc($equipementQuery)['total'];

    // cours by categorie 

    $coursByCategoryQuery = mysqli_query($conn, "SELECT category, COUNT(*) AS total FROM cours GROUP BY category ");

    $categories = [];
    $catTotal = [];

    while($rows = mysqli_fetch_assoc($coursByCategoryQuery)) {
        $categories[] = $rows['category'];
        $catTotal[] = $rows['total'];
    }

    $equipsByTypeQuery = mysqli_query($conn, "SELECT type_equipement, COUNT(*) AS total FROM equipements GROUP BY type_equipement");

    $typeEquipements = [];
    $typeTotal = [];

    while($rows = mysqli_fetch_assoc($equipsByTypeQuery)) {
        $typeEquipements[] = $rows['type_equipement'];
        $typeTotal[] = $rows['total'];
    }

    


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Dashboard</title>
</head>

<body class="flex min-h-screen bg-gray-100">

    <?php require "../includes/sidebar.php"; ?>

    <div class="flex-1 p-8">
        
        <h1 class="text-3xl font-bold mb-4">Bienvenue, <?= $username ?> 👋</h1>

        <!-- Stats cards -->
        <div class="grid grid-cols-2 gap-6 mb-10">
            <div class="bg-blue-600 text-white p-6 rounded-lg shadow text-center">
                <h2 class="text-xl font-semibold">Total Cours</h2>
                <p class="text-4xl font-bold mt-2"><?= $coursCount ?></p>
            </div>

            <div class="bg-green-600 text-white p-6 rounded-lg shadow text-center">
                <h2 class="text-xl font-semibold">Total Équipements</h2>
                <p class="text-4xl font-bold mt-2"><?= $equipementsCount ?></p>
            </div>
        </div>

        <!-- Charts -->
        <div class="grid grid-cols-2 gap-8">

            <!-- Courses Chart -->
            <div class="bg-white p-6 rounded shadow h-90">
                <h3 class="text-lg font-semibold mb-4">Cours par Catégorie</h3>
                <div class="h-64"> <!-- new container -->
                    <canvas id="coursesChart"></canvas>
                </div>
            </div>

            <!-- Equipments Chart -->
            <div class="bg-white p-6 rounded shadow h-90">
                <h3 class="text-lg font-semibold mb-4">Équipements par Type</h3>
                <div class="h-64">
                    <canvas id="equipChart"></canvas>
                </div>
            </div>

        </div>

    </div>

    <script>
        /// Courses Chart
        new Chart(document.getElementById('coursesChart'), {
            type: 'bar',
            data: {
                labels: <?= json_encode($categories) ?>,
                datasets: [{
                    label: 'Cours',
                    data: <?= json_encode($catTotal) ?>,
                    borderWidth: 1,
                    backgroundColor: '#60a5fa'
                }]
            },
            options: {
                maintainAspectRatio: false, // IMPORTANT
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });

        // Equipments Chart
        new Chart(document.getElementById('equipChart'), {
            type: 'pie',
            data: {
                labels: <?= json_encode($typeEquipements) ?>,
                datasets: [{
                    label: 'Équipements',
                    data: <?= json_encode($typeTotal) ?>,
                    backgroundColor: ['#60a5fa', '#34d399', '#fbbf24', '#f87171']
                }]
            },
            options: {
                maintainAspectRatio: false // IMPORTANT
            }
        });

    </script>

</body>
</html>