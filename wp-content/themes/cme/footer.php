<?php
/**
 * Шаблон подвала (footer.php)
 * @package WordPress
 * @subpackage your-clean-template-3
 */
?>
	<footer>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<?php $args = array(
						'theme_location' => 'bottom',
						'container'=> false,
						'menu_class' => 'nav nav-pills bottom-menu',
				  		'menu_id' => 'bottom-nav',
				  		'fallback_cb' => false
				  	);
					wp_nav_menu($args);
					?>
				</div>
			</div>
		</div>
	</footer>
<?php wp_footer(); ?>
<!--<script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/script.min.js"></script>-->
</html>
