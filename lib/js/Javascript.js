(function (win, doc) {
  'use strict';

  //Exibir o calendário
  function getCalendar(perfil, div) {
    let calendarEl = doc.querySelector(div);
    let calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth',
      headerToolbar: {
        start: 'prev,next,today',
        center: 'title',
        end: 'dayGridMonth, timeGridWeek, timeGridDay'
      },
      buttonText: {
        today: 'hoje',
        month: 'mês',
        week: 'semana',
        day: 'dia',
        list: 'list'
      },
      locale: 'pt-br',
      dateClick: function (info) {
        if (perfil == 'manager') {
          calendar.changeView('timeGrid', info.dateStr);
        } else {
          if (info.view.type == 'dayGridMonth') {
            calendar.changeView('timeGrid', info.dateStr);
          } else {
            win.location.href = 'add.php?date=' + info.dateStr
          }
        }
        /*alert('Clicked on: ' + info.dateStr);
        alert('Coordinates: ' + info.jsEvent.pageX + ',' + info.jsEvent.pageY);
        alert('Current view: ' + info.view.type);*/
      },
      events: '/Curso/controllers/ControllerEvents.php',
      eventClick: function (info) {
        if (perfil == 'manager') {
          win.location.href = `editar.php?id=${info.event.id}`;
        }
      }
    });
    calendar.render();
  }

  if (doc.querySelector('.calendarUser')) {
    getCalendar('user', '.calendarUser');
  } else if (doc.querySelector('.calendarManager')) {
    getCalendar('manager', '.calendarManager');
  }

  if (doc.querySelector('#delete')) {
    let btn = doc.querySelector('#delete');
    btn.addEventListener('click', (event) => {
      event.preventDefault();
      if (confirm("Deseja mesmo apagar este dado?")) {
        win.location.href = event.target.parentNode.href;
      }
    }, false);
  }

}(window, document));