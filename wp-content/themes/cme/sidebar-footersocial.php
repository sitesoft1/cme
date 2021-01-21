<?php
/**
 * Шаблон сайдбара (sidebar-footersocial.php)
 * @package WordPress
 * @subpackage your-clean-template-3
 */
?>
<?php if (is_active_sidebar( 'sidebar-footersocial' )) { // если в сайдбаре есть что выводить ?>
	<?php //dynamic_sidebar('sidebar-footersocial'); // выводим сайдбар, имя определено в functions.php ?>
	<?php echo str_replace('textwidget', 'footer__social social', get_dynamic_sidebar('sidebar-footersocial')); // выводим сайдбар с поиском и заменой класса, имя определено в functions.php ?>
<?php } ?>