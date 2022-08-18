<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Martfury
 */
?>



<?php
do_action( 'martfury_before_site_content_close' );
 ?>
</div><!-- #content -->
<?php
do_action( 'martfury_before_footer' );
 ?>

	</div><!-- #page -->



	<?php wp_footer(); ?>

</body>
</html>
