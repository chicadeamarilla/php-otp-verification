<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Handle incrementing count
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $flower_id = (int)$_POST['flower_id'];

    // Only allow update by the flower owner
    $stmt = $conn->prepare("UPDATE jarden SET count = count + 1 WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $flower_id, $_SESSION['user_id']);
    $stmt->execute();
}

// Get 3 or 4 most recent flowers by user, sorted
$query = "
    SELECT jarden.*
    FROM jarden 
     
    LIMIT 4
";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();
?>

<h2>Increase Flower Count</h2>
<form method="post">
    <label for="flower_id">Flower ID:</label>
    <input type="number" name="flower_id" required>
    <input type="submit" value="Increase Count">
</form>

<h2>Your Top Flowers</h2>
<table border="1" cellpadding="5">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Breed</th>
        <th>Description</th>
        <th>Count</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?= htmlspecialchars($row['id']) ?></td>
        <td><?= htmlspecialchars($row['name']) ?></td>
        <td><?= htmlspecialchars($row['breed_name']) ?></td>
        <td><?= htmlspecialchars($row['description']) ?></td>
        <td><?= htmlspecialchars($row['count']) ?></td>
    </tr>
    <?php endwhile; ?>
</table>

<br><a href="flower_form.php">← Add New Flower</a>