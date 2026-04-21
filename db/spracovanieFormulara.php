<?php
$host = "localhost";
$dbname = "formular_sj";
$port = 3307;
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;port=$port", $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (PDOException $e) {
    die("Chyba pripojenia: " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $meno = $_POST["meno"] ?? '';
    $email = $_POST["email"] ?? '';
    $sprava = $_POST["sprava"] ?? '';

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Neplatný email");
    }

    $sql = "INSERT INTO form (meno, email, sprava)
            VALUES (:meno, :email, :sprava)";

    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':meno' => $meno,
        ':email' => $email,
        ':sprava' => $sprava
    ]);

    header("Location: http://localhost/sablona_qna/thankyou.php");
    exit;
}