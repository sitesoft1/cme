<?php
/**
 * Шаблон сайдбара (sidebar-popupform.php)
 * @package WordPress
 * @subpackage your-clean-template-3
 */
?>
<?php if (is_active_sidebar( 'sidebar-popupform' )) { // если в сайдбаре есть что выводить ?>
	<?php dynamic_sidebar('sidebar-popupform'); // выводим сайдбар, имя определено в functions.php ?>
	<?php //echo str_replace('textwidget', 'footer__social social', get_dynamic_sidebar('sidebar-popupform')); // выводим сайдбар с поиском и заменой класса, имя определено в functions.php ?>
<?php } ?>