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
                <li><a href="/index.php?action=TeachingPresentation">Teaching Presentation</a></li>
                  <li><a href="/index.php?action=SitePlan" title="Site Plan">Site Plan</a>&nbsp;&nbsp;</li>
                 <li><a href="#" title="Source Code">Source Code</a></li>
        </ul>
        <p id="copy">&copy; <?php echo date('Y', getlastmod()); ?> padawancomposer.com, All rights reserved.</p>
    </div>
</footer>
<?php ob_end_flush(); ?>
</body>
</html>

