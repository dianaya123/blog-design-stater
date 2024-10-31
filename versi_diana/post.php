<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM posts WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $post = $result->fetch_assoc();
        echo "<h1>" . $post['title'] . "</h1>";
        echo "<p>" . $post['content'] . "</p>";
        echo "<p>Dibaca: " . $post['views'] . " kali</p>";

        // Mengupdate jumlah pembacaan
        $sql_update = "UPDATE posts SET views = views + 1 WHERE id = $id";
        $conn->query($sql_update);
    } else {
        echo "Artikel tidak ditemukan.";
    }
} else {
    echo "ID artikel tidak ditemukan.";
}

$conn->close();
?>