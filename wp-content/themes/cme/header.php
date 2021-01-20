<?php
/**
 * Шаблон шапки (header.php)
 * @package WordPress
 * @subpackage your-clean-template-3
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!--<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/style.css" type="text/css" />-->
    
	<?php wp_head(); ?>
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/style.min.css" type="text/css" />
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
            integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/script.min.js"></script>
    <!-- Подсветка активного пунтка меню -->
    <script>
        $( document ).ready(function() {
            var url=document.location.href;
            $.each($(".header__list li.header__item a.header__link"),function(){
                if(this.href==url){
                    $(this).parent().addClass('header__item--active');
                }
            });
        });
    </script>
    <!-- Подсветка активного пунтка меню КОНЕЦ -->
</head>

