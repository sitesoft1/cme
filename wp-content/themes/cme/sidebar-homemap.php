<?php
/**
 * Шаблон сайдбара (sidebar-homemap.php)
 * @package WordPress
 * @subpackage your-clean-template-3
 */
?>
<?php if (is_active_sidebar( 'sidebar-homemap' )) { // если в сайдбаре есть что выводить ?>
	<?php //dynamic_sidebar('sidebar-homemap'); // выводим сайдбар, имя определено в functions.php ?>
	<?php echo str_replace('textwidget', 'map__wrapper', get_dynamic_sidebar('sidebar-homemap')); // выводим сайдбар с поиском и заменой класса, имя определено в functions.php ?>
<?php } ?>