<?php

    require "../config/db.php";
    
    $filename = "cours.csv";

    header('Content-type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename='. $filename);

    $output = fopen('php://output', 'w');

    fputcsv($output, ['Nom', 'Catégorie', 'Date', 'Heure', 'Durée', 'Max Participants']);

    $sql = 'SELECT * FROM cours';
    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
        fputcsv($output, [
            $row['nom'],
            $row['category'],
            $row['date_cour'],
            $row['heure'],
            $row['duree'],
            $row['max_participants']
        ]);
    }

    fclose($output);
    exit;

?>