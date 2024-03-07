<?php
require 'config/database.php';

if (isset($_POST["desktop_case_id"])) {

    $id = filter_var($_POST["desktop_case_id"], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT id,img,desktop_case_name,price,color, dimensions FROM desktop_case WHERE id=$id";
    $result = mysqli_query($connection, $query);
    if (mysqli_num_rows($result) == 1) {
        $desktop_case = mysqli_fetch_assoc($result);
    }

    echo json_encode($desktop_case);
}
