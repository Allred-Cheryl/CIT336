<?php ?>
<script src="/js/deletecomments.js"></script>
<main>
    <h1>Comment</h1>
    <p>Leave a comment about the music or any suggestions you have.</p>
<?php foreach ($comments as $comment) : ?>
        <div id="commentdiv">
            <fieldset>
                <legend><?php echo $comment['updated']; ?></legend>
                <?php echo $comment['comment']; ?>	
            </fieldset>
        </div>
    <?php endforeach; ?>

    <?php if (CheckSession()) : ?>
    <div id="formcomment">
        <form id="commentform" method="POST" action="/?action=postcomment">
            <fieldset>
                <legend>Post a new comment:</legend>
            <textarea cols="40" rows="5" name="comment" id="commentarea"></textarea><br />
            <input type="submit" name="Submit" value="Submit" />
            </fieldset>
        </form>
    </div>
    <?php else : ?>
        <p>
            Please log in to post a comment.
        </p>
    <?php endif; ?>
</main>