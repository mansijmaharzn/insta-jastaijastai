<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package insta-jastaijastai
 */
	session_start();
?>

<?php
	if (isset($_POST['search'])) {
        if ($_POST['searchquery'] == '') {
            echo "Can't search nothing!";
        } else {
            $searchquery = $_POST['searchquery'];

            echo "<script>window.location.href='index.php/search-view?query=$searchquery';</script>";
        }
    }
?>

<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
		<nav class="navbar navbar-expand-lg bg-light">
		<div class="container-fluid">
			<div class="logo">
			<a class="navbar-brand" href="/insta-jastaijastai">
				<img src="http://localhost/insta-jastaijastai/wp-content/uploads/2022/12/images/logo-main.png" alt="blogasm">
			</a>
			</div>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav me-auto mb-2 mb-lg-0">
				<li class="nav-item">
				<a class="nav-link" aria-current="page" href="/insta-jastaijastai">Home</a>
				</li>

				<?php if(isset($_SESSION['username'])) : ?>
				<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="/insta-jastaijastai/index.php/viewprofile?username=<?php echo $_SESSION['username']; ?>" role="button" data-bs-toggle="dropdown" aria-expanded="false">
				<?php echo $_SESSION['username']; ?>
				</a>
				<ul class="dropdown-menu">
					<li><a class="dropdown-item" href="/insta-jastaijastai/index.php/viewprofile?username=<?php echo $_SESSION['username']; ?>">View Profile</a></li>
					<li><a class="dropdown-item" href="/insta-jastaijastai/index.php/create-post">Create Post</a></li>
					<li><hr class="dropdown-divider"></li>
					<li><a class="dropdown-item" href="/insta-jastaijastai/index.php/logout">Logout</a></li>
				</ul>
				</li>

				<?php else : ?>
				<li>
				<a class="nav-link" href="/insta-jastaijastai/index.php/login">Login</a>
				</li>
				<li>
				<a class="nav-link" href="/insta-jastaijastai/index.php/signup">Sign Up</a>
				</li>
				<?php endif; ?>
			</ul>
			<form class="d-flex" role="search" method="POST">
				<input name="searchquery" class="p-2 rounded-4 form-control me-2" type="search" placeholder="Search" aria-label="Search">
				<button class="rounded-pill btn btn-outline-success" type="submit" name="search" id="search">Search</button>
			</form>
			</div>
		</div>
		</nav>

		<?php
			wp_nav_menu(
				array(
					'theme_location' => 'menu-1',
					'menu_id'        => 'primary-menu',
					'depth'			 => 2, // 1 = no dropdowns, 2 = with dropdowns.
					'container'		 => 'div',
					'container_class'=> 'collapse navbar-collapse',
					'container_id'	 => 'bs-example-navbar-collapse-1',
					'menu_class'	 => 'navbar',
					'fallback_cb'	 => 'WP_Bootstrap_Navwalker::fallback',
					'walker'		 => new WP_Bootstrap_Navwalker(),
				)
			);
		?>
	</header><!-- #masthead -->
	<!-- Alert -->
    <div id="msg"></div>
	<div class="container">