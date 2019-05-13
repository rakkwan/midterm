<?php
/**
 * Created by PhpStorm.
 * User: Jittima Goodrich
 * Date: 5/13/2019
 * Time: 1:14 PM
 */

session_start();
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

$f3->route('GET|POST /home', function($f3)
{
    // If form has been submitted, validate
    if(!empty($_POST)) {
        // Get data from form
        $name = $_POST['name'];
        $survey = $_POST['survey'];

        // Add data to hive
        $f3->set('name', $name);
        $f3->set('survey', $survey);

        // if data is valid
        if (validInfo())
        {
            // write data to Session
            if (empty($name))
            {
                $_SESSION['name'] = "Please enter your name";
            }
            else
            {
                $_SESSION['name'] = $name;
            }

            if (empty($survey))
            {
                $_SESSION['survey'] = "No check apply";
            }
            else
            {
                $_SESSION['survey'] = implode(', ', $survey);
            }

            // redirect to summary
            $f3->reroute('/summary');
        }
    }
    // display a personal views
    $view = new Template();
    echo $view->render('views/home.html');
});

$f3->route('GET|POST /summary', function()
{
    // display a order received views
    $view = new Template();
    echo $view->render('views/summary.html');
});


// Run Fat-Free
$f3->run();