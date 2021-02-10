<?php
// Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Start a session
session_start();

//Require the auto autoload file
require_once('vendor/autoload.php');
require_once ('model/data-layer.php');

//Create an instance of the Base class
$f3 = Base::instance();
$f3->set('Debug',3);

//Define a default route (home page)
$f3->route('GET /', function() {

    $view = new Template();
    echo $view->render('views/pet-home.html');
});


$f3->route('GET|POST /order', function($f3) {
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        //Validate the data
        if (empty($_POST['typeOfPet'])) {

        } else {

        }
    }

    //if it doesnt work with conditional
    $f3->set('colors', getColors());

    $view = new Template();
    echo $view->render('views/pet-order.html');

});

$f3->route('GET|POST /order2', function($f3){
    if(isset($_POST['pet'])){
        $_SESSION['pet'] = $_POST['pet'];
    }
    if(isset($_POST['color'])){
        $_SESSION['color'] = $_POST['color'];
    }

    $f3 ->set('sizes', getSizes());
    $f3 ->set('accessories', getAccessories());

    //display a view
    $view = new Template();
    echo $view->render('views/pet-order2.html');
});

//Define a summary route
$f3->route('POST /summary', function() {

    if(isset($_POST['size'])){
        $_SESSION['size'] = $_POST['size'];
    }
    if(isset($_POST['accessories'])){
        $_SESSION['accessories'] = $_POST['accessories'];
    }

    if (isset($_POST['petName'])) {
        $_SESSION['petName'] = $_POST['petName'];
    }


    $view = new Template();
    echo $view->render("views/order-summary.html");
});
//Run fat free
$f3->run();
