<?php

/**
 * Language verification
 *
 */
function logged_only() {
    session_start();
    if(!isset($_SESSION['language'])) {
        header('Location: language.php');
        exit();
    }
}
/**
 * Reduce the length of a string
 *
 * @param [string] $origine
 * @param [int] $longueurAGarder
 * @return [string]
 */
function getPtpText ($origine, $longueurAGarder)
    {
        if (strlen ($origine) <= $longueurAGarder)
            return $origine;
         
        $debut = substr ($origine, 0, $longueurAGarder);
        $debut = substr ($debut, 0, strrpos ($debut, ' ')) . '...';
         
        return $debut;
    }