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

<div class="container p-5 px-6">
<h1 align="center">Login</h1>
<form action="<?php echo  get_permalink($page_id); ?>" method="POST">
<div class="form-floating mb-3 mt-4">
  <input type="email" name="email" class="form-control rounded-4" id="floatingInput" placeholder="messi@ankara.com">
  <label for="floatingInput">Email address</label>
</div>
<div class="form-floating mb-4">
  <input type="password" name="userpassword" class="form-control rounded-4" id="floatingPassword" placeholder="Password">
  <label for="floatingPassword">Password</label>
</div>

<button class="btn me-2 text-black rounded-pill" type="submit" name="submit"
    style="background-color: #FFCDC4">Sign In</button>
</form>
<h6 class="pt-4">Don't have an account? <a href="/insta-jastaijastai/index.php/signup">Sign Up</a></h6>
</div>


<?php
// get_sidebar(); // search haru xa yesma
get_footer();
?>