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

    // comment
    $id = $_GET['id'];
    $comments = $conn->query("SELECT * FROM comments WHERE post_id='$id'");
    $comments->execute();

    $comment = $comments->fetchAll(PDO::FETCH_OBJ);
    $comment = array_reverse($comment);

    if (isset($_POST['submit'])) {
        if ($_POST['comment'] == '') {
            echo "Can't comment nothing!";
        } else {
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
    }

    // like
    $likes = $conn->query("SELECT * FROM likes WHERE username='$_SESSION['username']' AND post_id='$id'");
    $likes->execute();

    $like = $likes->fetchAll(PDO::FETCH_OBJ);

    echo mysql_num_rows($like);

    if (isset($_POST['like'])) {
        $post_id = $_POST['post_id'];
        $username = $_POST['username'];

        $conn->query("UPDATE posts SET `likes` = `likes` + 1 WHERE id='$id'");

        $insert = $conn->prepare("INSERT INTO likes (username, post_id) VALUES (:username, :post_id)");
        $insert->execute([
            ':username' => $username,
            ':post_id' => $post_id,
        ]);

        echo "<script>window.location.href='?id=$id';</script>";
    }
?>

<!-- contents -->
<div class="rounded-5 my-4 p-5" style="background-color: #FFCDC4">
    <h1><?php echo $thepost->title; ?></h1>
    <p><?php echo $thepost->body; ?></p>
    <p>Likes: <?php echo $thepost->likes; ?></p>

<form method="POST">
    <input name="username" type="hidden" id="username" value=<?php echo $_SESSION['username']; ?>>
    <input name="post_id" type="hidden" id="post_id" value=<?php echo $thepost->id; ?>>
    <button class="btn mb-3 text-black rounded-pill" style="background-color: #FE72BD" name="like" id="like" type="submit">Like</button>
</form>
</div>

<!-- Comments -->
<!-- commentForm -->
<?php if (isset($_SESSION['username'])) : ?>
<form method="POST" id="comment_data">
    <!-- for hiddens -->
    <input name="username" type="hidden" id="username" value=<?php echo $_SESSION['username']; ?>>
    <input name="post_id" type="hidden" id="post_id" value=<?php echo $thepost->id; ?>>

    <div class="form-floating mb-4 mx-2">
        <textarea name="comment" class="form-control rounded-4" placeholder="Enter Comment" id="comment" style="height: 100px"></textarea>
        <label for="floatingTextarea2">Comment</label>
    </div>

    <button class="btn mx-2 mb-3 text-black rounded-pill" style="background-color: #FE72BD" name="submit" id="submit" type="submit">Comment</button>
</form>
<?php else : ?>
<h3 align="center" class="m-2 p-2" style="color: red;"><a href="/insta-jastaijastai/index.php/login">Login</a> to Comment :)</h3>
<?php endif; ?>

<!-- showComments -->
<div class="rounded-5 p-4 mt-3" style="background-color: #FFCDC4">
<h3>Comments</h3>
<?php foreach($comment as $singleComment) : ?>
<div class="listComment my-3 px-4 pt-1 rounded-pill" style="background-color: #F9D1D4">
    <h6><?php echo $singleComment->username; ?></h6>
    <p><?php echo $singleComment->comment; ?></p>
</div>
<?php endforeach; ?>
</div>

<!-- Footer -->
<?php
// get_sidebar(); // search haru xa yesma
get_footer();
?>