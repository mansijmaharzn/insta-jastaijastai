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
			<a class="navbar-brand text-black" href="/insta-jastaijastai">Blogasm</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
			<div class="navbar-nav">
				<a class="nav-link" aria-current="page" href="/insta-jastaijastai">Home</a>
				<?php if(isset($_SESSION['username'])) : ?>
					<a class="nav-link" href="/insta-jastaijastai/index.php/create-post">Create Post</a>
					<a href="/insta-jastaijastai/index.php/viewprofile?username=<?php echo $_SESSION['username']; ?>" class="nav-link"><?php echo $_SESSION['username']; ?></a>
				<a class="nav-link" href="/insta-jastaijastai/index.php/logout">Logout</a>
				<?php else : ?>
				<a class="nav-link" href="/insta-jastaijastai/index.php/login">Login</a>
				<a class="nav-link" href="/insta-jastaijastai/index.php/signup">Sign Up</a>
				<?php endif; ?>
			</div>
			</div>
		</div>
		</nav>

		<nav class="navbar navbar-expand-lg bg-light">
		<div class="container-fluid">
			<a class="navbar-brand" href="/insta-jastaijastai">Blogasm</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav me-auto mb-2 mb-lg-0">
				<li class="nav-item">
				<a class="nav-link active" aria-current="page" href="/insta-jastaijastai">Home</a>
				</li>
				<li class="nav-item">
				<a class="nav-link" href="#">Link</a>
				</li>
				<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
					Dropdown
				</a>
				<ul class="dropdown-menu">
					<li><a class="dropdown-item" href="#">Action</a></li>
					<li><a class="dropdown-item" href="#">Another action</a></li>
					<li><hr class="dropdown-divider"></li>
					<li><a class="dropdown-item" href="#">Something else here</a></li>
				</ul>
				</li>
				<li class="nav-item">
				<a class="nav-link disabled">Disabled</a>
				</li>
			</ul>
			<form class="d-flex" role="search">
				<input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
				<button class="btn btn-outline-success" type="submit">Search</button>
			</form>
			</div>
		</div>
		</nav>

		<nav id="site-navigation" class="main-navigation">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'insta-jastaijastai' ); ?></button>
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
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->
	<!-- Alert -->
    <div id="msg"></div>
	<div class="container">