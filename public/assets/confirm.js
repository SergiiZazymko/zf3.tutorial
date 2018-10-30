document.addEventListener('DOMContentLoaded', e => {
    function confirmFunc(e) {
        if (!confirm('Are you really want to delete this album?')) {
            e.preventDefault();
        }
    }
    document.querySelectorAll('.delete').forEach(elem => {
        elem.addEventListener('click', confirmFunc);
    });
});
