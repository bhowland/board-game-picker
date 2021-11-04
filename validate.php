<?php
    $userErr = "";
    $user = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["Zip"])) {
            $userErr = "User name is required";
            } else {
            $user = test_input($_POST["Zip"]);
        }
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>