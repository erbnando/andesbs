<?php
/**
 * Template Name: Under Construction
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
?>

<!DOCTYPE html>
<html>
<body>

	<?php while ( have_posts() ) : the_post();

		the_content();

	endwhile; // End of the loop. ?>

</body>
</html>