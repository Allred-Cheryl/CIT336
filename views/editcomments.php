<script src="/js/deletecomments.js" ></script>
<main>	
    <div id="userlistdiv">
        <table id="userstable">
            <tr>
                <th>Updated</th>
                <th>Comment</th>
                <th>Delete</th>
            </tr>

            <?php foreach ($comments as $comment) :
			
		
			?>

                <tr>
                    <td><?php echo $comment['updated']; ?></td>
                    <td><?php echo $comment['comment']; ?></td>
                    <td><?php echo $comment['Id']; ?></td>
                    <td><button onclick="DeleteComment(<?php echo $comment['Id']; ?>)">Delete</button></td>
                </tr>

            <?php endforeach; ?>
        </table>
    </div>
</main>