<?php ?>
<main>
    <ul>
        <li><a href="/?action=myinfo">Update my info</a></li>
    </ul>


    <?php if (LoggedInUserIsAdmin()) : ?>

        Admin Items:<br />
        <ul>
            <li><a href="/?action=editusers">Edit Users</a></li>
            <li><a href="/?action=editcomments">Edit Comments</a></li>
        </ul>

    <?php endif; ?>
</main>
