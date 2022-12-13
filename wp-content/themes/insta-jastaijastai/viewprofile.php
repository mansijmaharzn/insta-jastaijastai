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
<?php if($_SESSION['username']) : ?>
<!-- if own profile -->
<?php if($_SESSION['username'] == $theuser->username) : ?>
<div class="rounded-5 my-4 p-5" style="background-color: #04ccc2">
<h1 class="float-end">Owa Owa <?php echo $theuser->username; ?>! 👋</h1>
<h6 class="float-end">Thanks for being with us since <?php echo $theuser->created_at; ?></h6>
<h6 class="float-end">Email Address: <?php echo $theuser->email; ?></h6>
<h3>You published <?php echo count($thepost); ?> posts!</h3>
<h3>You contributed <?php echo count($thelike); ?> likes and <?php echo count($thecomment); ?> comments!!!</h3>
<h2>Keep it up 👌</h2>
</div>
<?php endif; ?>
<!-- if other's profile -->
<?php else : ?>
<div class="rounded-5 my-4 p-5" style="background-color: #04b5cc">
<h1 class="float-end">This is <?php echo $theuser->username; ?>! 👋</h1>
<h6 class="float-end">Joined: <?php echo $theuser->created_at; ?></h6>
<h6 class="float-end">Email Address: <?php echo $theuser->email; ?></h6>
<h3>Posts Published: <?php echo count($thepost); ?></h3>
<h3>Contributed <?php echo count($thelike); ?> likes and <?php echo count($thecomment); ?> comments!!!</h3>
</div>
<?php endif; ?>

<!-- posts -->
<div class="rounded-5 my-4 p-5" style="background-color: #FFCDC4">
<h3><?php echo $theuser->username; ?>'s Posts</h3>
<?php foreach($thepost as $row) : ?>
<div class="card">
    <div class="card-header">
    <?php echo $row->username . " " . $row->created_at; ?>
    </div>
    <div class="card-body">
        <h5 class="card-title"><?php echo $row->title; ?></h5>
        <p class="card-text"><?php echo substr($row->body, 0, 90) . '...'; ?></p>
        <p><p>Likes: <?php echo $row->likes; ?></p></p>
        <a href="/insta-jastaijastai/index.php/view-post?id=<?php echo $row->id; ?>" class="btn btn-primary">View Post</a>
    </div>
</div>
<?php endforeach; ?>
</div>

<!-- Footer -->
<?php
// get_sidebar(); // search haru xa yesma
get_footer();
?>