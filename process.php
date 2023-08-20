<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && empty($_POST)) {
    header("Location: index.php");
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = $_POST['name'];
    $phone_number = $_POST['phone_number'];
    $email = $_POST['email'];
    $subject1 = $_POST['subject'];
    $message1 = $_POST['message'];

        $db_host = "localhost";
        $db_user = "root";
        $db_password = "";
        $db_name = "beauty_salon";

        $conn = new mysqli($db_host, $db_user, $db_password, $db_name);

        if ($conn->connect_error) {
            die("Connection failed !!");
        }

        $ip_address = $_SERVER['REMOTE_ADDR'];
        $timestamp = date('Y-m-d H:i:s');

        $sql = "INSERT INTO contact_form (full_name, phone_number, email, subject, message, ip_address, submission_time) VALUES ('$full_name', '$phone_number', '$email', '$subject1', '$message1', '$ip_address', '$timestamp')";

        if ($conn->query($sql) === TRUE) {
            $to = "mohd.adnan.627492@gmail.com";
            $subject = $subject1;
            $message = "Name: $full_name \n Phone No: $phone_number \n Email: $email\nMessage: $message1";
            mail($to, $subject, $message);

            echo "Form submitted successfully!!";
        } else {
            echo "Form submit failed";
        }

        $conn->close();
    } else {
        echo '<a href="index.php">Go back</a>';
    }


?>