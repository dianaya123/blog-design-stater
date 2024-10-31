<?php
include 'db.php';

// Mengambil artikel lifestyle terbaru
$sql = "SELECT p.*, c.name as category_name FROM posts p 
        JOIN categories c ON p.category_id = c.id 
        WHERE c.name = 'Lifestyle'
        ORDER BY p.created_at DESC LIMIT 5";
$result = $conn->query($sql);

// Mengambil artikel trending lifestyle
$sql_trending = "SELECT p.* FROM posts p 
                 JOIN categories c ON p.category_id = c.id 
                 WHERE c.name = 'Lifestyle'
                 ORDER BY p.views DESC LIMIT 5";
$result_trending = $conn->query($sql_trending);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artikel Lifestyle</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="container">
            <div id="branding">
                <h1>Web Programming Blog</h1>
            </div>
            <nav>
                <ul>
                    <li><a href="index.php">Beranda</a></li>
                    <li><a href="technology.php">Technology</a></li>
                    <li><a href="lifestyle.php" class="active">Lifestyle</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="container">
        <div class="main-content">
            <h1>Artikel Lifestyle Terbaru</h1>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='post'>";
                    echo "<h2>" . $row['title'] . "</h2>";
                    echo "<p>" . substr($row['content'], 0, 200) . "...</p>";
                    echo "<div class='post-meta'>";
                    echo "<span>Kategori: " . $row['category_name'] . "</span> | ";
                    echo "<span>Dibaca: " . $row['views'] . " kali</span> | ";
                    echo "<span>Tanggal: " . date('d/m/Y', strtotime($row['created_at'])) . "</span>";
                    echo "</div>";
                    echo "<a href='post.php?id=" . $row['id'] . "' class='read-more'>Baca Selengkapnya</a>";
                    echo "</div>";
                }
            } else {
                echo "<div class='post'><p>Tidak ada artikel lifestyle saat ini.</p></div>";
            }
            ?>

            <div class="pagination">
                <a href="#">1</a>
                <a href="#">2</a>
                <a href="#">3</a>
            </div>
        </div>

        <div class="sidebar">
            <div class="sidebar-section">
                <h3>Trending Lifestyle</h3>
                <?php
                if ($result_trending->num_rows > 0) {
                    while ($trend = $result_trending->fetch_assoc()) {
                        echo "<div class='trending-post'>";
                        echo "<h4>" . $trend['title'] . "</h4>";
                        echo "<p>" . $trend['views'] . " views</p>";
                        echo "</div>";
                    }
                } else {
                    echo "<p>Tidak ada artikel trending.</p>";
                }
                ?>
            </div>

            <div class="sidebar-section">
                <h3>Kategori</h3>
                <ul class="category-list">
                    <li><a href="technology.php">Technology</a></li>
                    <li><a href="lifestyle.php" class="active">Lifestyle</a></li>
                </ul>
            </div>
        </div>
    </div>

    <footer>
        <div class="container">
            <p>&copy; 2024 Blog Saya. All rights reserved.</p>
        </div>
    </footer>

    <?php $conn->close(); ?>
</body>
</html>