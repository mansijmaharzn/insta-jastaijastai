<?php
/* Template Name: Search View Page */
get_header();
require "config.php";
?>

<?php
    if (isset($_GET['query'])) {
        $searchquery = $_GET['query'];
        $searchquery = htmlspecialchars($searchquery); // changes characters used in html to their equivalents

        // posts
        $postresults = $conn->query("SELECT * FROM posts WHERE title LIKE '%".$searchquery."%'");
        $postresults->execute();
        $postresults = $postresults->fetchAll(PDO::FETCH_OBJ);
        $postresults = array_reverse($postresults);

        // users
        $userresults = $conn->query("SELECT * FROM users WHERE username LIKE '%".$searchquery."%'");
        $userresults->execute();
        $userresults = $userresults->fetchAll(PDO::FETCH_OBJ);
        $userresults = array_reverse($userresults);
    }
?>

<h1 align="center" class="m-5">Search Results for: "<?php echo $searchquery; ?>", just for you (❁´◡`❁)</h1>
<!-- Posts Results -->
<div class="row">
<div class="rounded-5 my-3 mx-4 p-5 col" style="background-color: #04ccc2">
<h2>Found <?php echo count($postresults); ?> results from posts:</h2>
<?php foreach($postresults as $singlePost) : ?>
<div>
    <h4><a style="text-decoration: none;" href="/insta-jastaijastai/index.php/view-post?id=<?php echo $singlePost->id; ?>"><?php echo $singlePost->title; ?></a></h4>
</div>
<?php endforeach; ?>
</div>
<!-- Users Results -->
<div class="rounded-5 my-3 p-5 col" style="background-color: #04b5cc">
<h2>Found <?php echo count($userresults); ?> results from users:</h2>
<?php foreach($userresults as $singleUser) : ?>
<div>
    <h4><a style="text-decoration: none;" href="/insta-jastaijastai/index.php/viewprofile?username=<?php echo $singleUser->username; ?>"><?php echo $singleUser->username; ?></a></h4>
</div>
<?php endforeach; ?>
</div>
</div>

<!-- Footer -->
<?php
// get_sidebar(); // search haru xa yesma
get_footer();
?>