<?php
require_once(__DIR__ . '/../../../wp-load.php');
global $wpdb;

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    //Получим модели авто
    if( isset($_POST['car_parent']) AND !empty($_POST['car_parent']) and isset($_POST['get_car_models']) ){
        $car_parent = (string) $_POST['car_parent'];
        $cars = get_terms([
            'taxonomy' => 'cars',
            'parent' => $car_parent
        ]);
        if($cars){
            $result = '';
            foreach ($cars as $car){
                $result .= '<div class="filter-select__item"><a href="#'.$car->slug.'" data-slug="'.$car->slug.'" data-term_id="'.$car->term_id.'" data-term_taxonomy_id="'.$car->term_taxonomy_id.'" data-taxonomy="'.$car->taxonomy.'" class="car_model filter-select__model">'.$car->name.'</a></div>';
            }
            if(!empty($result)){
                echo $result;
                die();
            }
        }
    }
    
}


