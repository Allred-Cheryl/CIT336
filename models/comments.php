<?php
/// GetCommentsByUser
/// Returns all of the comments written by the given user.
/// $userId - the User Id of the user who wrote the comments.
class Comment {

    var $id;
    var $userId;
    var $comment;
    var $updated;

}
function GetOrderedComments()
{

	$query = "SELECT * FROM comments ORDER BY id DESC";
	return DbSelect($query);

    }

function GetAllComments() {
        $comments = array();
	$query = "SELECT * FROM comments";
	return DbSelect($query);
        
        foreach ($result as $item) {
        $comment = new Comment();
        $comment->id = $item['Id'];
        $comment->userId = $item['email'];
        $comment->comment = $item['firstname'];
        $comment->updated = $item['lastname'];

        $comments[] = $comment;
        }
}

function SaveComment($userId, $comment)
{
	$query = "INSERT INTO comments(userId, comment) VALUES(:userId, :comment)";
	return DbInsert($query, array(':userId' => $userId, ':comment' => $comment));
        

}

/// Deletes the comments
function DeleteComment($id) {

        $query = "DELETE FROM comments WHERE ID=:id";
        $dbExecute = DbExecute($query, [':id' => $id]);
        
    
}
