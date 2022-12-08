<?php
/* Template Name: SignUp Page */
get_header();
require "config.php";
?>

<?php
    // error_reporting(E_ALL);
    // ini_set('display_errors', 1);

    // redirecting to index if logged in
    if (isset($_SESSION['username'])) {
        header("location: wp-content/themes/insta-jastaijastai/");
    }

    if (isset($_POST['submit'])) {
        if ($_POST['email'] == '' OR $_POST['userpassword'] == '' OR $_POST['username'] == '') {
            echo "some inputs are empty!";
        } else {
          $email = $_POST['email'];
          $username = $_POST['username'];
          $password = $_POST['userpassword'];

          $insert = $conn->prepare("INSERT INTO users (username, email, userpassword) VALUES (:username, :email, :userpassword)");
          $insert->execute([
              ':username' => $username,
              ':email' => $email,
              ':userpassword' => password_hash($password, PASSWORD_DEFAULT),
          ]);
          echo "Account Created!";

          $_SESSION['username'] = $username;
          $_SESSION['userpassword'] = $password;
          // header("location: wp-content/themes/insta-jastaijastai/");
          echo "<script>window.location.href='/insta-jastaijastai';</script>";
          echo "Logged In!";
        }
    }
?>


<div class="container m-5 p-5 pt-2">
<h1 align="center">Sign Up</h1>
<form action="<?php echo  get_permalink($page_id); ?>" method="POST">
<div class="form-floating mb-3 mt-4">
  <input type="username" name="username" class="form-control" id="floatingInput" placeholder="ankara-messi">
  <label for="floatingInput">Username</label>
</div>
<div class="form-floating mb-3">
  <input type="email" name="email" class="form-control" id="floatingInput" placeholder="messi@ankara.com">
  <label for="floatingInput">Email address</label>
</div>
<div class="form-floating mb-4">
  <input type="password" name="userpassword" class="form-control" id="floatingPassword" placeholder="Password">
  <label for="floatingPassword">Password</label>
</div>

<button class="btn btn-outline-info me-2 text-black" type="submit" name="submit">Sign Up</button>
</form>
</div>

<?php
// get_sidebar(); // search haru xa yesma
get_footer();
?>