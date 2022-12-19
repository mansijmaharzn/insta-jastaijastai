<?php
/* Template Name: View Profile Page */
get_header();
require "config.php";
?>

<?php
    // profile
    if (isset($_GET['username'])) {
        $username = $_GET['username'];

        // user info
        $user = $conn->query("SELECT * FROM users WHERE username='$username'");
        $user->execute();
        $theuser = $user->fetch(PDO::FETCH_OBJ);

        // custom status
        $custom_status = $conn->query("SELECT * FROM custom_status WHERE username='$username'");
        $custom_status->execute();
        $thecustom_status = $custom_status->fetch(PDO::FETCH_OBJ);

        // posts
        $post = $conn->query("SELECT * FROM posts WHERE username='$username'");
        $post->execute();
        $thepost = $post->fetchAll(PDO::FETCH_OBJ);

        // likes
        $likes = $conn->query("SELECT * FROM likes WHERE username='$username'");
        $likes->execute();
        $thelike = $likes->fetchAll(PDO::FETCH_OBJ);

        // comments
        $comments = $conn->query("SELECT * FROM comments WHERE username='$username'");
        $comments->execute();
        $thecomment = $comments->fetchAll(PDO::FETCH_OBJ);
    }

    // status
    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        $user_custom_status = $_POST['custom_status'];

        $custom_status = $conn->query("SELECT * FROM custom_status WHERE username='$username'");
        $custom_status->execute();
        $thecustom_status = $custom_status->fetchAll(PDO::FETCH_OBJ);

        if (count($thecustom_status) == 0) {
            $insert = $conn->prepare("INSERT INTO custom_status (custom_status, username) VALUES (:custom_status, :username)");
            $insert->execute([
                ':custom_status' => $user_custom_status,
                ':username' => $username,
            ]);
        } else {
            $conn->query("UPDATE custom_status SET `custom_status` = '$user_custom_status' WHERE username='$username'");
        }

        echo "<script>window.location.href='?username=$username';</script>";
    }
?>
<!-- if own profile -->
<?php if($_SESSION['username'] AND $_SESSION['username'] == $theuser->username) : ?>
<div class="rounded-5 my-4 p-5" style="background-color: #04ccc2">
<h1 class="float-end">Owa Owa <?php echo $theuser->username; ?>! 👋</h1>
<h6 class="float-end">Thanks for being with us since <?php echo $theuser->created_at; ?></h6>
<h6 class="float-end">Email Address: <?php echo $theuser->email; ?></h6>
<h4>You published <?php echo count($thepost); ?> posts!</h4>
<h4>You contributed <?php echo count($thelike); ?> likes and <?php echo count($thecomment); ?> comments!!!</h4>
<h3>Custom Status: <?php echo $thecustom_status->custom_status; ?></h3>
<h2>Keep it up 👌</h2>
<form method="POST">
    <div class="form-floating mb-3 mt-5" style="margin: 0% 15%">
        <input name="username" type="hidden" id="username" value=<?php echo $_SESSION['username']; ?>>
        <input type="text" name="custom_status" class="form-control rounded-4" id="floatingInput" placeholder="Enter Custom Status">
        <label for="floatingInput">Custom Status</label>
    </div>
    <button class="btn mb-4 text-black rounded-pill" style="background-color: #FE72BD" type="submit" name="submit">Update</button>
</form>
</div>
<?php else : ?>
<!-- if other's profile -->
<div class="rounded-5 my-4 p-5" style="background-color: #04b5cc">
    <h1 class="float-end">This is <?php echo $theuser->username; ?>! 👋</h1>
    <h6 class="float-end">Joined: <?php echo $theuser->created_at; ?></h6>
    <h6 class="float-end">Email Address: <?php echo $theuser->email; ?></h6>
    <h3>Posts Published: <?php echo count($thepost); ?></h3>
    <h3>Contributed <?php echo count($thelike); ?> likes and <?php echo count($thecomment); ?> comments!!!</h3>
    <h3>Custom Status: <?php echo $thecustom_status->custom_status; ?></h3>
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