<?php
// Include database connection
include('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form input values
    $taskname = $_POST['taskname'];
    $taskdescription = $_POST['taskdescription'];
    $duedate = $_POST['duedate'];
    $priority = $_POST['priority'];

    // Insert the new task into the database
    try {
        $query = "INSERT INTO tasks (taskname, taskdescription, duedate, priority) VALUES (:taskname, :taskdescription, :duedate, :priority)";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':taskname', $taskname);
        $stmt->bindParam(':taskdescription', $taskdescription);
        $stmt->bindParam(':duedate', $duedate);
        $stmt->bindParam(':priority', $priority);
        $stmt->execute();
        header("Location: index.php"); // Redirect back to task manager after creating a task
        exit();
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
    <title>Create Task</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Create Task</h1>
        <form method="POST">
            <label for="taskname">Task Name:</label>
            <input type="text" id="taskname" name="taskname" required>

            <label for="taskdescription">Description:</label>
            <textarea id="taskdescription" name="taskdescription" required></textarea>

            <label for="duedate">Due Date:</label>
            <input type="date" id="duedate" name="duedate" required>

            <label for="priority">Priority:</label>
            <select id="priority" name="priority" required>
                <option value="Low">Low</option>
                <option value="Medium">Medium</option>
                <option value="High">High</option>
            </select>

            <button type="submit" class="task-button">Create Task</button>
        </form>
    </div>
</body>
</html>
