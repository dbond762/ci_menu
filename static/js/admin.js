document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.menu-edit').forEach(btn => {
        btn.addEventListener('click', e => {
            let id = e.target.parentNode.dataset.id;
            document.location.href = `http://localhost/ci_menu/index.php/admin/change_menu_item/${id}`;
        });
    });
});