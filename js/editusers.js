function ChangeUserRole(id, role) {
    var confirmed = confirm("Change the user's role to: " + role);

    if (confirmed) {
        window.location = '/?action=changerole&userid=' + id + '&role=' + role;
    }
}

// Function used to confirm user deletion.
// id - the id of the user to remove.
function DeleteUser(id) {
    var confirmed = confirm("Are you sure you want to remove this user?");

    if (confirmed) {
        window.location = '/?action=deleteuser&id=' + id;
    }
}