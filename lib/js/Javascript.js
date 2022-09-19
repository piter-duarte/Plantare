(function (win, doc) {
  'use strict';

  //Exibir o calendário
  function getCalendar(perfil, div) {
    let calendarEl = doc.querySelector(div);
    let calendar = new FullCalendar.Calendar(calendarEl,
    {
      initialView: 'dayGridMonth',
      timeZone: 'local',
      headerToolbar:
      {
        start: 'prev,next,today',
        center: 'title',
        end: 'dayGridMonth, timeGridWeek, timeGridDay'
      },
      buttonText:
      {
        today: 'hoje',
        month: 'mês',
        week: 'semana',
        day: 'dia',
      },
      allDaySlot: false,
      locale: 'pt-br',
      slotDuration : '01:00:00',
      dateClick: function (info)
      {
        if (perfil == 'manager')
        { //se perfil for manager e clickar em uma data abre a visualização do calendário modo dia
          calendar.changeView('timeGrid', info.dateStr);
        } 
        else // perfil for de usuario
        { 
          if (info.view.type == 'dayGridMonth') //se estiver na visualização de mês e clickar em uma data
          {
            calendar.changeView('timeGrid', info.dateStr); //vai para a visualização de dia, com o dia selecionado
          } 
          else //se clicou em um horário do dia na visualização de dia ou de semana
          {
            let today = new Date().getDate(); //pega a data do sistema

            if(info.date.getDate() < today) //verifica se a data que foi clickar é anterior a data atual
            {
              alert("Caro usuário, não é permitido marcar serviços em datas que já passaram");
            }
            else
            {
              win.location.href = 'add.php?date=' + info.dateStr;
            }  
          }
        }
      },
      events: '/Curso/controllers/ControllerEvents.php',  //adiciona os eventos ao calendário, pegando o JSON da tabela eventos do Banco de Dados
      eventClick: function (info)
      {
        if (perfil == 'manager')
        {
          win.location.href = `editar.php?id=${info.event.id}`;
        }
        else
        {
          if(info.event.borderColor == 'green' && info.event.extendedProps.rating == null)
          {
            //alert('Avaliar ' + info.event.extendedProps.provider_key);
            win.location.href = `rating.php?id=${info.event.id}`;
          }
        }
      }
    });
    calendar.render();
  }

  if (doc.querySelector('.calendarUser')) //observa no documento se existe a classe .calendarUser e traz o calendário de usuário
  {
    getCalendar('user', '.calendarUser');
  }
  else if (doc.querySelector('.calendarManager')) //traz o calendário de manager
  {
    getCalendar('manager', '.calendarManager');
  }

  if (doc.querySelector('#delete')) //observa no documento se existe o id #delete 
  {
    let btn = doc.querySelector('#delete'); //atribui o elemento #delete a variável
    btn.addEventListener('click', (event) => //adiciona um observador de click
    {
      event.preventDefault();
      if (confirm("Deseja mesmo apagar este dado?"))
      {
        win.location.href = event.target.parentNode.href;
      }
    }, false);
  }

  if (doc.querySelector('#title'))
  {
    let btn = doc.querySelector('#title');
    btn.addEventListener('change', (event) =>
    {
      alert(btn.value);
    }, false);
  }

}(window, document));