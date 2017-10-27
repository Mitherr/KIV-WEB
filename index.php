
<?php

session_start();

include_once("controlers/db_pdo.class.php");
include_once("controlers/settings.inc.php");
include_once("controlers/users.class.php");
include_once("controlers/rights.class.php");
include_once("controlers/articles.class.php");
include_once("controlers/reviews.class.php");
    
function phpWrapperFromFile($filename)
{
    ob_start();
    
    if (file_exists($filename) && !is_dir($filename)) {
        include($filename);
    }
    // nacte to z outputu
    $view = ob_get_clean();
    return $view;
}

require_once 'twig-master/lib/Twig/Autoloader.php';

Twig_Autoloader::register();

$loader = new Twig_Loader_Filesystem('templates');
$twig = new Twig_Environment($loader);

$template_params = array();

$n = @$_REQUEST["n"];

switch ($n) {
    case "":
        $filename = "view/home.inc.php";
        $template = $twig->loadTemplate('home.htm');
        break;
    case "home":
        $filename = "view/home.inc.php";
        $template = $twig->loadTemplate('home.htm');
        break;
    case "articles":
        $filename = "view/articles.inc.php";
        $template = $twig->loadTemplate('page.htm');
        break;
    case "article":
        $filename = "view/administration/article.inc.php";
        $template = $twig->loadTemplate('page.htm');
        break;    
    case "login":
        $filename = "view/login.inc.php";
        $template = $twig->loadTemplate('login.htm');
        break;
    case "singup":
        $filename = "view/signup.inc.php";
        $template = $twig->loadTemplate('signup.htm');
        break;     
    case "logout":
        $filename = "controlers/pages/logout.inc.php";
        $template = $twig->loadTemplate('login.htm');
        break;
     case "admin":
        $filename = "view/administration/admin.inc.php";
        $template = $twig->loadTemplate('/administration/admin.htm');
        break;
     case "usersadm":
        $filename = "view/administration/users.inc.php";
        $template = $twig->loadTemplate('/administration/tables.htm');
        break;
     case "articlesadm":
        $filename = "view/administration/articlesadm.inc.php";
        $template = $twig->loadTemplate('/administration/tables.htm');
        break; 
     case "myarticles":
        $filename = "view/administration/myarticles.inc.php";
        $template = $twig->loadTemplate('/administration/tables.htm');
        break;
     case "myreviews":
        $filename = "view/administration/myreviews.inc.php";
        $template = $twig->loadTemplate('/administration/tables.htm');
        break;  
     case "crtreview":
        $filename = "view/administration/crtreview.inc.php";
        $template = $twig->loadTemplate('/administration/crtreview.htm');
        break;      
     case "reviewsadm":
        $filename = "view/administration/reviewsadm.inc.php";
        $template = $twig->loadTemplate('/administration/tables.htm');
        break;     
     case "setreviews":
        $filename = "view/administration/setreviews.inc.php";
        $template = $twig->loadTemplate('/administration/setreviews.htm');
        break;
     case "postreviews":
        $filename = "view/administration/postreviews.inc.php";
        $template = $twig->loadTemplate('/administration/tables.htm');
        break;    
     case "addarticle":
        $filename = "view/administration/addarticle.inc.php";
        $template = $twig->loadTemplate('/administration/addarticle.htm');
        break;    
     case "chngrights":
        $filename = "controlers/pages/chngrights.inc.php";
        $template = $twig->loadTemplate('/administration/chngrights.htm');
        break;
     case "banuser":
        $filename = "controlers/pages/banuser.inc.php";
        $template = $twig->loadTemplate('clean.htm');
        break;
     case "rmvreview":
        $filename = "controlers/pages/rmvreview.inc.php";
        $template = $twig->loadTemplate('clean.htm');
        break;
     case "lockrev":
        $filename = "controlers/pages/lockrev.inc.php";
        $template = $twig->loadTemplate('clean.htm');
        break;   
     case "rmvuser":
        $filename = "controlers/pages/rmvuser.inc.php";
        $template = $twig->loadTemplate('clean.htm');
        break;
     case "dwnarticle":
        $filename = "controlers/pages/dwnarticle.inc.php";
        $template = $twig->loadTemplate('clean.htm');
        break;
    case "publish":
        $filename = "controlers/pages/publish.inc.php";
        $template = $twig->loadTemplate('clean.htm');
        break;
    case "rmvarticle":
        $filename = "controlers/pages/rmvarticle.inc.php";
        $template = $twig->loadTemplate('clean.htm');
        break;          
        
    default:
        $filename = "view/404.inc.php";
        $template = $twig->loadTemplate('404.htm');
        break;
}
        
$view = phpWrapperFromFile($filename);

$menu_right_name = "";
$menu_right_pages = "";
$menu_right_signout = "";

if (isset($_SESSION['user'])) {
    $menu_right_name .= "<li><p class='navbar-text'><i class='fa fa-user' aria-hidden='true'></i>  Přihlášen jako: ";
    $menu_right_name .= $_SESSION['user']['name'];
    $menu_right_name .= "</p></li>";
    $menu_right_pages = "<li><a href='index.php?n=admin'>Administrace</a></li>";

    
    $menu_right_signout = "<li><a href='index.php?n=logout'>Odhlásit <i class='fa fa-sign-out' aria-hidden='true'></i></a></li>";
}
else{
$menu_right_pages .= "<li><a href='index.php?n=singup'><span class='glyphicon glyphicon-user'></span> Sign Up</a></li>";
$menu_right_pages .= "<li><a href='index.php?n=login'><span class='glyphicon glyphicon-log-in'></span> Login</a></li>";
}

$template_params["menu_right_name"] = $menu_right_name;
$template_params["menu_right_pages"] = $menu_right_pages;
$template_params["menu_right_signout"] = $menu_right_signout;

$template_params["obsah"] = $view;
        
echo $template->render($template_params);

?>