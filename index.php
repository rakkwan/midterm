<?php
/**
 * Created by PhpStorm.
 * User: Jittima Goodrich
 * Date: 5/13/2019
 * Time: 1:14 PM
 */

// Turn on error reporting
ini_set('display_error', 1);
error_reporting(E_ALL);

//require autoload file
require_once ('vendor/autoload.php');

// create an instance of the base class
$f3 = Base::instance();

// Turn on Fat-free error reporting
$f3->set('DEBUG', 3);

$f3->set('survey', array('This midterm is easy',
    'I like midterms', 'Today is Monday'));

// define a default route
$f3->route('GET /', function()
{
    echo "<h1>Midterm Survey</h1>";
    echo "<a href=''>Take my Midterm Survey</a>";
});

$f3->route('GET /survey', function()
{
    $view = new Template();
    echo $view->render('views/home.html');
});


// Run Fat-Free
$f3->run();