<?php
/* 
 * BYUI - CIT 260
 * Mike Neville
 */

/// Returns an array where the key is the Action and the value is the text for the link.
function GetPrimaryNavigationItems()
{
    $nav = array(
        'home' => 'Home',
        'video' => 'Video',
        'audio' => 'Audio',
        'links' => 'Links',
        'upload' => 'Upload',
        'contact' => 'Contact'
    );
    
    if (CheckSession())
    {
        $nav['menu'] = 'Menu';
        $nav['logout'] = 'Log Out';
    }
    else
    {
        $nav['login'] = 'Log In';
    }
    
    return $nav;
}
