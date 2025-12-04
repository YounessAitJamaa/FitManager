<?php

    require "../config/db.php"; 

    if(isset($_GET['id'])) {

        $id = $_GET['id'];

        $query = "DELETE FROM equipements WHERE id_equipement = $id";

        if(mysqli_query($conn, $query)) {
            header("Location: equipements.php");
            exit;
        }else {
            echo "Error While Deleting the equipement";
        }

    }else {
        header("Location: equipements.php");
        exit;
    }


?>