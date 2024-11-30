<?php
// Include database connection
include('db.php');

// Fetch tasks from the database using PDO
try {
    $query = "SELECT * FROM tasks";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch all tasks
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Task Manager</h1>
        
        <!-- Button to create a new task -->
        <a href="create.php" class="task-button">Create Task</a>

        <table>
            <tr>
                <th>Task Name</th>
                <th>Description</th>
                <th>Due Date</th>
                <th>Priority</th>
                <th>Actions</th>
            </tr>
            <?php if ($tasks): ?>
                <?php foreach ($tasks as $task): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($task['taskname']); ?></td>
                        <td><?php echo htmlspecialchars($task['taskdescription']); ?></td>
                        <td><?php echo htmlspecialchars($task['duedate']); ?></td>
                        <td><?php echo htmlspecialchars($task['priority']); ?></td>
                        <td>
                            <!-- Update and Delete buttons -->
                            <a href="update.php?id=<?php echo $task['id']; ?>" class="task-button">Update</a>
                            <a href="delete.php?id=<?php echo $task['id']; ?>" class="task-button">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">No tasks found</td>
                </tr>
            <?php endif; ?>
        </table>
    </div>
</body>
</html>
