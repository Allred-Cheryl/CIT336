<?php

function GetPrimaryNavigationItems()
{
    $nav = array(
        'home' => 'Home',
        'video' => 'Video',
        'audio' => 'Audio',
        'links' => 'Links',
        'upload' => 'Upload',
        'comment' => 'Comments'
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
function GetFootNavItems() {

    $fnav = array(
        'siteplan' => 'Site Plan',
        'about' => 'About',
        'contact' => 'Contact Us',
        'teachingpresentation' => 'Teaching Presentation'
        );


    return $fnav;
}
