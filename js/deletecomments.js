function DeleteComment(id) {
    var confirmed = confirm("Are you sure you want to delete this comment?");

    if (confirmed) {
        window.location = '/?action=deletecomment&comment=' + id;
    }
}