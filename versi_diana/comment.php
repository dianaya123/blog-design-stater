<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM comments WHERE post_id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($comment = $result->fetch_assoc()) {
            echo "<p>" . $comment['content'] . "</p>";
        }
    } else {
        echo "Tidak ada komentar.";
    }

    // Menambahkan komentar
    if (isset($_POST['content'])) {
        $content = $_POST['content'];
        $sql_insert = "INSERT INTO comments (post_id, user_id, content) VALUES ($id, 1, '$content')";
        $conn->query($sql_insert);
        header('Location: comment.php?id=' . $id);
    }
} else {
    echo "ID artikel tidak ditemukan.";
}

$conn->close();
?>

<form action="comment.php?id=<?php echo $id; ?>" method="post">
    <label for="content">Tambahkan Komentar:</label>
    <textarea id="content" name="content"></textarea>
    <input type="submit" value="Tambahkan">
</form>