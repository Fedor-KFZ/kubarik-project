<?
error_reporting(E_ALL);
ini_set('display_errors', 'On');


require_once $_SERVER["DOCUMENT_ROOT"]."/tools/DB.php";
require_once $_SERVER["DOCUMENT_ROOT"]."/tools/utils.php";
require_once $_SERVER["DOCUMENT_ROOT"]."/include/ar_menu.php";

$currentPath = parse_url( $_SERVER[ 'REQUEST_URI' ], PHP_URL_PATH );
?>

<!DOCTYPE html>
<html>
   <head>
      <!-- Basic -->
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <!-- Mobile Metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <!-- Site Metas -->
      <meta name="keywords" content="" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <link rel="shortcut icon" href="/images/favicon.png" type="">
      <title>DeliTech - Сейфы и офисная техника</title>
      <!-- bootstrap core css -->
      
        <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
        <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
				
      <link rel="stylesheet" type="text/css" href="/css/bootstrap.css" />
      <!-- font awesome style -->
      <link href="/css/font-awesome.min.css" rel="stylesheet" />
      <!-- Custom styles for this template -->
      <link href="/css/style.css" rel="stylesheet" />
      <link href="/css/custom.css" rel="stylesheet" />
      <!-- responsive style -->
      <link href="/css/responsive.css" rel="stylesheet" />
   </head>
   <body>
      <div class="hero_area">
         <!-- header section strats -->
         <header class="header_section bg-white w-100" style="z-index:2">
            <div class="container">
            <nav class="navbar navbar-expand-lg custom_nav-container ">
                  <a class="navbar-brand" href="/"><img height="50" src="/images/logo.png" alt="#" /></a>
                  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class=""> </span>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                     <ul class="navbar-nav">
                        <? foreach($ar_menu as $name=>$link):?>
                        <li class="nav-item <?=$currentPath==$link?'active':''?>">
                           <a class="nav-link" href="<?=$link?>"><?=$name?></a>
                        </li>
                        <? endforeach; ?>
                       <?/*li class="nav-item dropdown">
                           <a class="nav-link dropdown-toggle" href="/#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"> <span class="nav-label">Pages <span class="caret"></span></a>
                           <ul class="dropdown-menu">
                              <li><a href="/about.html">About</a></li>
                              <li><a href="/testimonial.html">Testimonial</a></li>
                           </ul>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" href="/product.html">Products</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" href="/blog_list.html">Blog</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" href="/contact.html">Contact</a>
                        </li*/?>
                        <li class="nav-item">
                            <? module("cart"); ?>
                        </li>
                        <form class="form-inline">
                           <button class="btn  my-2 my-sm-0 nav_search-btn" type="submit">
                           <i class="fa fa-search" aria-hidden="true"></i>
                           </button>
                        </form>
                     </ul>
                  </div>
               </nav>
            </div>
         </header>
         <!-- end header section -->