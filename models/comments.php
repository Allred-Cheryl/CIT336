<?php

/// GetCommentsByUser
/// Returns all of the comments written by the given user.
/// $userId - the User Id of the user who wrote the comments.
function GetCommentsByUser($userId) {
	$query = "SELECT * FROM comments WHERE userId=:id";
	return DbSelect($query, array(':id' => $userId));
}

/// Retrieves the Comment and User information for a given Item.
/// $itemId - the Id of the item to look up.
function GetCommentsWithUsersForItem($itemId) {
	$query = "SELECT * FROM comments AS c
			  LEFT JOIN users AS u on u.Id = c.userId
			  WHERE c.itemId=:id
			  ORDER by updated";
	return DbSelect($query, array(':id' => $itemId));
}

/// Saves comments onto an item.
/// $itemId - the Item to save comments for
/// $userId - the Id of the User who wrote the comment.
/// $comment - the text of the comment.
function SaveComment($itemId, $userId, $comment)
{
	$query = "INSERT INTO comments(userId, itemId, comment) VALUES(:userId, :itemId, :comment)";
	return DbInsert($query, array(':userId' => $userId, ':itemId' => $itemId, ':comment' => $comment));
}
