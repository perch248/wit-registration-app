<?php
$server = "tcp:wit-sqlsrv.database.windows.net,1433";
$database = "WIT-StudentDB";
$username = "dbadmin";
$password = "P@ssword123";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WIT Student Registration - Result</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .message-container {
            max-width: 600px;
            margin: 60px auto;
            background: var(--surface);
            padding: 30px;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            text-align: center;
        }
        .success {
            color: #22c55e;
            font-weight: bold;
        }
        .error {
            color: #ef4444;
            font-weight: bold;
        }
        a.btn-link {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 16px;
            background: linear-gradient(180deg, var(--primary), var(--primary-strong));
            color: white;
            border-radius: 8px;
            text-decoration: none;
        }
        a.btn-link:hover {
            filter: brightness(1.05);
        }
    </style>
</head>
<body>
<main class="container">
    <div class="message-container">
<?php
try {
    $conn = new PDO("sqlsrv:server=$server;Database=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "INSERT INTO Students (FirstName, LastName, Email, Program)
            VALUES (?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->execute([
        $_POST["first_name"],
        $_POST["last_name"],
        $_POST["email"],
        $_POST["program"]
    ]);

    echo "<p class='success'>Registration successful!</p>";
    echo "<a href='index.html' class='btn-link'>Back to Registration</a>";
} catch (PDOException $e) {
    echo "<p class='error'>Error: " . htmlspecialchars($e->getMessage()) . "</p>";
    echo "<a href='index.html' class='btn-link'>Try Again</a>";
}
?>
    </div>
</main>
</body>
</html>
