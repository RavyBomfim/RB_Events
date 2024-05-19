window.onload = function() {

    var duration = document.querySelector('#duration');
    var duration_display = document.querySelector('#duration-display');

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

            duration_display.style.display= 'flex';
        } else {
            duration_display.style.display= 'none';
        }

        console.log(total_duration);

    })

}