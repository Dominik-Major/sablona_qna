<?php
require_once __DIR__ . "/../classes/database.php";
use App\Database;

$db = new Database();
$conn = $db->connect();

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