<?php
include 'db.php';

// Mengambil artikel terbaru
$sql = "SELECT p.*, c.name as category_name FROM posts p 
        JOIN categories c ON p.category_id = c.id 
        ORDER BY p.created_at DESC LIMIT 5";
$result = $conn->query($sql);

// Mengambil artikel trending
$sql_trending = "SELECT * FROM posts ORDER BY views DESC LIMIT 5";
$result_trending = $conn->query($sql_trending);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda Blog</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="container">
            <div id="branding">
                <h1>Blog Saya</h1>
            </div>
            <nav>
                <ul>
                    <li><a href="index.php">Beranda</a></li>
                    <li><a href="technology.php">Technology</a></li>
                    <li><a href="lifestyle.php">Lifestyle</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="container">
        <div class="main-content">
            <h1>Artikel Terbaru</h1>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='post'>";
                    echo "<h2>" . $row['title'] . "</h2>";
                    echo "<p>" . substr($row['content'], 0, 200) . "...</p>";
                    echo "<div class='post-meta'>";
                    echo "<span>Kategori: " . $row['category_name'] . "</span> | ";
                    echo "<span>Dibaca: " . $row['views'] . " kali</span>";
                    echo "</div>";
                    echo "</div>";
                }
            } else {
                echo "Tidak ada artikel.";
            }
            ?>
            <div class="pagination">
                <!-- Tambahkan pagination di sini -->
                <a href="#">1</a>
                <a href="#">2</a>
                <a href="#">3</a>
            </div>
        </div>

        <div class="sidebar">
            <h3>Trending</h3>
            <?php
            if ($result_trending->num_rows > 0) {
                while ($trend = $result_trending->fetch_assoc()) {
                    echo "<div class='trending-post'>";
                    echo "<p>" . $trend['title'] . " - " . $trend['views'] . " views</p>";
                    echo "</div>";
                }
            } else {
                echo "Tidak ada artikel trending.";
            }
            ?>
        </div>
    </div>

    <?php $conn->close(); ?>
</body>
</html>