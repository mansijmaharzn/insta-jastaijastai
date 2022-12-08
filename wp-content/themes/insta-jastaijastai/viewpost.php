<?php
/* Template Name: View Post Page */
get_header();
require "config.php";
?>

<?php
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $post = $conn->query("SELECT * FROM posts WHERE id='$id'");
        $post->execute();

        $thepost = $post->fetch(PDO::FETCH_OBJ);
    }

    $id = $_GET['id'];
    $comments = $conn->query("SELECT * FROM comments WHERE post_id='$id'");
    $comments->execute();

    $comment = $comments->fetchAll(PDO::FETCH_OBJ);

    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        $post_id = $_POST['post_id'];
        $comment = $_POST['comment'];

        $insert = $conn->prepare("INSERT INTO comments (username, post_id, comment) VALUES (:username, :post_id, :comment)");
        $insert->execute([
            ':username' => $username,
            ':post_id' => $post_id,
            ':comment' => $comment,
        ]);

        echo "<script>window.location.href='?id=$id';</script>";
    }
?>

<!-- contents -->
<div>
    <h1><?php echo $thepost->title; ?></h1>
    <p><?php echo $thepost->body; ?></p>
</div>

<!-- Comments -->
<!-- commentForm -->
<form method="POST" id="comment_data">
    <!-- for hiddens -->
    <input name="username" type="hidden" id="username" value=<?php echo $thepost->username; ?>>
    <input name="post_id" type="hidden" id="post_id" value=<?php echo $thepost->id; ?>>

    <div class="form-floating mb-4">
        <textarea name="comment" class="form-control" placeholder="Enter Comment" id="comment" style="height: 100px"></textarea>
        <label for="floatingTextarea2">Comment</label>
    </div>
    <button name="submit" id="submit" type="submit">Comment</button>
</form>

<!-- showComments -->
<?php foreach($comment as $singleComment) : ?>
<div class="listComment">
    <h6><?php echo $singleComment->username; ?></h6>
    <p><?php echo $singleComment->comment; ?></p>
</div>
<?php endforeach; ?>

<!-- Footer -->
<?php
// get_sidebar(); // search haru xa yesma
get_footer();
?>