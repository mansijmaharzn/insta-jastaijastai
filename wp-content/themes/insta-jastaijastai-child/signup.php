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
        // header("location: wp-content/themes/insta-jastaijastai/");
        echo "<script>window.location.href='../../';</script>";
    }

    if (isset($_POST['submit'])) {
        if ($_POST['email'] == '' OR $_POST['userpassword'] == '' OR $_POST['username'] == '') {
            echo "some inputs are empty!";
        } else {
          $email = $_POST['email'];
          $username = $_POST['username'];
          $password = $_POST['userpassword'];

          // fetch entered username and email in db
          $validity = $conn->query("SELECT * FROM users WHERE email='$email' OR username='$username'");
          $validity->execute();
          $valid = $validity->fetchAll(PDO::FETCH_OBJ);

          if (count($valid) == 0) {
            // add user
            $insert = $conn->prepare("INSERT INTO users (username, email, userpassword) VALUES (:username, :email, :userpassword)");
            $insert->execute([
                ':username' => $username,
                ':email' => $email,
                ':userpassword' => password_hash($password, PASSWORD_DEFAULT),
            ]);

            // add initial custom status
            $insertStatus = $conn->prepare("INSERT INTO custom_status (custom_status, username) VALUES (:custom_status, :username)");
            $insertStatus->execute([
                ':custom_status' => 'No Custom Status Yet!',
                ':username' => $username,
            ]);

            echo "Account Created!";
            
            $_SESSION['username'] = $username;
            $_SESSION['userpassword'] = $password;
            // header("location: wp-content/themes/insta-jastaijastai/");
            echo "<script>window.location.href='/insta-jastaijastai';</script>";
            echo "Logged In!";
          } else {
            echo "Username or Email Already Taken!";
          }
        }
    }
?>


<div class="container p-5 px-6">
<h1 align="center">Sign Up</h1>
<p align="center" class="my-3">Hey 👋! Just a few information to join.</p>
<form action="<?php echo  get_permalink($page_id); ?>" method="POST">
<div class="form-floating mb-3 mt-4">
  <input type="username" name="username" class="form-control rounded-4" id="floatingInput" placeholder="ankara-messi">
  <label for="floatingInput">Username</label>
</div>
<div class="form-floating mb-3">
  <input type="email" name="email" class="form-control rounded-4" id="floatingInput" placeholder="messi@ankara.com">
  <label for="floatingInput">Email address</label>
</div>
<div class="form-floating mb-4">
  <input type="password" name="userpassword" class="form-control rounded-4" id="floatingPassword" placeholder="Password">
  <label for="floatingPassword">Password</label>
</div>

<button class="btn me-2 text-black rounded-pill" type="submit" name="submit"
  style="background-color: #FFCDC4">Sign Up</button>
</form>
<h6 class="pt-4">Already have an account? <a href="/insta-jastaijastai/index.php/login">Login</a></h6>
</div>

<?php
// get_sidebar(); // search haru xa yesma
get_footer();
?>