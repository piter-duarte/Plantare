(function (win, doc) {
  'use strict';

  //Exibir o calendário
  function getCalendar(perfil, div, dir) {
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
      events: `${dir}/controllers/ControllerEvents.php`,  //adiciona os eventos ao calendário, pegando o JSON da tabela eventos do Banco de Dados
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
            win.location.href = `rating.php?id=${info.event.id}&provider_key=${info.event.extendedProps.provider_key}`;
          }
        }
      }
    });
    calendar.render();
  }

  if (doc.querySelector('.calendarUser')) //observa no documento se existe a classe .calendarUser e traz o calendário de usuário
  {
    const loc = window.location.pathname;
    const dir = loc.substring(0, loc.lastIndexOf("/v"));
    getCalendar('user', '.calendarUser', dir);
  }
  else if (doc.querySelector('.calendarManager')) //traz o calendário de manager
  {
    const loc = window.location.pathname;
    const dir = loc.substring(0, loc.lastIndexOf("/v"));
    getCalendar('manager', '.calendarManager', dir);
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
      document.cookie = `id=${btn.value}`;
      window.location.replace(window.location.href);
    }, false);
  }

  if (doc.querySelector('#horasAtendimento'))
  {
    let hora = doc.querySelector('#horasAtendimento');
    document.cookie = `hora=${hora.value}`;
    hora.addEventListener('change', (event) =>
    {
      document.cookie = `hora=${hora.value}`;
      window.location.replace(window.location.href);
    }, false);
  }

  if (doc.querySelector('#tipo_pessoa_f'))
  {
    let tipo = doc.querySelector('#tipo_pessoa_f');
    tipo.addEventListener('change', (event) =>
    {
      console.log("Carregar formulário pessoa física.");
      doc.getElementById("form-pessoa-fisica").style.display = "block";
      doc.getElementById("form-pessoa-juridica").style.display = "none";
    }, false);
  }

  if (doc.querySelector('#tipo_pessoa_j'))
  {
    let tipo = doc.querySelector('#tipo_pessoa_j');
    tipo.addEventListener('change', (event) =>
    {
      console.log("Carregar formulário pessoa jurídica.");
      doc.getElementById("form-pessoa-fisica").style.display = "none";
      doc.getElementById("form-pessoa-juridica").style.display = "block";
    }, false);
  }

  if (doc.querySelector('div.heroarea div.heroradios')){

    // let radio1 = doc.querySelector('div.heroradios input[type=radio]#radio1');

    if(document.getElementById("radio1")){
      let radio = document.getElementById("radio1");
      radio.addEventListener("click", (event) =>{
        document.getElementById("heroarea").style.backgroundImage= "url('lib/img/image1.png')";
      })
    }  

    if(document.getElementById("radio2")){
      let radio = document.getElementById("radio2");
      radio.addEventListener("click", (event) =>{
        document.getElementById("heroarea").style.backgroundImage= "url('lib/img/image2.png')";
      })
    }  

    if(document.getElementById("radio3")){
      let radio = document.getElementById("radio3");
      radio.addEventListener("click", (event) =>{
        document.getElementById("heroarea").style.backgroundImage= "url('lib/img/image3.png')";
      })
    }  
  }

}(window, document));