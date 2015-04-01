<script src="/js/deletecomments.js" ></script>
<main>	
    <div id="userlistdiv">
        <table id="userstable">
            <tr>
                <th>Updated</th>
                <th>Comment</th>
            </tr>

            <?php foreach ($comments as $comment) :
			
		
			?>

                <tr>
                    <td><?php echo $comment['updated']; ?></td>
                    <td><?php echo $comment['comment']; ?></td>
                    <td><button onclick="DeleteComment(<?php echo $comment->id; ?>)">Delete</button></td>
                </tr>

            <?php endforeach; ?>
        </table>
    </div>
</main>