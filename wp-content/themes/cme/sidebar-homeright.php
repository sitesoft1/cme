<?php
/**
 * Шаблон сайдбара (sidebar-homeright.php)
 * @package WordPress
 * @subpackage your-clean-template-3
 */
?>
<?php if (is_active_sidebar( 'sidebar-homeright' )) { // если в сайдбаре есть что выводить ?>
	<?php //dynamic_sidebar('sidebar-homeright'); // выводим сайдбар, имя определено в functions.php ?>
	<?php echo str_replace('class="textwidget custom-html-widget"', 'class="schedule__right" data-da="schedule__footer .container, 0, 860" data-da-index="0"', get_dynamic_sidebar('sidebar-homeright')); // выводим сайдбар с поиском и заменой класса, имя определено в functions.php ?>
<?php } ?>