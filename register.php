
<?php
$server = "tcp:wit-sqlsrv.database.windows.net,1433";
$database = "WIT-StudentDB";
$username = "dbadmin";
$password = "P@ssword123";

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

    echo "Registration successful!";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
