<?php
    $userErr = "";
    $user = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["ID"])) {
            $userErr = "User name is required";
            } else {
            $user = test_input($_POST["ID"]);
        }
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>