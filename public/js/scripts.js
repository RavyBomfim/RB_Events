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

    var duration = document.querySelector('#duration');
    var duration_display = document.querySelector('#duration-display');

    if(duration.value !== '' && duration.value !== '0') {

        duration_display.style.display = 'flex';
    }

    duration.addEventListener('input', function() {

        hour = (duration.value / 60) | 0;
        minutes = duration.value % 60;

        var hour_text; 
        var minutes_text; 
        var total_duration;

        if(hour == 1) {
            hour_text = hour + ' hora'
        } else {
            hour_text = hour + ' horas'
        }

        if(minutes == 1) {
            minutes_text = minutes + ' minuto'
        } else {
            minutes_text = minutes + ' minutos'
        }

        if(hour > 0 && minutes > 0) {
            total_duration = hour_text + ' e ' + minutes_text;
        } else if(hour > 0 && minutes <= 0) {
            total_duration = hour_text;
        } else {
            total_duration = minutes_text;
        }

        if( hour > 0 || minutes > 0) {
            duration_display.innerHTML = total_duration;

            duration_display.style.display = 'flex';
        } else {
            duration_display.style.display = 'none';
        }

        console.log(total_duration);

    })

    var screen_width = window.innerWidth;
    var duration_field = document.getElementById('duration');

    if(screen_width < 324) {
        duration_field.placeholder = 'Duração do evento em minutos';
    }

}