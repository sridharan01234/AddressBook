window.addEventListener('DOMContentLoaded', () => {
    const checkboxes = document.getElementsByName('delete_users[]');
    const checkboxAll = document.getElementById('checkbox-all');

    function selectAll() {
        for (let i = 0; i < checkboxes.length; i++) {
            checkboxes[i].checked = checkboxAll.checked;
        }
    }

    checkboxAll.addEventListener('change', selectAll);
});

function deleteAlert() {
    return confirm("Are you sure you want to delete this user?");
}
