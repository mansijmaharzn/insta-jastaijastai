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

        $featuredpost = $conn->query("SELECT * FROM posts WHERE title LIKE '%".$thepost->title."%'");
        $featuredpost->execute();
        $thefeaturedpost = $featuredpost->fetchAll(PDO::FETCH_OBJ);
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
    $username = $_SESSION['username'];
    $likes = $conn->query("SELECT * FROM likes WHERE post_id='$id' AND username='$username'");
    $likes->execute();

    $like = $likes->fetchAll(PDO::FETCH_OBJ);

    // liking
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

    // diliking
    if (isset($_POST['dislike'])) {
        $post_id = $_POST['post_id'];
        $username = $_POST['username'];

        $conn->query("UPDATE posts SET `likes` = `likes` - 1 WHERE id='$id'");

        $conn->query("DELETE FROM likes WHERE post_id='$post_id' AND username='$username'");

        echo "<script>window.location.href='?id=$id';</script>";
    }
?>

<!-- contents -->
<div class="rounded-5 my-4 p-5" style="background-color: #FFCDC4">
    <h1><?php echo $thepost->title; ?></h1>
    <p><?php echo $thepost->body; ?></p>
    <p>Post By: <a href="/insta-jastaijastai/index.php/viewprofile?username=<?php echo $thepost->username; ?>"><?php echo $thepost->username; ?></a></p>
    <p>Likes: <?php echo $thepost->likes; ?></p>
</div>

<!-- Comments -->
<?php if (isset($_SESSION['username'])) : ?>
<!-- like-btn -->
<?php if (count($like) == 0) : ?>
<form method="POST">
    <input name="username" type="hidden" id="username" value=<?php echo $_SESSION['username']; ?>>
    <input name="post_id" type="hidden" id="post_id" value=<?php echo $thepost->id; ?>>
    <button class="btn mb-3 text-black rounded-pill" style="background-color: #05e6bc" name="like" id="like" type="submit">Like Post</button>
</form>
<?php else : ?>
<form method="POST">
    <input name="username" type="hidden" id="username" value=<?php echo $_SESSION['username']; ?>>
    <input name="post_id" type="hidden" id="post_id" value=<?php echo $thepost->id; ?>>
    <button class="btn mb-3 text-black rounded-pill" style="background-color: #ae64c4" name="dislike" id="dislike" type="submit">Dislike Post</button>
</form>
<?php endif; ?>

<!-- commentForm -->
<form method="POST" id="comment_data">
    <!-- for hiddens -->
    <input name="username" type="hidden" id="username" value=<?php echo $_SESSION['username']; ?>>
    <input name="post_id" type="hidden" id="post_id" value=<?php echo $thepost->id; ?>>

    <div class="form-floating mb-4 mx-2">
        <textarea name="comment" class="form-control rounded-4 mt-4" placeholder="Enter Comment" id="comment" style="height: 100px"></textarea>
        <label for="floatingTextarea2">Comment</label>
    </div>

    <button class="btn mx-2 mb-3 text-black rounded-pill" style="background-color: #FE72BD" name="submit" id="submit" type="submit">Comment</button>
</form>

<?php else : ?>
<h3 align="center" class="m-2 p-2" style="color: red;"><a href="/insta-jastaijastai/index.php/login">Login</a> to Like and Comment pretty stranger ;)</h3>
<?php endif; ?>

<div class="row">
<!-- showComments -->
<div class="col rounded-5 my-3 mx-4 p-5" style="background-color: #FFCDC4">
<h3><?php echo count($comment); ?> Comments</h3>
<?php foreach($comment as $singleComment) : ?>
<div class="listComment my-3 pt-1">
    <h6><a href="/insta-jastaijastai/index.php/viewprofile?username=<?php echo $singleComment->username; ?>"><?php echo $singleComment->username; ?></a></h6>
    <p><?php echo $singleComment->comment; ?></p>
</div>
<?php endforeach; ?>
</div>

<!-- featuredPosts -->
<div class="col rounded-5 my-3 mx-4 p-5" style="background-color: #FFCDC4">
<h3><?php echo count($thefeaturedpost) - 1; ?> Related Posts</h3>
<?php foreach($thefeaturedpost as $singleFeaturedPost) : ?>
<div class="my-3">
    <?php if ($singleFeaturedPost->title != $thepost->title) : ?>
    <a href="/insta-jastaijastai/index.php/view-post?id=<?php echo $singleFeaturedPost->id; ?>"><?php echo $singleFeaturedPost->title; ?></a>
    <?php endif; ?>
</div>
<?php endforeach; ?>
</div>
</div>

<!-- Footer -->
<?php
// get_sidebar(); // search haru xa yesma
get_footer();
?>