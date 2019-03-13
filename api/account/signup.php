<?php
require '../../include/php_header.php';

/*

Error explained:
-1: The user got here without activating the form itself. The user most likely munually navigated here.
0: Not every field has been filled in.
1: The password/username/name includes invalid characters (only a-z A-Z 0-9 allowed)
2: The name/username/password was longer than 60 characters
3: This email/username already exists
4: Invalid email address

*/

if (!isset($_POST['submit'])) header("Location: ../../"); // Error -1

if (empty($_POST['email']) || empty($_POST['name']) || empty($_POST['username']) || empty($_POST['password'])) header("Location: ../../signup?error=0");

$name = $_POST['name'];
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$date = date('Y-m-d H:i:s');

$password = password_hash($password, PASSWORD_DEFAULT);

if (!preg_match("/^[a-zA-Z0-9]*$/", $name) || !preg_match("/^[a-zA-Z0-9]*$/", $username) || !preg_match("/^[a-zA-Z0-9]*$/", $password)) header("Location: ../../signup?error=1");

if (strlen($name) > 60 || strlen($username) > 60 || strlen($password) > 60) header("Location: ../../signup?error=2");

// Note to self: come back here later to check for duplicate emails & username's
// Error nm: 3

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) header("Location: ../../signup?error=4");

$path = "../channel/".strtolower($username).".php";
$content = "<?php include '../include/profile.php';"; // Will be made later
file_put_contents($path, $content);

// Make PDO query

header("Location: ../../login");
exit;