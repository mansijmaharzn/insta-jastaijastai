<?php
/* Template Name: Create Post Page */
get_header();
require "config.php";
?>

<?php
    if (!isset($_SESSION['username'])) {
        echo "<script>window.location.href='../../';</script>";
    }

    if (isset($_POST['submit'])) {
        if ($_POST['title'] == '' OR $_POST['body'] == '') {
            echo "some inputs are empty!";
        } else {
            $title = $_POST['title'];
            $body = $_POST['body'];
            $username = $_SESSION['username'];

            $insert = $conn->prepare("INSERT INTO posts (title, body, username, likes, views) VALUES (:title, :body, :username, :likes, :views)");
            $insert->execute([
                ':title' => $title,
                ':body' => $body,
                ':username' => $username,
                ':likes' => 0,
                ':views' => 0,
            ]);

            echo "<script>window.location.href='../';</script>";
        }
    }
?>

<div class="m-5 p-5 pt-2">
<h1 align="center" class="mt-4">Create Post</h1>

<form method="POST" action="<?php echo  get_permalink($page_id); ?>">
    <div class="form-floating mb-3 mt-4" style="margin: 0% 15%">
        <input type="text" name="title" class="form-control rounded-4" id="floatingInput" placeholder="Enter Title">
        <label for="floatingInput">Title</label>
    </div>
    <div class="form-floating mb-4">
        <textarea name="body" class="form-control rounded-4" placeholder="Enter Body" id="floatingTextarea2" style="height: 200px"></textarea>
        <label for="floatingTextarea2">Body</label>
    </div>

    <button class="btn mx-2 mb-3 text-black rounded-pill" style="background-color: #FE72BD" type="submit" name="submit">Publish</button>
</form>
</div>

<!-- Footer -->
<?php
// get_sidebar(); // search haru xa yesma
get_footer();
?>