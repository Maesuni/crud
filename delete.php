<?php
// Include database connection
include('db.php');

if (isset($_GET['id'])) {
    // Get the task ID to delete
    $id = $_GET['id'];

    // Delete the task from the database
    try {
        $query = "DELETE FROM tasks WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        header("Location: index.php"); // Redirect back to task manager after deleting the task
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
