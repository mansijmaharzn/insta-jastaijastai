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

<h1>Owa Owa <?php echo $theuser->username; ?>! 👋</h1>
<h2>Email: <?php echo $theuser->email; ?></h2>
<h2>With us Since: <?php echo $theuser->created_at; ?></h2>
<h3>Posts: <?php echo count($thepost); ?></h3>
<h3>Contributed <?php echo count($thelike); ?> likes!</h3>
<h3>Contributed <?php echo count($thecomment); ?> comments!</h3>


<!-- Footer -->
<?php
// get_sidebar(); // search haru xa yesma
get_footer();
?>