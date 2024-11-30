<?php
// Include database connection
include('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get task ID and form input values
    $id = $_POST['id'];
    $taskname = $_POST['taskname'];
    $taskdescription = $_POST['taskdescription'];
    $duedate = $_POST['duedate'];
    $priority = $_POST['priority'];

    // Update the task in the database
    try {
        $query = "UPDATE tasks SET taskname = :taskname, taskdescription = :taskdescription, duedate = :duedate, priority = :priority WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':taskname', $taskname);
        $stmt->bindParam(':taskdescription', $taskdescription);
        $stmt->bindParam(':duedate', $duedate);
        $stmt->bindParam(':priority', $priority);
        $stmt->execute();
        header("Location: index.php"); // Redirect back to task manager after updating the task
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    // Fetch the task to update
    $id = $_GET['id'];
    try {
        $query = "SELECT * FROM tasks WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $task = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Task</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Update Task</h1>
        <form method="POST">
            <input type="hidden" name="id" value="<?php echo $task['id']; ?>">

            <label for="taskname">Task Name:</label>
            <input type="text" id="taskname" name="taskname" value="<?php echo htmlspecialchars($task['taskname']); ?>" required>

            <label for="taskdescription">Description:</label>
            <textarea id="taskdescription" name="taskdescription" required><?php echo htmlspecialchars($task['taskdescription']); ?></textarea>

            <label for="duedate">Due Date:</label>
            <input type="date" id="duedate" name="duedate" value="<?php echo htmlspecialchars($task['duedate']); ?>" required>

            <label for="priority">Priority:</label>
            <select id="priority" name="priority" required>
                <option value="Low" <?php echo $task['priority'] == 'Low' ? 'selected' : ''; ?>>Low</option>
                <option value="Medium" <?php echo $task['priority'] == 'Medium' ? 'selected' : ''; ?>>Medium</option>
                <option value="High" <?php echo $task['priority'] == 'High' ? 'selected' : ''; ?>>High</option>
            </select>

            <button type="submit" class="task-button">Update Task</button>
        </form>
    </div>
</body>
</html>
