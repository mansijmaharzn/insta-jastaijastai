<?php
/* Template Name: View Profile Page */
get_header();
require "config.php";
?>

<?php
    if (isset($_GET['username'])) {
        $username = $_GET['username'];

        // user info
        $user = $conn->query("SELECT * FROM users WHERE username='$username'");
        $user->execute();
        $theuser = $user->fetch(PDO::FETCH_OBJ);

        // posts
        $post = $conn->query("SELECT * FROM posts WHERE username='$username'");
        $post->execute();
        $thepost = $post->fetchAll(PDO::FETCH_OBJ);

        // likes
        $likes = $conn->query("SELECT * FROM likes WHERE username='$username'");
        $likes->execute();
        $thelike = $likes->fetchAll(PDO::FETCH_OBJ);

        // likes
        $comments = $conn->query("SELECT * FROM comments WHERE username='$username'");
        $comments->execute();
        $thecomment = $comments->fetchAll(PDO::FETCH_OBJ);
    }
?>
<div class="rounded-5 my-4 p-5" style="background-color: #04ccc2">
<h1 class="float-end">Owa Owa <?php echo $theuser->username; ?>! 👋</h1>
<h6 class="float-end">With us Since: <?php echo $theuser->created_at; ?></h6>
<h6 class="float-end">Email Address: <?php echo $theuser->email; ?></h6>
<h3>Posts Published: <?php echo count($thepost); ?></h3>
<h3>Contributed <?php echo count($thelike); ?> likes and <?php echo count($thecomment); ?> comments!!!</h3>
<h2>Keep it up 👌</h2>
</div>

<!-- Footer -->
<?php
// get_sidebar(); // search haru xa yesma
get_footer();
?>