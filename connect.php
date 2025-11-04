<?php
// Step 1: Connect to MySQL
$servername = "localhost";
$username = "root";
$password = "bekalvaish272005";
$dbname = "registration"; // Replace with your actual DB name

$conn = new mysqli($servername, $username, $password, $dbname);

// Step 2: Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Step 3: Validate and collect form data
$fullName = isset($_POST['fullName']) ? $_POST['fullName'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$phone = isset($_POST['phone']) ? $_POST['phone'] : '';
$dob = isset($_POST['dob']) ? $_POST['dob'] : '';
$gender = isset($_POST['gender']) ? $_POST['gender'] : '';
$course = isset($_POST['course']) ? $_POST['course'] : '';
$skills = isset($_POST['skills']) ? implode(',', $_POST['skills']) : '';
$address = isset($_POST['address']) ? $_POST['address'] : '';

// Step 4: Prepare SQL query
$sql = "INSERT INTO course_registration (
            fullName, email, phone, dob, gender,
            course, skills, address
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

// Step 5: Use prepared statement
$stmt = $conn->prepare($sql);
$stmt->bind_param(
    "ssssssss",
    $fullName, $email, $phone, $dob,
    $gender, $course, $skills, $address
);

// Step 6: Execute and respond
if ($stmt->execute()) {
    echo "Registration successful!";
} else {
    echo "Error: " . $stmt->error;
}

// Step 7: Close connection
$stmt->close();
$conn->close();
?>
