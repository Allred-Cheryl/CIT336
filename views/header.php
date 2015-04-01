<?php
    $nav = GetPrimaryNavigationItems();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="author" content="Cheryl Allred">
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
        <title>Padawan Composer</title>
        
        <link rel="stylesheet" type="text/css" href="/css/newcss.css" />
        <script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.11.1.min.js" ></script>
    </head>    

    <body>
      <header>
        <div id="banner">
        </div>
        
        <nav>
            <ul>
                <?php foreach($nav as $action => $text) : ?>
                <li>
                    <a href='/index.php?action=<?php echo $action ?>' title='<?php echo $text; ?>'><?php echo $text ?></a>
                </li>
                <?php endforeach; ?>
            </ul>
        </nav>
      </header>

    <div id="content">
