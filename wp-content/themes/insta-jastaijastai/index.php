<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package insta-jastaijastai
 */

get_header();
require "config.php";
?>

<?php
    $select = $conn->query("SELECT * FROM posts");
    $select->execute();
    $rows = $select->fetchAll(PDO::FETCH_OBJ);
?>

<?php foreach($rows as $row) : ?>
<div class="card">
    <div class="card-header">
    <?php echo $row->username . " " . $row->created_at; ?>
    </div>
    <div class="card-body">
        <h5 class="card-title"><?php echo $row->title; ?></h5>
        <p class="card-text"><?php echo substr($row->body, 0, 90) . '...'; ?></p>
        <a href="/insta-jastaijastai/index.php/view-post?id=<?php echo $row->id; ?>" class="btn btn-primary">View Post</a>
    </div>
</div>
<?php endforeach; ?>

<?php
// get_sidebar(); // search haru xa yesma
get_footer();
?>