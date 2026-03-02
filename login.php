<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{

    $user_input_username = $_POST['username'];
    $user_input_password = $_POST['password'];

    $servername = "localhost";
    $db_username = "root";
    $db_password = "";
    $dbname = "login";

    $conn = new mysqli($servername, $db_username, $db_password, $dbname);

    if ($conn->connect_error) 
    {
        die("Connection failed: " . $conn->connect_error);
    }

    $plain_text_password = $user_input_password;

    $sql = "INSERT INTO signin (username, password)
            VALUES (?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $user_input_username, $plain_text_password);

    if ($stmt->execute()) 
    {
        $stmt->close();
        $conn->close();
        echo "<script>alert('Welcome to Cart Wave'); window.location.href = 'index.html';</script>";
    } else 
    {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
