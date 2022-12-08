<?php
/* Template Name: Login Page */
get_header();
require "config.php";
?>

<?php
    // redirecting to index if logged in
    if (isset($_SESSION['username'])) {
        // header("location: wp-content/themes/insta-jastaijastai/");
        echo "<script>window.location.href='../../';</script>";
    }

    if (isset($_POST['submit'])) {
        $email = $_POST['email'];
        $password = $_POST['userpassword'];

        $login = $conn->query("SELECT * FROM users WHERE email='$email'");
        $login->execute();
        $data = $login->fetch(PDO::FETCH_ASSOC);

        if ($login->rowCount() > 0) { // email is in database if > 0
            if (password_verify($password, $data['userpassword'])) {
                $_SESSION['username'] = $data['username'];
                $_SESSION['userpassword'] = $data['userpassword'];
                
                // header("location: wp-content/themes/insta-jastaijastai/");
                echo "<script>window.location.href='/insta-jastaijastai';</script>";
                echo "Logged In!";
            } else {
                echo "Invalid Email or Password";
            }
        } else {
            echo "Email not Found! Try Signing Up!";
        }
    }
?>

<div class="container m-5 p-5 pt-2">
<h1 align="center">Login</h1>
<form action="<?php echo  get_permalink($page_id); ?>" method="POST">
<div class="form-floating mb-3 mt-4">
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