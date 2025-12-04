<?php

    require "../config/db.php";


    if(isset($_GET['id'])) {

        $id = $_GET['id'];

        $query = "DELETE FROM cours WHERE id_cours = $id";

        if(mysqli_query($conn, $query)) {
            header("Location: cours.php");
            exit;
        } else {
            echo "Error While deleting the cour";
        }

    } else {
        header("Location: cours.php");
        exit;
    }

?>