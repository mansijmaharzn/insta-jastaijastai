<?php
get_header();
require "config.php";
?>

<?php
    $select = $conn->query("SELECT * FROM posts");
    $select->execute();
    $rows = $select->fetchAll(PDO::FETCH_OBJ);
    $rows = array_reverse($rows);
?>

<?php foreach($rows as $row) : ?>

<div class="rounded-5 my-4 p-5" style="background-color: #FFCDC4">
<h6 class="float-end">By <?php echo $row->username . " on " . date('Y-m-d', strtotime($row->created_at)); ?></h6>
<h1><?php echo $row->title; ?></h1>
<p><?php echo substr($row->body, 0, 500) . '...'; ?></p>
<h6>Likes: <?php echo $row->likes; ?></h6>
<h6>Views: <?php echo $row->views; ?></h6>

<a href="/insta-jastaijastai/index.php/view-post?id=<?php echo $row->id; ?>" class="btn btn-primary rounded-pill mt-2">View Post</a>
</div>
<?php endforeach; ?>

<?php
// get_sidebar(); // search haru xa yesma
get_footer();
?>