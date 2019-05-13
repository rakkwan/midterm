<?php
/**
 * Created by PhpStorm.
 * User: Jittima Goodrich
 * Date: 5/13/2019
 * Time: 2:14 PM
 */

function validInfo()
{
    global $f3;
    $isValid = true;

    if (!validName($f3->get('name')))
    {
        $isValid = false;
        $f3->set("errors['name']", "Please enter your name");
    }

    if (!validSurvey($f3->get('survey')))
    {
        $isValid = false;
        $f3->set("errors['survey']", "Invalid selection!");
    }
    return $isValid;
}

function validName($name)
{
    return !empty($name) && ctype_alpha($name);
}

function validSurvey($surveys)
{
    global $f3;

    if (empty($surveys))
    {
        return true;
    }

    foreach ($surveys as $sur)
    {
        if (!in_array($sur, $f3->get('survey')))
        {
            return false;
        }
    }
    return true;
}