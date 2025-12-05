<?php

    require "../config/db.php";

    $filename = "equipement.csv";

    header('Content-type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename='. $filename);

    $output = fopen('php://output', 'w');

    fputcsv($output, ['Nom', 'type', 'Quantite', 'Etat']);

    $sql = "SELECT * FROM equipements";
    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
        fputcsv($output, [
            $row['nom'],
            $row['type_equipement'],
            $row['quantite'],
            $row['etat']
        ]);
    }
    
    fclose($output);
    exit;



?>