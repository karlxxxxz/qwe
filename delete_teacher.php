<?php
include('dbcon.php');

if (isset($_POST['delete_teacher'])) {
    // Get the ID from the delete button's value
    $id = $_POST['delete_teacher'];

    // Prepare delete query
    $query = "DELETE FROM users WHERE id = '$id'";
    $result = mysqli_query($link, $query);

    if ($result) {
        // Redirect back to teachers.php with success message
        header("Location: teachers.php?delete_msg=Teacher deleted successfully");
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($link);
    }
} else {
    echo "Invalid request. No ID found.";
}
?>
