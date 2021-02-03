<?php
/**
 * Template Name: Шаблон страницы услуги
 * Template Post Type: page
 * Шаблон обычной страницы (page-service.php)
 * @package WordPress
 * @subpackage your-clean-template-3
 */
get_header(); ?>
<?php
$page_id = get_the_ID();

function filter_service_url($service, $page_query_arr){
    unset($page_query_arr['services_terms'][array_search($service->term_id, $page_query_arr['services_terms'])]);
    //unset($page_query_arr['services_terms_names'][array_search($service->name, $page_query_arr['services_terms_names'])]);
    return http_build_query($page_query_arr);
}

function add_service_url($service, $page_query_arr){
    $page_query_arr['services_terms'][] = $service->term_id;
    //$page_query_arr['services_terms_names'][] = $service->name;
    return http_build_query($page_query_arr);
}

$page_url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$page_url = explode('?', $page_url);
$page_url = $page_url[0];

$car_mark_slug = isset($_GET['car_mark_slug']) ? $_GET['car_mark_slug'] : "" ;
$car_mark_name = isset($_GET['car_mark_name']) ? $_GET['car_mark_name'] : "";
$car_mark_term_id = isset($_GET['car_mark_term_id']) ? $_GET['car_mark_term_id'] : "" ;

$car_model_slug = isset($_GET['car_model_slug']) ? $_GET['car_model_slug'] : "" ;
$car_model_name = isset($_GET['car_model_name']) ? $_GET['car_model_name'] : "";
$car_model_term_id = isset($_GET['car_model_term_id']) ? $_GET['car_model_term_id'] : "" ;

$service_slug = isset($_GET['service_slug']) ? $_GET['service_slug'] : "" ;
$service_name = isset($_GET['service_name']) ? $_GET['service_name'] : "";
$service_term_id = isset($_GET['service_term_id']) ? $_GET['service_term_id'] : "" ;

$services_terms = isset($_GET['services_terms']) ? $_GET['services_terms'] : array();

$page_query_string = !empty($_SERVER['QUERY_STRING']) ? $_SERVER['QUERY_STRING'] : "";
?>
<?php if($_SERVER['REQUEST_METHOD'] == 'POST'){ ?>
    <script>
        $( document ).ready(function() {
            $('#appointment').toggleClass("open");
        });
    </script>
<?php } ?>

    <header class="site__header header ">
        <div class="header__container container">
            <div class="header__body">
                <div class="header__logo logo">
                    <div class="logo__bg"></div>
                    <a href="/" class="logo__link">
                        <div class="logo__img">
                            <svg width="157" height="89" viewBox="0 0 157 89" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                      d="M122.688 0H119.207C118.73 0.0397359 118.256 0.102178 117.779 0.113531C117.331 0.124884 117.077 0.266798 116.937 0.740792C116.211 3.24132 115.437 5.72765 114.703 8.22534C114.581 8.64825 114.401 8.85544 113.941 8.986C112.493 9.40323 111.077 9.92263 109.632 10.3597C109.397 10.4307 109.035 10.3768 108.841 10.2348C106.533 8.54323 104.249 6.82323 101.824 5.01241C90.9322 5.42963 79.3492 5.6198 68.4517 5.89511C53.2734 6.27828 38.095 6.66145 22.9167 7.05029C15.6403 7.23478 8.3638 7.43062 1.0902 7.62079C0.821758 7.6293 0.556173 7.64633 0.290588 7.83082H98.0544C97.5889 8.18277 97.1177 8.52336 96.6523 8.88098C96.6094 8.91504 96.5751 8.98032 96.5466 9.04844C87.2368 9.34646 77.6129 9.52527 68.4517 9.75801C53.2734 10.1412 38.095 10.5243 22.9167 10.9104C15.6403 11.0977 8.3638 11.2935 1.0902 11.4837C0.821758 11.4894 0.556173 11.5092 0.290588 11.6937H97.3119C97.4861 12.1677 97.6603 12.6389 97.8345 13.1129C88.125 13.4364 78.0356 13.6209 68.4517 13.8622C53.2734 14.2482 38.095 14.6285 22.9167 15.0173C15.6403 15.2018 8.3638 15.3977 1.0902 15.5878C0.821758 15.5964 0.556173 15.6134 0.290588 15.7979H98.8198C98.974 16.2151 99.1225 16.6323 99.2767 17.0467C89.1331 17.4015 78.5125 17.5917 68.4517 17.8471C53.2734 18.2303 38.095 18.6135 22.9167 18.9995C15.6403 19.1868 8.3638 19.3798 1.0902 19.5728C0.821758 19.5813 0.556173 19.5955 0.290588 19.7828H102.975L104.765 21.0771C93.7708 21.4063 78.1613 21.5851 68.4517 21.8292C53.2734 22.2124 38.095 22.5956 22.9167 22.9844C15.6403 23.1689 8.3638 23.3647 1.0902 23.5577C0.821758 23.5634 0.556173 23.5804 0.290588 23.7649L108.506 23.782C111.636 20.5463 116.029 18.5595 120.858 18.5567C130.39 18.551 138.012 26.0923 138.024 35.5438C138.024 38.2004 137.41 40.6839 136.347 42.8978L145.8 49.3889C145.92 49.3549 146.045 49.335 146.197 49.3379C148.85 49.4344 151.506 49.494 154.161 49.5848C154.598 49.6018 154.838 49.4996 154.987 49.0484C155.632 47.124 156.315 45.2167 156.991 43.281C155.621 42.3727 154.367 41.5439 153.113 40.7095C151.957 39.9375 150.792 39.1768 149.655 38.3764C149.472 38.2487 149.324 37.9478 149.321 37.7236C149.295 36.3584 149.344 34.996 149.312 33.6336C149.301 33.1057 149.432 32.7765 149.903 32.4756C152.12 31.0451 154.304 29.5635 156.509 28.1189C156.78 27.94 156.889 27.8038 156.78 27.4661C156.152 25.5389 155.552 23.6003 154.938 21.6504C152.097 21.7327 149.398 21.7696 146.708 21.9115C145.894 21.9541 145.443 21.7526 144.992 21.0601C144.206 19.8509 143.252 18.7469 142.396 17.5803C142.273 17.4157 142.204 17.112 142.27 16.9247C143.147 14.4696 144.038 12.0201 144.96 9.58204C145.157 9.06263 145.137 8.71636 144.646 8.38712C143.101 7.34547 141.57 6.27828 140.04 5.21109C139.711 4.97835 139.474 5.00957 139.146 5.25934C136.99 6.89419 134.808 8.49498 132.652 10.1298C132.352 10.3569 132.112 10.3427 131.787 10.2377C130.279 9.7495 128.765 9.27834 127.246 8.8299C126.903 8.72772 126.726 8.59432 126.621 8.23102C125.875 5.7163 125.087 3.21294 124.342 0.698217C124.213 0.275313 124.045 0.0624422 123.573 0.0993399C123.282 0.122046 122.982 0.0368977 122.688 0V0Z"
                                      fill="url(#paint0_linear)" />
                                <path
                                        d="M44.4833 40.525L43.1697 46.545H30.4159L31.6924 40.525H29.7791L23.7192 64.9257H25.6325L27.5459 57.7959H40.9393L37.5096 67.6987C36.8442 70.2872 35.422 71.5815 33.2459 71.5815H12.2419C9.7431 71.5815 8.90637 69.9949 9.73168 66.8273L17.2623 38.3054C18.1133 35.1379 19.8382 33.5513 22.4455 33.5513H34.0027C38.2521 33.5002 40.9908 33.5513 42.213 33.7102C44.1007 34.3999 45.0431 35.6005 45.0431 37.3149C45.0431 38.1607 44.8574 39.2307 44.4833 40.525V40.525Z"
                                        fill="#373738" />
                                <path
                                        d="M91.7917 40.5249L83.8213 71.5814H70.7477L78.8409 40.5249H76.9275L68.9942 71.5814H55.9206L64.0138 40.5249H62.2604L53.9701 71.5814H40.9764L51.0201 33.5513H66.484H78.6781H89.2015C91.3005 34.346 92.3514 35.6005 92.3514 37.3148C92.3514 38.1606 92.1629 39.2307 91.7917 40.5249V40.5249Z"
                                        fill="#373738" />
                                <path
                                        d="M124.276 40.525L122.642 46.071H110.366L111.482 40.525H109.569L107.815 48.1287H122.003L120.249 56.0532H105.902L103.512 64.9257H105.422L107.336 58.4289H119.612L117.302 67.6987C116.637 70.2872 115.215 71.5815 113.036 71.5815H92.0316C89.5328 71.5815 88.6961 69.9949 89.5214 66.8273L97.0549 38.3054C97.903 35.1379 99.6308 33.5513 102.235 33.5513H113.792C118.045 33.5002 120.78 33.5513 122.003 33.7102C123.89 34.3999 124.833 35.6005 124.833 37.3149C124.833 38.1607 124.647 39.2307 124.276 40.525V40.525Z"
                                        fill="#373738" />
                                <path
                                        d="M6.58465 84.0102H3.74032L4.04874 82.8749H3.62894L2.82076 85.8949H3.22914L3.46331 85.0377H6.31621L5.63654 87.5382H0.841726C0.804602 87.5382 0.738919 87.5297 0.653247 87.5042C0.561863 87.4843 0.470479 87.4474 0.376239 87.385C0.281999 87.3282 0.199182 87.2544 0.124932 87.1522C0.0506828 87.05 0.013558 86.9308 0.00499078 86.7832C-0.00357648 86.6981 -0.00357648 86.6158 0.0249811 86.5136C0.0421156 86.4114 0.0706731 86.3036 0.107798 86.173L1.14729 82.3016C1.21297 82.0348 1.35291 81.8134 1.56709 81.6374C1.78127 81.4615 2.0954 81.3792 2.5152 81.3792H6.25909C6.50183 81.3792 6.68745 81.3962 6.80739 81.4416C6.93019 81.4898 7.01301 81.5438 7.0587 81.6091C7.10725 81.6743 7.12438 81.7566 7.12438 81.839C7.11582 81.9241 7.11582 82.0149 7.10725 82.1001L6.58465 84.0102V84.0102Z"
                                        fill="#373738" />
                                <path d="M11.4594 80.0027L9.42327 87.5412H6.29907L8.33522 80.0027H11.4594Z"
                                      fill="#373738" />
                                <path
                                        d="M11.2024 83.4284H14.0296L13.3242 86.0708H13.7983L14.5408 83.2922C14.5493 83.2439 14.5322 83.207 14.4836 83.1616C14.438 83.1247 14.3637 83.0963 14.2809 83.0793H11.2881L11.7535 81.3792H16.5855C16.7054 81.3792 16.8082 81.4075 16.911 81.4615C17.0138 81.5267 17.0967 81.6005 17.1709 81.6828C17.2366 81.7765 17.2909 81.8673 17.328 81.9695C17.3651 82.0717 17.3851 82.1739 17.3851 82.2562L16.1857 86.7094C16.1771 86.7378 16.1486 86.8003 16.1114 86.8939C16.0657 86.9848 16.0086 87.0784 15.9258 87.1692C15.843 87.2714 15.7288 87.3537 15.5917 87.4304C15.4517 87.5013 15.2747 87.5382 15.0605 87.5382H11.1938C11.0282 87.5382 10.8883 87.5297 10.7683 87.5212C10.6455 87.5127 10.5513 87.4843 10.4799 87.4389C10.4056 87.3935 10.3485 87.3282 10.32 87.226C10.2943 87.1324 10.2743 87.0046 10.2828 86.8372L11.2024 83.4284V83.4284Z"
                                        fill="#373738" />
                                <path
                                        d="M20.2123 84.6403H17.4051L18.0762 82.154C18.2132 81.6374 18.6502 81.3792 19.4041 81.3792H23.3822C23.5221 81.3792 23.642 81.3877 23.7534 81.3962C23.8648 81.4075 23.959 81.4331 24.0247 81.4785C24.0875 81.5267 24.1332 81.6005 24.1532 81.6942C24.1703 81.7935 24.1646 81.9241 24.1161 82.0802L23.6792 83.698H20.9091L21.1432 82.8579H20.6949L20.2123 84.6403ZM20.732 84.3083H23.5221L22.851 86.7747C22.7225 87.2828 22.2856 87.5382 21.5431 87.5382H17.4165C17.2937 87.5382 17.1937 87.5212 17.1081 87.4758C17.0253 87.4304 16.951 87.3736 16.9053 87.2998C16.8568 87.2345 16.8196 87.1522 16.8111 87.0671C16.7911 86.9848 16.7911 86.9138 16.8111 86.8372L17.2566 85.2137H20.0552L19.821 86.0623H20.2608L20.732 84.3083V84.3083Z"
                                        fill="#373738" />
                                <path
                                        d="M26.8976 84.6403H24.0904L24.7615 82.154C24.8986 81.6374 25.3355 81.3792 26.0895 81.3792H30.0675C30.2075 81.3792 30.3274 81.3877 30.4388 81.3962C30.5501 81.4075 30.6444 81.4331 30.7101 81.4785C30.7729 81.5267 30.8186 81.6005 30.8386 81.6942C30.8586 81.7935 30.85 81.9241 30.8015 82.0802L30.3645 83.698H27.5944L27.8286 82.8579H27.3803L26.8976 84.6403ZM27.4174 84.3083H30.2075L29.5364 86.7747C29.4078 87.2828 28.9709 87.5382 28.2284 87.5382H24.1019C23.9791 87.5382 23.8791 87.5212 23.7934 87.4758C23.7106 87.4304 23.6364 87.3736 23.5907 87.2998C23.5421 87.2345 23.505 87.1522 23.4964 87.0671C23.4764 86.9848 23.4764 86.9138 23.4964 86.8372L23.9419 85.2137H26.7406L26.5064 86.0623H26.9462L27.4174 84.3083V84.3083Z"
                                        fill="#373738" />
                                <path
                                        d="M31.661 81.3679H34.4568L34.0855 82.736H31.2897L31.661 81.3679V81.3679ZM31.1869 83.1418H33.9827L32.7947 87.5383H29.9961L31.1869 83.1418Z"
                                        fill="#373738" />
                                <path
                                        d="M40.3082 84.0102H37.4639L37.7723 82.8749H37.3525L36.5443 85.8949H36.9527L37.1869 85.0377H40.0398L39.3601 87.5382H34.5653C34.5282 87.5382 34.4625 87.5297 34.3797 87.5042C34.2883 87.4843 34.1941 87.4474 34.0998 87.385C34.0084 87.3282 33.9228 87.2544 33.8514 87.1522C33.7743 87.05 33.7371 86.9308 33.7286 86.7832C33.72 86.6981 33.72 86.6158 33.7486 86.5136C33.7657 86.4114 33.7942 86.3036 33.8314 86.173L34.8709 82.3016C34.9365 82.0348 35.0765 81.8134 35.2907 81.6374C35.5048 81.4615 35.819 81.3792 36.2388 81.3792H39.9827C40.2254 81.3792 40.411 81.3962 40.5338 81.4416C40.6538 81.4898 40.7366 81.5438 40.7823 81.6091C40.8308 81.6743 40.8479 81.7566 40.8479 81.839C40.8394 81.9241 40.8394 82.0149 40.8308 82.1001L40.3082 84.0102V84.0102Z"
                                        fill="#373738" />
                                <path
                                        d="M44.7603 81.3679H52.8849C53.2191 81.3679 53.4618 81.4162 53.6189 81.5183C53.7674 81.6177 53.8045 81.8022 53.7302 82.0888L52.2624 87.5383H49.5294L50.7945 82.858H50.2719L49.0097 87.5383H46.3224L47.5875 82.858H47.0563L45.7941 87.5383H43.0983L44.7603 81.3679V81.3679Z"
                                        fill="#373738" />
                                <path
                                        d="M55.9891 86.1248H56.4918L57.3742 82.8551H56.8716L55.9891 86.1248ZM59.1476 86.857C59.0277 87.3083 58.7307 87.5382 58.2766 87.5382H53.7017C53.4618 87.5382 53.2847 87.4758 53.1819 87.3537C53.0791 87.2345 53.062 87.0415 53.1248 86.7832L54.3699 82.154C54.5099 81.6374 54.9468 81.3792 55.6921 81.3792H59.6045C59.8558 81.3792 60.0415 81.4246 60.1728 81.5267C60.2928 81.6289 60.3927 81.7765 60.4612 81.9865L59.1476 86.857Z"
                                        fill="#373738" />
                                <path
                                        d="M67.5635 81.4417L67.0894 83.2071H65.2132L64.0395 87.5412H61.2437L62.4146 83.2071H60.7982L61.2694 81.4417H62.9343L63.3256 80.0027H66.1328L65.7415 81.4417H67.5635Z"
                                        fill="#373738" />
                                <path
                                        d="M69.6483 86.1248H70.1509L71.0333 82.8551H70.5307L69.6483 86.1248ZM72.8096 86.857C72.6868 87.3083 72.3898 87.5382 71.9357 87.5382H67.3608C67.1209 87.5382 66.9439 87.4758 66.8411 87.3537C66.7382 87.2345 66.7211 87.0415 66.7839 86.7832L68.029 82.154C68.169 81.6374 68.6059 81.3792 69.3513 81.3792H73.2636C73.5149 81.3792 73.7006 81.4246 73.8319 81.5267C73.9519 81.6289 74.0518 81.7765 74.1204 81.9865L72.8096 86.857V86.857Z"
                                        fill="#373738" />
                                <path
                                        d="M77.3645 82.8296L76.0908 87.5412H73.2836L74.7429 82.1257C74.8828 81.6177 75.3197 81.3679 76.0537 81.3679H80.3573C80.4601 81.3679 80.5429 81.3878 80.6086 81.4247C80.6743 81.4616 80.72 81.507 80.7571 81.5638C80.7857 81.629 80.8142 81.6915 80.8228 81.7568C80.8342 81.8306 80.8342 81.9044 80.8342 81.9696L80.2659 84.0558H77.4958L77.8299 82.8296H77.3645V82.8296Z"
                                        fill="#373738" />
                                <path
                                        d="M83.5757 84.6403H80.7714L81.4396 82.154C81.5767 81.6374 82.0136 81.3792 82.7676 81.3792H86.7456C86.8855 81.3792 87.0055 81.3877 87.1169 81.3962C87.2282 81.4075 87.3225 81.4331 87.3882 81.4785C87.451 81.5267 87.4967 81.6005 87.5167 81.6942C87.5367 81.7935 87.5281 81.9241 87.4795 82.0802L87.0426 83.698H84.2725L84.5067 82.8579H84.0584L83.5757 84.6403ZM84.0955 84.3083H86.8855L86.2173 86.7747C86.0859 87.2828 85.649 87.5382 84.9065 87.5382H80.78C80.6572 87.5382 80.5572 87.5212 80.4715 87.4758C80.3887 87.4304 80.3145 87.3736 80.2688 87.2998C80.2202 87.2345 80.1831 87.1522 80.1745 87.0671C80.1545 86.9848 80.1545 86.9138 80.1745 86.8372L80.62 85.2137H83.4187L83.1845 86.0623H83.6243L84.0955 84.3083V84.3083Z"
                                        fill="#373738" />
                                <path
                                        d="M96.181 85.472H93.3624L94.0678 82.8551H93.5766L92.8255 85.6281C92.8141 85.6735 92.8341 85.7189 92.8884 85.7558C92.9455 85.7956 93.0197 85.8211 93.1025 85.841H96.0982L95.6413 87.5411H90.8065C90.6866 87.5411 90.5838 87.5127 90.481 87.4474C90.3782 87.3935 90.2953 87.3169 90.2211 87.2261C90.1468 87.1437 90.0926 87.0501 90.044 86.9479C89.9983 86.8457 89.9812 86.7549 89.9812 86.6726L91.1321 82.4038C91.2263 82.1994 91.3177 82.0348 91.4205 81.9043C91.5233 81.7765 91.6261 81.6744 91.7461 81.5921C91.8574 81.5183 91.9802 81.4615 92.1173 81.4331C92.2487 81.4047 92.3972 81.3877 92.5542 81.3877H96.1896C96.478 81.3877 96.6922 81.4331 96.8493 81.5183C97.0064 81.6006 97.0835 81.7936 97.092 82.0802L96.181 85.472V85.472Z"
                                        fill="#373738" />
                                <path
                                        d="M102.364 87.5411H99.5365L100.802 82.8551H100.373L99.111 87.5411H96.3038L97.9659 81.3792H102.986C103.226 81.3792 103.423 81.416 103.563 81.4898C103.7 81.5721 103.803 81.7283 103.869 81.9695L102.364 87.5411Z"
                                        fill="#373738" />
                                <path
                                        d="M105.908 87.0218H104.151C103.666 86.9849 103.389 86.7834 103.323 86.4229L104.503 82.0633C104.523 81.9782 104.568 81.8958 104.643 81.8135C104.708 81.7284 104.794 81.6546 104.894 81.5893C104.988 81.5269 105.088 81.4786 105.202 81.4332C105.314 81.3878 105.414 81.3679 105.516 81.3679H109.469C109.68 81.4332 109.84 81.507 109.951 81.5893C110.063 81.683 110.137 81.7852 110.183 81.9044C110.228 82.0264 110.248 82.1541 110.248 82.2932C110.24 82.4323 110.228 82.5884 110.22 82.7558L108.538 89.0001H103.417L103.777 87.6519H106.242L107.47 83.0964H106.967L105.908 87.0218V87.0218Z"
                                        fill="#373738" />
                                <path
                                        d="M111.254 81.3679H114.052L113.681 82.736H110.882L111.254 81.3679ZM110.78 83.1418H113.578L112.387 87.5383H109.592L110.78 83.1418Z"
                                        fill="#373738" />
                                <path
                                        d="M119.116 87.5411H116.288L117.553 82.8551H117.125L115.86 87.5411H113.056L114.718 81.3792H119.738C119.978 81.3792 120.172 81.416 120.312 81.4898C120.452 81.5721 120.555 81.7283 120.621 81.9695L119.116 87.5411Z"
                                        fill="#373738" />
                                <path
                                        d="M126.209 85.472H123.393L124.099 82.8551H123.605L122.854 85.6281C122.842 85.6735 122.862 85.7189 122.919 85.7558C122.974 85.7956 123.048 85.8211 123.131 85.841H126.126L125.669 87.5411H120.835C120.715 87.5411 120.612 87.5127 120.512 87.4474C120.409 87.3935 120.324 87.3169 120.252 87.2261C120.175 87.1437 120.121 87.0501 120.075 86.9479C120.027 86.8457 120.009 86.7549 120.009 86.6726L121.163 82.4038C121.255 82.1994 121.349 82.0348 121.452 81.9043C121.552 81.7765 121.654 81.6744 121.774 81.5921C121.886 81.5183 122.008 81.4615 122.146 81.4331C122.277 81.4047 122.425 81.3877 122.585 81.3877H126.218C126.506 81.3877 126.72 81.4331 126.877 81.5183C127.037 81.6006 127.112 81.7936 127.12 82.0802L126.209 85.472V85.472Z"
                                        fill="#373738" />
                                <path
                                        d="M132.763 85.472H129.947L130.653 82.8551H130.162L129.408 85.6281C129.399 85.6735 129.419 85.7189 129.473 85.7558C129.53 85.7956 129.605 85.8211 129.688 85.841H132.68L132.223 87.5411H127.392C127.272 87.5411 127.169 87.5127 127.066 87.4474C126.963 87.3935 126.88 87.3169 126.806 87.2261C126.732 87.1437 126.678 87.0501 126.629 86.9479C126.583 86.8457 126.563 86.7549 126.563 86.6726L127.717 82.4038C127.811 82.1994 127.903 82.0348 128.006 81.9043C128.108 81.7765 128.208 81.6744 128.331 81.5921C128.442 81.5183 128.562 81.4615 128.702 81.4331C128.831 81.4047 128.982 81.3877 129.139 81.3877H132.775C133.063 81.3877 133.274 81.4331 133.434 81.5183C133.591 81.6006 133.666 81.7936 133.674 82.0802L132.763 85.472V85.472Z"
                                        fill="#373738" />
                                <path
                                        d="M136.967 82.8296L135.693 87.5412H132.889L134.348 82.1257C134.485 81.6177 134.922 81.3679 135.659 81.3679H139.96C140.063 81.3679 140.145 81.3878 140.211 81.4247C140.277 81.4616 140.322 81.507 140.362 81.5638C140.388 81.629 140.417 81.6915 140.425 81.7568C140.434 81.8306 140.434 81.9044 140.434 81.9696L139.868 84.0558H137.098L137.432 82.8296H136.967V82.8296Z"
                                        fill="#373738" />
                                <path
                                        d="M141.256 81.3679H144.052L143.681 82.736H140.885L141.256 81.3679ZM140.782 83.1418H143.578L142.39 87.5383H139.591L140.782 83.1418Z"
                                        fill="#373738" />
                                <path
                                        d="M149.115 87.5411H146.291L147.553 82.8551H147.125L145.863 87.5411H143.055L144.717 81.3792H149.738C149.981 81.3792 150.175 81.416 150.315 81.4898C150.455 81.5721 150.557 81.7283 150.62 81.9695L149.115 87.5411Z"
                                        fill="#373738" />
                                <path
                                        d="M152.659 87.0218H150.903C150.42 86.9849 150.141 86.7834 150.075 86.4229L151.254 82.0633C151.274 81.9782 151.323 81.8958 151.394 81.8135C151.46 81.7284 151.546 81.6546 151.645 81.5893C151.74 81.5269 151.843 81.4786 151.954 81.4332C152.065 81.3878 152.168 81.3679 152.271 81.3679H156.22C156.435 81.4332 156.592 81.507 156.703 81.5893C156.814 81.683 156.889 81.7852 156.934 81.9044C156.98 82.0264 157 82.1541 157 82.2932C156.991 82.4323 156.98 82.5884 156.971 82.7558L155.289 89.0001H150.169L150.532 87.6519H152.993L154.221 83.0964H153.719L152.659 87.0218V87.0218Z"
                                        fill="#373738" />
                                <defs>
                                    <linearGradient id="paint0_linear" x1="130.407" y1="73.6194" x2="32.843"
                                                    y2="-24.5169" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="#E52D2D" />
                                        <stop offset="0.25098" stop-color="#E11F28" />
                                        <stop offset="0.490196" stop-color="#333867" />
                                        <stop offset="0.811765" stop-color="#46A8DE" />
                                        <stop offset="1" stop-color="#46A8DE" />
                                    </linearGradient>
                                </defs>
                            </svg>
                        </div>
                    </a>
                </div>

                <nav class="header__menu menu">
    
                    <?php
                    // Получим элементы меню на основе параметра $menu_name (тоже что и 'theme_location' или 'menu' в аргументах wp_nav_menu)
                    // Этот код - основа функции wp_nav_menu, где получается ID меню из слага.
    
                    $menu_name = 'top';
                    $locations = get_nav_menu_locations();
    
                    if( $locations && isset( $locations[ $menu_name ] ) ){
        
                        // получаем элементы меню
                        $menu_items = wp_get_nav_menu_items( $locations[ $menu_name ] );
                        //print_r($menu_items);
        
                        // создаем список
                        $menu_list = '<ul class="header__list">';
        
                        foreach ( (array) $menu_items as $key => $menu_item ){
                            $menu_list .= '<li class="header__item"><a href="' . $menu_item->url . '" class="header__link">' . $menu_item->title . '</a></li>';
                        }
        
                        $menu_list .= '</ul>';
        
                    }
                    else {
                        $menu_list = '<ul><li>Меню "' . $menu_name . '" не определено.</li></ul>';
                    }
                    echo $menu_list;
                    ?>
    
                    <?php get_sidebar('homeright'); ?>
                    <form action="<?php echo site_url(); ?>" class="header__search search">
                        <a href="" class="search__close">
                            <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M7.30055 9.42178L0 16.7223L2.12132 18.8437L9.42188 11.5431L16.7224 18.8437L18.8438 16.7223L11.5432 9.42178L18.8437 2.12132L16.7223 0L9.42188 7.30046L2.12142 0L9.80068e-05 2.12132L7.30055 9.42178Z" fill="#8A8A8A"/>
                            </svg>
                        </a>
                        <input id="search-field" type="search" name="s" pattern=".*\S.*" required placeholder="Поиск по сайту">
                        <button class="search__btn" type="submit">
                            <span>Search</span>
                        </button>
                    </form>
                </nav>
                <div class="header__burger">
                    <span></span>
                </div>
            </div>
        </div>
    </header>

    <main class="site__main">
        <section class="map map--contacts">
            <div class="breadcrumbs">
                <div class="breadcrumbs__container container">
                    <div class="breadcrumbs__items">
                        <div class="breadcrumbs__item"><a href="/" class="breadcrumbs__link">Главная</a></div>
                        <span>&nbsp;\&nbsp;</span>
                        <?php the_breadcrumb(); ?>
                    </div>
                    <h1 class="breadcrumbs__title"><?php the_title(); ?></h1>
                </div>
            </div>

            <img src="<?php echo get_template_directory_uri(); ?>/img/loader/ajax-loader.gif" height="66" width="66" id="loading-indicator" class="hide-loader" />

            <script>
                $( document ).ready(function() {
                    $("#car_model").hide();
                    
                    <?php if( !empty($car_mark_name) ){ ?>
                        $("#car_model").show();
                        $("#car_mark .filter-select__value span").text("<?php echo $car_mark_name; ?>");
                    <?php } ?>
                    
                    <?php if( !empty($car_model_name) ){ ?>
                        $("#car_model .filter-select__value span").text("<?php echo $car_model_name; ?>");
                    <?php } ?>
    
                    <?php if( !empty($services_terms) ){ foreach($services_terms as $service_term_id){ ?>
                        $("#<?php echo $service_term_id; ?>").addClass("_active");
                    <?php }} ?>
                });
            </script>
            
            <div class="service-page__filter filter">
                <div class="filter__container container">
                    <div class="filter__car">
                        <div id="car_mark" class="filter__mark">
                            <div class="filter__label filter__label--car">Марка автомобиля:</div>
                            <?php
                                $cars = get_terms([
                                    'taxonomy' => 'cars',
                                    'parent' => '0'
                                ]);
                                
                                $cars_arr_letters = [];
                                foreach ($cars as $car){
                                    $first_letter = mb_strtoupper(mb_substr($car->name, 0, 1));
                                    $cars_arr_letters[] = $first_letter;
                                }
                                $cars_arr_letters = array_unique($cars_arr_letters);
                                sort($cars_arr_letters);
                            ?>
                            <div class="filter__select filter-select">
                                <div class="filter-select__title">
                                    <div class="filter-select__value">
                                        <span>Выберите марку автомобиля</span>
                                    </div>
                                </div>
                                <div class="filter-select__options">
                                    <div class="filter-select__container container">
                                        <div class="filter-select__row">
                                            <?php foreach ($cars_arr_letters as $letter){ ?>
                                                <div class="filter-select__item">
                                                    <div class="filter-select__character"><?php echo $letter; ?></div>
                                                    <div class="filter-select__links">
                                                        <?php foreach ($cars as $car){ ?>
                                                            <?php if ( $letter == mb_strtoupper(mb_substr($car->name, 0, 1)) ){ ?>
                                                                <a href="?car_mark_slug=<?php echo $car->slug; ?>&car_mark_name=<?php echo $car->name; ?>&car_mark_term_id=<?php echo $car->term_id; ?>" class="car_mark filter-select__model" data-slug="<?php echo $car->slug; ?>" data-term_id="<?php echo $car->term_id; ?>" data-term_taxonomy_id="<?php echo $car->term_taxonomy_id; ?>" data-taxonomy="<?php echo $car->taxonomy; ?>"><?php echo $car->name; ?></a>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="car_model" class="filter__mark">
                            <div class="filter__label filter__label--p0">Модель автомобиля:</div>
                            <div class="filter__select filter-select filter-select--model">
                                <div class="filter-select__title">
                                    <div class="filter-select__value">
                                        <span>Выберите модель:</span>
                                    </div>
                                </div>
                                <div class="filter-select__options">
                                    <div class="filter-select__container container">
                                        <div class="filter-select__row">
                                            <!-- Здесь выводим дочерние модели -->
                                              <?php if( isset($car_mark_term_id) and !empty($car_mark_term_id) ) {
                                                  $cars = get_terms([
                                                      'taxonomy' => 'cars',
                                                      'parent' => $car_mark_term_id
                                                  ]);
                                                  if ($cars) {
                                                      foreach ($cars as $car) { ?>
                                                          <div class="filter-select__item"><a href="?car_mark_slug=<?php echo $car_mark_slug; ?>&car_mark_name=<?php echo $car_mark_name; ?>&car_mark_term_id=<?php echo $car_mark_term_id; ?>&car_model_slug=<?php echo $car->slug; ?>&car_model_name=<?php echo $car->name; ?>&car_model_term_id=<?php echo $car->term_id; ?>" data-slug="<?php echo $car->slug; ?>" data-term_id="<?php echo $car->term_id; ?>" data-term_taxonomy_id="<?php echo $car->term_taxonomy_id; ?>" data-taxonomy="<?php echo $car->taxonomy; ?>" data-car_parent="<?php echo $car_mark_term_id; ?>" class="car_model filter-select__model"><?php echo $car->name; ?></a></div>
                                                      <?php }
                                                  }
                                              }
                                              ?>
                                            <!-- Здесь выводим дочерние модели КОНЕЦ -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="filter__service">
                        <div class="filter__label filter__label--service">Выберите услугу:</div>
                        <div class="filter__items">
                            <!-- Здесь выводим родительские услуги -->
                                <?php
                                
                                        $posts = get_posts( [
                                            'tax_query' => [
                                                [
                                                    'taxonomy' => 'cars',
                                                    'operator' => 'NOT EXISTS',
                                                ]
                                            ],
                                            'post_type' => 'service_price',
                                            'posts_per_page' => -1
                                        ] );
    
                                        $object_ids = array();
                                        foreach ($posts as $post){
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
                                                foreach ($services as $service){
                                                    parse_str($page_query_string, $page_query_arr);
                                                    if(!isset($page_query_arr['services_terms']) or !in_array($service->term_id, $page_query_arr['services_terms'])) {
                                                        $final_service_url = add_service_url($service, $page_query_arr);
                                                        echo '<a id="'.$service->term_id.'" href="?'.$final_service_url.'" class="filter__item2" data-show="2" data-slug="'.$service->slug.'" data-term_id="'.$service->term_id.'" data-term_taxonomy_id="'.$service->term_taxonomy_id.'" data-taxonomy="'.$service->taxonomy.'" data-car_model="'.$car_model_term_id.'" data-car_parent="'.$car_mark_term_id.'" data-name="'.$service->name.'"><div class="filter__item-wrapper">'.$service->name.'</div></a>';
                                                    }elseif (in_array($service->term_id, $page_query_arr['services_terms'])){
                                                        $final_service_url = filter_service_url($service, $page_query_arr);
                                                        echo '<a id="'.$service->term_id.'" href="?'.$final_service_url.'" class="filter__item2" data-show="2" data-slug="'.$service->slug.'" data-term_id="'.$service->term_id.'" data-term_taxonomy_id="'.$service->term_taxonomy_id.'" data-taxonomy="'.$service->taxonomy.'" data-car_model="'.$car_model_term_id.'" data-car_parent="'.$car_mark_term_id.'" data-name="'.$service->name.'"><div class="filter__item-wrapper">'.$service->name.'</div></a>';
                                                    }
                                                    else{
                                                        echo '<a id="'.$service->term_id.'" href="'.$page_url.'#" onclick="history.back();" class="filter__item2" data-show="2" data-slug="'.$service->slug.'" data-term_id="'.$service->term_id.'" data-term_taxonomy_id="'.$service->term_taxonomy_id.'" data-taxonomy="'.$service->taxonomy.'" data-car_model="'.$car_model_term_id.'" data-car_parent="'.$car_mark_term_id.'" data-name="'.$service->name.'"><div class="filter__item-wrapper">Ошибка!</div></a>';
                                                    }
                                                    
                                                }
                                            }
                                            
                                            
                                        }

                                if(!empty($car_model_term_id)) {
    
                                    $query = new WP_Query(array(
                                        'tax_query' => array(
                                            array(
                                                'taxonomy' => 'cars',
                                                'field' => 'term_id',
                                                'terms' => $car_model_term_id
                                            )
                                        )
                                    ));
    
                                    $object_ids = array();
                                    foreach ($query->posts as $post) {
                                        $object_ids[] = $post->ID;
                                    }
    
                                    $object_terms = wp_get_object_terms($object_ids, 'services');
    
                                    if ($object_terms) {
                                        $parents = [];
                                        foreach ($object_terms as $object_term) {
                                            $parents[] = $object_term->parent;
                                        }
                                        array_unique($parents);
        
                                        $services = get_terms([
                                            'taxonomy' => 'services',
                                            'parent' => '0',
                                            'term_taxonomy_id' => $parents,
                                        ]);
    
                                        if($services){
                                            foreach ($services as $service){
                                                parse_str($page_query_string, $page_query_arr);
                                                if(!isset($page_query_arr['services_terms']) or !in_array($service->term_id, $page_query_arr['services_terms'])) {
                                                    $final_service_url = add_service_url($service, $page_query_arr);
                                                    echo '<a id="'.$service->term_id.'" href="?'.$final_service_url.'" class="filter__item2" data-show="2" data-slug="'.$service->slug.'" data-term_id="'.$service->term_id.'" data-term_taxonomy_id="'.$service->term_taxonomy_id.'" data-taxonomy="'.$service->taxonomy.'" data-car_model="'.$car_model_term_id.'" data-car_parent="'.$car_mark_term_id.'" data-name="'.$service->name.'"><div class="filter__item-wrapper">'.$service->name.'</div></a>';
                                                }elseif (in_array($service->term_id, $page_query_arr['services_terms'])){
                                                    $final_service_url = filter_service_url($service, $page_query_arr);
                                                    echo '<a id="'.$service->term_id.'" href="?'.$final_service_url.'" class="filter__item2" data-show="2" data-slug="'.$service->slug.'" data-term_id="'.$service->term_id.'" data-term_taxonomy_id="'.$service->term_taxonomy_id.'" data-taxonomy="'.$service->taxonomy.'" data-car_model="'.$car_model_term_id.'" data-car_parent="'.$car_mark_term_id.'" data-name="'.$service->name.'"><div class="filter__item-wrapper">'.$service->name.'</div></a>';
                                                }
                                                else{
                                                    echo '<a id="'.$service->term_id.'" href="'.$page_url.'#" onclick="history.back();" class="filter__item2" data-show="2" data-slug="'.$service->slug.'" data-term_id="'.$service->term_id.'" data-term_taxonomy_id="'.$service->term_taxonomy_id.'" data-taxonomy="'.$service->taxonomy.'" data-car_model="'.$car_model_term_id.'" data-car_parent="'.$car_mark_term_id.'" data-name="'.$service->name.'"><div class="filter__item-wrapper">Ошибка!</div></a>';
                                                }
            
                                            }
                                        }
                                    }
                                }
                                        
                                
                                ?>
                            <!-- Здесь выводим родительские услуги КОНЕЦ -->
                        </div>
                        <div class="filter__buttons">
                            <a href="" id="filterAll" class="filter__btn filter__all">Все услуги</a>
                            
                            <a href="<?php echo $page_url; ?>" class="filter__btn filter__reset_link">Сбросить фильтры</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="service-page__content">
                <div class="container">
                    <div class="service-page__items">
                    
                    <!-- Здесь выводим цены услуг -->
                        <?php
                        
                            if(!empty($services_terms)){
                                if(!empty($car_model_term_id)){
                                    //Получим услуги по выбранной модели авто
                                    $services_posts = get_posts( [
                                        'tax_query' => [
                                            [
                                                'taxonomy' => 'cars',
                                                'field'    => 'term_id',
                                                'field'    => 'term_id',
                                                'terms'    => $car_model_term_id
                                            ]
                                        ],
                                        'post_type' => 'service_price',
                                        'posts_per_page' => -1
                                    ] );
            
                                    $object_terms = array();
                                    $services_posts_ids = array();
                                    foreach ($services_posts as $service_post){
                                        $terms = wp_get_object_terms($service_post->ID, 'services');
                                        foreach ($terms as $term){
                                            if($term->parent != 0 and in_array($term->parent, $services_terms)){
                                                $term->post_id = $service_post->ID;
                                                $term->price = get_field('price', $service_post->ID);
                                                $term->notation = get_field('notation', $service_post->ID);
                                                $show_terms[$term->parent][] = $term;
                                            }
                                        }
                                    }
                                }
        
                                //Получим услуги по пустой модели авто
                                $services_posts = get_posts( [
                                    'tax_query' => [
                                        [
                                            'taxonomy' => 'cars',
                                            'operator' => 'NOT EXISTS',
                                        ]
                                    ],
                                    'post_type' => 'service_price',
                                    'posts_per_page' => -1
                                ] );
        
                                $object_terms = array();
                                $services_posts_ids = array();
                                foreach ($services_posts as $service_post){
                                    $services_posts_ids[] = $service_post->ID;
                                    $terms = wp_get_object_terms($service_post->ID, 'services');
                                    foreach ($terms as $term){
                                        if($term->parent != 0 and in_array($term->parent, $services_terms)){
                                            $term->post_id = $service_post->ID;
                                            $term->price = get_field('price', $service_post->ID);
                                            $term->notation = get_field('notation', $service_post->ID);
                                            $show_terms[$term->parent][] = $term;
                                        }
                                    }
                                }
                            }
                            
                        ?>

                        <?php if(isset($show_terms)){ foreach ($show_terms as $parent_term_id => $terms){
                            $parent_term = get_term($parent_term_id, 'services');
                            ?>
                            <div id="<?php echo $parent_term_id; ?>" class="service-page__item" style="display: block;">
                                <h2><?php echo $parent_term->name; ?></h2>
                                <figure class="block-table">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>Наименование услуги</th>
                                                <th>Цена</th>
                                                <th>Примечание</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($terms as $term){ ?>
                                                <tr>
                                                    <td><?php echo $term->name; ?></td>
                                                    <td><?php echo $term->price; ?> руб.</td>
                                                    <td><?php echo $term->notation; ?></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </figure>
                            </div>
                        <?php }} ?>
                    <!-- Здесь выводим цены услуг КОНЕЦ -->
                    
                    </div>
                    
                </div>
                
            </div>

            <div class="service-page__request service-request">
                <div class="service-request__container container">
                    <div class="service-request__row row">
                        <div class="service-request__content">
                            <div class="service-request__content-wrapper">
                                <h2 class="service-request__title title-h2">Записаться на осмотр</h2>
                                <div class="service-request__text">Заполните эту форму и в самое ближайшее время с вами свяжется наш
                                    сотрудник, который уточнит все детали и согласует с вами время осмотра</div>
                                <div class="service-request__contact" data-da="service-request__row, last, 991">
                                    <div class="service-request__label">Или свяжитесь с нами по телефону:</div>
                                    <a href="tel:+79646226464" class="service-request__link"><span>+7 (964)</span> 622-64-64</a>
                                    <div class="service-request__descr">(круглосуточно)</div>
                                </div>
                            </div>
                        </div>

                        <div class="service-request__form form">
                            <form action="#" id="form" class="form__body">
                                <div class="form__item">
                                    <label for="serviceName" class="form__label">Ваше имя*:</label>
                                    <input id="serviceName" type="text" name="name" class="form__input">
                                </div>
                                <div class="form__item">
                                    <label for="serviceEmail" class="form__label">Контактный телефон*:</label>
                                    <input id="serviceEmail" type="text" name="phone" class="form__input form__input--phone"
                                           placeholder="+7 (___) ___-__-__">
                                </div>
                                <div class="form__item">
                                    <label for="serviceEmail" class="form__label">Модель авто и год выпуска*:</label>
                                    <input id="serviceEmail" type="text" name="phone" class="form__input"
                                           placeholder="Volvo XC 90 ( 2007), T2.5, AWD">
                                </div>

                                <div class="form__item">
                                    <div class="form__label">Тип работ:</div>
                                    <select name="workType" class="form__select">
                                        <option value="Комплексная диагностика" selected>Комплексная диагностика</option>
                                        <option value="Кузовные работы">Кузовные работы</option>
                                        <option value="Замена узлов и агрегатов">Замена узлов и агрегатов</option>
                                    </select>
                                </div>
                                <div class="form__item form__item--full form__item--center">
                                    <button type="submit" class="form__button btn">
                                        <i class="icon-send"></i>
                                        <span>Отправить</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container">
                <?php
                if(!empty($car_mark_term_id) and empty($car_model_term_id)){
                   $auto_repair_text = get_field('auto_repair_text', 'cars_'.$car_mark_term_id);
                   $auto_repair_text = empty($auto_repair_text) ? get_field('field_60193e4c516b8') : $auto_repair_text;
                   $auto_repair_text = str_replace('{{mark}}', $car_mark_name, $auto_repair_text);
                   $auto_repair_text = !empty($car_model_name) ? str_replace('{{model}}', ' '.$car_model_name, $auto_repair_text) : str_replace('{{model}}', '', $auto_repair_text);
                   echo $auto_repair_text;
                }else if(!empty($car_model_term_id)){
                    $auto_repair_text = get_field('auto_repair_text', 'cars_'.$car_model_term_id);
                    $auto_repair_text = empty($auto_repair_text) ? get_field('field_60193e4c516b8') : $auto_repair_text;
                    $auto_repair_text = str_replace('{{mark}}', $car_mark_name, $auto_repair_text);
                    $auto_repair_text = !empty($car_model_name) ? str_replace('{{model}}', ' '.$car_model_name, $auto_repair_text) : str_replace('{{model}}', '', $auto_repair_text);
                    echo $auto_repair_text;
                }else if(count($services_terms)==1){
                    foreach ($services_posts_ids as $post_id){
                        $content = get_the_content( NULL, false, $post_id);
                        if($content and strlen($content)>5){
                            //$content = str_replace('{{mark}}', $car_mark_name, $content);
                            //$content = !empty($car_model_name) ? str_replace('{{model}}', ' '.$car_model_name, $content) : str_replace('{{model}}', '', $content);
                            echo $content;
                            break;
                        }
                    }
                }
                else{
                    echo get_the_content( NULL, false, $page_id );
                }
                ?>
            </div>
            
        </section>
        
    </main>

    <div class="modals">
        <div id="appointment" class="popup appointment">
            <div class="popup__body">
                <div class="popup__content appointment__content">
                    <a href="" class="popup__close close-popup">
                        <svg width="16" height="16" viewBox="0 0 8 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7 1L1 7" stroke="#B3B3B3" />
                            <path d="M7 7L1 1" stroke="#B3B3B3" />
                        </svg>
                    </a>
                    <div class="appointment__form form">
                        <?php get_sidebar('homemap'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php get_footer(); ?>