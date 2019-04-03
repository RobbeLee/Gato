<?php
require '../../include/db.php';
require '../../include/php_header.php';

/*

Errors explained:
-1: The user got here without activating the form itself. The user most likely munually navigated here.
0: Not every field has been filled in.
1: The password/username/name includes invalid characters (only a-z A-Z 0-9 allowed)
2: The name/username/password was longer than 60 characters
3: Invalid email address
4: This email/username already exists

*/

if (!isset($_POST['submit'])) {
    header("Location: ../../"); // Error -1
    exit;
}

if (empty($_POST['email']) || empty($_POST['name']) || empty($_POST['username']) || empty($_POST['password'])) {
    header("Location: ../../signup?error=0");
    exit;
}

$name = $_POST['name'];
$username = $_POST['username'];
$email = strtolower($_POST['email']);
$password = $_POST['password'];
$created = date('Y-m-d H:i:s');

$password = password_hash($password, PASSWORD_DEFAULT);

//if (!preg_match("/^[a-zA-Z0-9]*$/", $name) || !preg_match("/^[a-zA-Z0-9]*$/", $username) || !preg_match("/^[a-zA-Z0-9]*$/", $password)) header("Location: ../../signup?error=1");

if (strlen($name) > 60 || strlen($username) > 60 || strlen($password) > 60) {
    header("Location: ../../signup?error=2");
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: ../../signup?error=3");
    exit;
}

$stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
$stmt->execute([$email]);
$result = $stmt->fetch();

$foundEmail = $result['email'];

if ($foundEmail == $email) {
    header("Location: ../../signup?error=4");
    exit;
}

$path = "../../u/".strtolower($username).".php";
$content = "<?php require '../include/profile.php';"; // Will be made later
file_put_contents($path, $content);

$stmt = $conn->prepare("INSERT INTO users (name, username, email, password, created, ip) VALUES (?, ?, ?, ?, ?, ?)");

if (!$stmt->execute([$name, $username, $email, $password, $created, $ip])) {
    echo "<h1>Fatal query error encountered.<br>Please come again</h1>";
    exit;
    die;
}

$stmt = $conn->prepare("SELECT id FROM users WHERE username=?;");
$stmt->execute([$username]);
$result = $stmt->fetch();

$stmt = $conn->prepare("INSERT INTO user_settings (user_id, location, language) VALUES (?, ?, ?);");

if (!$stmt->execute([$result[0], 'United States', 'US'])) {
    echo "<h1>Fatal query error encountered.<br>Please come again</h1>";
    exit;
    die;
}

header("Location: ../../login");
exit;