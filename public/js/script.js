window.onload = function() {

    /* -------------------- Function Selector -------------------- */

    function $query(query) {
        return document.querySelector(query);
    }

    /* -------------------- Function Open and Close Menu -------------------- */

    function openCloseMenu(menu_opener, menu_item) {
        const menu_button = $query(menu_opener);
        const menu = $query(menu_item);

        menu_button.addEventListener('click', function(event) {
            menu.classList.toggle('menu-hidden');
    
            event.stopPropagation();
        });

        document.addEventListener('click', function(e) {
            const menu_clicked = menu.contains(e.target);
            const menu_button_clicked = menu_button.contains(e.target);
    
            if (!menu_clicked && !menu_button_clicked) {
                menu.classList.remove('menu-hidden');
            }
        });
    }

    /* ------------------------ Open and Close Menu ------------------------ */

    openCloseMenu('#menu-button', '#menu');

    /* ---------------- Open and Close Lateral Menu ---------------- */

    openCloseMenu('#open-lateral-menu', '#lateral-menu');

    /* ----------------- Open and Close Accordion ----------------- */

    document.addEventListener('click', function(event) {
        const accordion_clicked = event.target.closest('.accordion-item');
    
        if (!accordion_clicked) {
            document.querySelectorAll('.accordion-collapse.show').forEach(item => {
            new bootstrap.Collapse(item, { toggle: false }).hide();
          });
        }
    });

    /* --------------- Open Modal Delete and Leave Event --------------- */
      
    const delete_button = document.querySelectorAll('.btn-delete');

    delete_button.forEach(function(button) {
        button.addEventListener('click', function() {
            var event_id = this.getAttribute('data-event-id');
            new bootstrap.Modal('#modal-delete' + event_id).show();
        });
    });

}

