<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w2.org/TR/xhtml1/DTD/xhtml-transitional.dtd">
<html xmlns="http:www.w3.org/1999/xhtml">
    <head>
        <title>Lindstrom Life</title>
        <link rel="stylesheet" type="text/css" href="/css/main.css"></link>
    </head>
    <body>
        <div class="page">
            <div class="container">

                <div id="main">
                    <h1>Database Error</h1>
                    <p>There was an error connecting to the database.</p>
                    <p>The database must be installed as described in the appendix.</p>
                    <p>Error message: <?php echo $error_message; ?></p>
                    <p>&nbsp;</p>
                </div><!-- end main -->

                <div id="footer">
                    <p class="copyright">
                        &copy; <?php echo date("Y"); ?> Lindstrom Life, All Rights Reserved.
                    </p>
                </div>
            </div>
        </div><!-- end page -->
    </body>
</html>