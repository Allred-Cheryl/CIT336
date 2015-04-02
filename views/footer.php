<?php
$fnav = GetFootNavItems();
?>
<footer>
    <div class="fnav">
        <ul>
            <?php foreach ($fnav as $action => $text) : ?>
                <li>
                    <a href='/index.php?action=<?php echo $action ?>'><?php echo $text ?></a>
                </li>
            <?php endforeach; ?>
                
                 <li><a href="https://github.com/Allred-Cheryl/CIT336.git" title="Source Code">Source Code</a></li>
        </ul>
        <p id="copy">&copy; <?php echo date('Y', getlastmod()); ?> padawancomposer.com, All rights reserved.</p>
    </div>
</footer>
<?php ob_end_flush(); ?>
</body>
</html>

