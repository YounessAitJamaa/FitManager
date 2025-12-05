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
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
        
        * {
            font-family: 'Inter', sans-serif;
        }

        :root {
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --primary-light: #818cf8;
            --accent: #ec4899;
            --accent-light: #f472b6;
            --bg-primary: #0f172a;
            --bg-secondary: #1e293b;
            --bg-tertiary: #334155;
            --text-primary: #f1f5f9;
            --text-secondary: #cbd5e1;
            --text-muted: #94a3b8;
            --border: #475569;
            --success: #10b981;
            --warning: #f59e0b;
        }

        body {
            background-color: var(--bg-primary);
            color: var(--text-primary);
        }

        .card {
            background: var(--bg-secondary);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 24px;
            transition: all 0.3s ease;
        }

        .card:hover {
            border-color: var(--primary);
            box-shadow: 0 8px 32px rgba(99, 102, 241, 0.1);
        }

        .stat-card {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            border: none;
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
            pointer-events: none;
        }

        .stat-card:nth-child(2) {
            background: linear-gradient(135deg, var(--accent) 0%, #be185d 100%);
        }

        .stat-value {
            font-size: 2.5rem;
            font-weight: 700;
            margin-top: 12px;
            position: relative;
            z-index: 1;
        }

        .chart-container {
            background: var(--bg-secondary);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 24px;
        }

        .chart-title {
            font-size: 1.125rem;
            font-weight: 600;
            margin-bottom: 20px;
            color: var(--text-primary);
        }

        canvas {
            max-height: 300px;
        }
    </style>
</head>

<body class="flex min-h-screen">

    <?php require "../includes/sidebar.php"; ?>

    <div class="flex-1 p-8">
        
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-text-primary mb-2">Welcome back, <?= $username ?> 👋</h1>
            <p class="text-text-secondary">Here's what's happening with your courses and equipment today.</p>
        </div>

        <!-- Stats cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div class="stat-card card">
                <h2 class="text-lg font-medium text-white/90">Total Courses</h2>
                <p class="stat-value text-white"><?= $coursCount ?></p>
                <p class="text-white/70 text-sm mt-4">Active in your system</p>
            </div>

            <div class="stat-card card">
                <h2 class="text-lg font-medium text-white/90">Total Equipment</h2>
                <p class="stat-value text-white"><?= $equipementsCount ?></p>
                <p class="text-white/70 text-sm mt-4">Available resources</p>
            </div>
        </div>

        <!-- Charts -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

            <!-- Courses Chart -->
            <div class="chart-container">
                <h3 class="chart-title">Courses by Category</h3>
                <div class="h-72">
                    <canvas id="coursesChart"></canvas>
                </div>
            </div>

            <!-- Equipments Chart -->
            <div class="chart-container">
                <h3 class="chart-title">Equipment by Type</h3>
                <div class="h-72">
                    <canvas id="equipChart"></canvas>
                </div>
            </div>

        </div>

    </div>

    <script>
        const chartOptions = {
            maintainAspectRatio: false,
            responsive: true,
            plugins: {
                legend: {
                    labels: {
                        color: '#f1f5f9',
                        font: { family: "'Inter', sans-serif", size: 12 }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { color: '#94a3b8' },
                    grid: { color: 'rgba(148, 163, 184, 0.1)' }
                },
                x: {
                    ticks: { color: '#94a3b8' },
                    grid: { color: 'rgba(148, 163, 184, 0.1)' }
                }
            }
        };

        // Courses Chart
        new Chart(document.getElementById('coursesChart'), {
            type: 'bar',
            data: {
                labels: <?= json_encode($categories) ?>,
                datasets: [{
                    label: 'Courses',
                    data: <?= json_encode($catTotal) ?>,
                    backgroundColor: '#6366f1',
                    borderColor: '#4f46e5',
                    borderWidth: 0,
                    borderRadius: 8
                }]
            },
            options: chartOptions
        });

        // Equipments Chart
        new Chart(document.getElementById('equipChart'), {
            type: 'pie',
            data: {
                labels: <?= json_encode($typeEquipements) ?>,
                datasets: [{
                    label: 'Equipment',
                    data: <?= json_encode($typeTotal) ?>,
                    backgroundColor: ['#6366f1', '#ec4899', '#10b981', '#f59e0b'],
                    borderColor: '#1e293b',
                    borderWidth: 2
                }]
            },
            options: {
                maintainAspectRatio: false,
                responsive: true,
                plugins: {
                    legend: {
                        labels: {
                            color: '#f1f5f9',
                            font: { family: "'Inter', sans-serif", size: 12 }
                        }
                    }
                }
            }
        });

    </script>

</body>
</html>
