window.onload = function() {

    var menu_button = document.querySelector('#menu-button');
    var menu = document.querySelector('#menu');

    menu_button.addEventListener('click', function() {

        if(menu.style.display == 'flex') {
            menu.style.display = 'none';
        } else {
            menu.style.display = 'flex';
        }

    });


    var delete_buttons = document.querySelectorAll('.btn-delete');

    delete_buttons.forEach(function(button) {
        button.addEventListener('click', function() {

            var event_id = this.getAttribute('data-event-id');

            new bootstrap.Modal('#modal-delete' + event_id).show();

        });
    });

}