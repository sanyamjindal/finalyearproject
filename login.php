<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "sanyam";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Use a prepared statement with parameterized queries
    $stmt = $conn->prepare("SELECT * FROM users WHERE username=? AND password=?");
    $stmt->bind_param("ss", $username, $password);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            echo "Login successful!";
        } else {
            echo "Login failed.";
        }
    } else {
        echo "Login failed.";
    }

    // Close the prepared statement and database connection
    $stmt->close();
    $conn->close();
}
?>

<!-- /////////      NOT SECURE /////////
<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "your_database_name";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "Login successful!";
    } else {
        echo "Login failed.";
    }
}

$conn->close();
?>
