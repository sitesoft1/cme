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
                $result .= '<div class="filter-select__item"><a href="#'.$car->slug.'" data-slug="'.$car->slug.'" data-term_id="'.$car->term_id.'" data-term_taxonomy_id="'.$car->term_taxonomy_id.'" data-taxonomy="'.$car->taxonomy.'" data-car_parent="'.$car_parent.'" class="car_model filter-select__model">'.$car->name.'</a></div>';
            }
            if(!empty($result)){
                echo $result;
                die();
            }
        }
    }
    
    //Получим доступные услуги
    if( isset($_POST['get_services']) AND !empty($_POST['get_services']) ){
        
        $car_parent = (string) $_POST['car_parent'];
        $car_model = (string) $_POST['car_model'];
        
        $query = new WP_Query( array(
            'tax_query' => array(
                array(
                    'taxonomy' => 'cars',
                    'field'    => 'term_id',
                    'terms'    => $car_model
                )
            )
        ) );
        
        $object_ids = array();
        foreach ($query->posts as $post){
            $object_ids[] = $post->ID;
        }
        $object_terms = wp_get_object_terms( $object_ids, 'services');
        
        if($object_terms){
            $parents = [];
            foreach ($object_terms as $object_term){
                $parents[] = $object_term->parent;
            }
            array_unique($parents);
    
            $services = get_terms([
                'taxonomy' => 'services',
                'parent' => '0',
                'term_taxonomy_id' => $parents,
            ]);
            
            if($services){
                $result = '';
                foreach ($services as $service){
                    $result .= '<a href="#'.$service->slug.'" class="filter__item" data-slug="'.$service->slug.'" data-term_id="'.$service->term_id.'" data-term_taxonomy_id="'.$service->term_taxonomy_id.'" data-taxonomy="'.$service->taxonomy.'" data-car_model="'.$car_model.'" data-car_parent="'.$car_parent.'" data-name="'.$service->name.'"><div class="filter__item-wrapper">'.$service->name.'</div></a>';
                }
                if(!empty($result)){
                    echo $result;
                    die();
                }
            }
            
        }
    }
    
    //Получим цены услуг
    if( isset($_POST['get_final_services']) AND !empty($_POST['get_final_services']) ){
        
        $car_parent = (string) $_POST['car_parent'];
        $car_model = (string) $_POST['car_model'];
        $parent_service_term_id = (string) $_POST['term_id'];
        $parent_service_slug = (string) $_POST['slug'];
        
        $parent_service_name = (string) $_POST['service_name'];
        $item_header = '<div class="service-page__item" style="display: block;"><h2>'.$parent_service_name.'</h2><figure class="block-table">';
        $item_footer = '</figure></div>';
    
        $query = new WP_Query( array(
            'tax_query' => array(
                array(
                    'taxonomy' => 'cars',
                    'field'    => 'term_id',
                    'terms'    => $car_model
                )
            )
        ) );
        
        if($query){
            
            $result = $item_header;
            $result .= '<table><thead><tr><th>Наименование услуги</th><th>Цена</th></tr></thead><tbody>';
            foreach ($query->posts as $post){
                $object_term = wp_get_object_terms( $post->ID, 'services');
                if($parent_service_term_id == $object_term[0]->parent){
    
                    $prices_group = get_field( 'prices_group', $post->ID);
                    if(isset($prices_group) and !empty($prices_group)){
                        $prices = $prices_group["prices"];
                    }
                    
                    //Получили цены услуги
                    if(isset($prices) and !empty($prices)){
                        
                        //Если цена одна
                        if(count($prices) == 1){
                            $result .= '<tr><td>'.$object_term[0]->name.'</td><td>'.$prices[0]['price_value'].' руб.'.'</td></tr>';
                            //echo 'Услуга - '.$object_term[0]->name.' ее цена - '.$prices[0]['price_value'].' руб.'.PHP_EOL;
                        }
                       
                        
                        //Если цен много
                        if(count($prices) > 1){
                            echo 'услуга имеет много цен'.PHP_EOL;
                        }
    
                        /*
                        var_dump($prices_group);
                        echo PHP_EOL;
                        
                        var_dump($prices);
                        echo PHP_EOL;
                        
                        var_dump($post);
                        echo PHP_EOL;
                        var_dump($object_term);
                        */
                    }
                }
            }
            $result .= '</tbody></table>';
            $result .= $item_footer;
            
            echo $result;
            die();
        }
        
    }
    
}


