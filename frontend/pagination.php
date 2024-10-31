<?php
// Set the number of items per page and calculate the total pages
$items_per_page = 6;
$sql_count = "SELECT COUNT(*) AS total FROM post";
$result_count = $conn->query($sql_count);
$row_count = $result_count->fetch_assoc();
$total_pages = ceil($row_count['total'] / $items_per_page);

// Get the current page or set a default
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$current_page = max(1, min($total_pages, $current_page));

// Calculate the offset for the SQL LIMIT clause
$offset = ($current_page - 1) * $items_per_page ;

// Fetch the items for the current page
$sql_pagination = "SELECT * FROM post ORDER BY view DESC LIMIT $offset, $items_per_page";
$result_pagination = $conn->query($sql_pagination);

// Display each article (this part may need adjustments based on your layout)
if ($result_pagination->num_rows > 0) {
    while ($row = $result_pagination->fetch_assoc()) {
        // Your article display code here
    }
}
?>

<div class="pagination">
    <?php if ($current_page > 1): ?>
        <a href="?page=<?php echo $current_page - 1; ?>">&laquo; Previous</a>
    <?php endif; ?>

    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
        <?php if ($i == $current_page): ?>
            <strong><?php echo $i; ?></strong>
        <?php else: ?>
            <a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
        <?php endif; ?>
    <?php endfor; ?>

    <?php if ($current_page < $total_pages): ?>
        <a href="?page=<?php echo $current_page + 1; ?>">Next &raquo;</a>
    <?php endif; ?>
</div>