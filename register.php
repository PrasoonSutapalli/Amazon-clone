<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{

    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $username = $_POST['username'];
    $user_password = $_POST['password'];


    $servername = "localhost";
    $db_username = "root"; 
    $db_password = ""; 
    $dbname = "registeruser";

    $conn = new mysqli($servername, $db_username, $db_password, $dbname);

    if ($conn->connect_error) 
    {
        die("Connection failed: " . $conn->connect_error);
    }


    $plaintext_password = $user_password;

    $sql = "INSERT INTO signup (email, phone, username, password)
            VALUES (?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $email, $phone, $username, $plaintext_password); 

    if ($stmt->execute())   
    {
        $stmt->close();
        $conn->close();
        echo "<script>alert('Registered Successfully'); window.location.href = 'login.html';</script>";
    } else 
    {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
