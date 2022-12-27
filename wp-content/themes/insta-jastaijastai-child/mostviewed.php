<?php
/* Template Name: Most Viewed Page */
get_header();
require "config.php";
?>

<?php
    $select = $conn->query("SELECT * FROM posts ORDER BY views");
    $select->execute();
    $rows = $select->fetchAll(PDO::FETCH_OBJ);
    $rows = array_reverse($rows);
?>

<?php foreach($rows as $row) : ?>
<div class="card">
    <div class="card-header">
    <?php echo $row->username . " " . $row->created_at; ?>
    </div>
    <div class="card-body">
        <h5 class="card-title"><?php echo $row->title; ?></h5>
        <p class="card-text"><?php echo substr($row->body, 0, 90) . '...'; ?></p>
        <p>Likes: <?php echo $row->likes; ?></p>
        <p>Views: <?php echo $row->views; ?></p>
        <a href="/insta-jastaijastai/index.php/view-post?id=<?php echo $row->id; ?>" class="btn btn-primary">View Post</a>
    </div>
</div>
<?php endforeach; ?>

<!-- Footer -->
<?php
// get_sidebar(); // search haru xa yesma
get_footer();
?>