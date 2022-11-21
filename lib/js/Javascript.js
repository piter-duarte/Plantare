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
        slotLabelFormat: {
          hour: 'numeric',
          minute: '2-digit',
          omitZeroMinute: false,
        },
        buttonText:
        {
          today: 'hoje',
          month: 'mês',
          week: 'semana',
          day: 'dia',
        },
        showNonCurrentDates: false,
        fixedWeekCount: false,
        allDaySlot: false,
        locale: 'pt-br',
        slotDuration: '01:00:00',
        dateClick: function (info) {
          if (perfil == 'manager') { //se perfil for manager e clickar em uma data abre a visualização do calendário modo dia
            calendar.changeView('timeGrid', info.dateStr);
          }
          else // perfil for de usuario
          {
            if (info.view.type == 'dayGridMonth') //se estiver na visualização de mês e clickar em uma data
            {
              calendar.changeView('timeGrid', info.dateStr); //vai para a visualização de dia, com o dia selecionado

              // let listaLabelHora = doc.querySelectorAll('div.fc-timegrid-slot-label-cushion.fc-scrollgrid-shrink-cushion');
              // listaLabelHora.forEach(labelHora => {
              //   if (!labelHora.innerHTML.includes('hrs')) {
              //     labelHora.innerHTML = labelHora.innerHTML + ' hrs';
              //   }

              // });
   

            }
            else //se clicou em um horário do dia na visualização de dia ou de semana
            {
              let today = new Date().getDate(); //pega a data do sistema

              if (info.date.getDate() < today) //verifica se a data que foi clickar é anterior a data atual
              {
                alert("Caro usuário, não é permitido marcar serviços em datas que já passaram");
              }
              else {
                win.location.href = 'realizarOrcamento.php?date=' + info.dateStr;
              }
            }
          }
        },
        events: `${dir}/controllers/ControllerEvents.php`,  //adiciona os eventos ao calendário, pegando o JSON da tabela eventos do Banco de Dados
        eventClick: function (info) {
          if (perfil == 'manager') {
            win.location.href = `editar.php?id=${info.event.id}`;
          }
          else {
            if (info.event.borderColor == 'green' && info.event.extendedProps.rating == null) {
              //alert('Avaliar ' + info.event.extendedProps.provider_key);
              win.location.href = `avaliarProfissional.php?id=${info.event.id}&provider_key=${info.event.extendedProps.provider_key}`;
            }
          }
        },
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
      if (confirm("Deseja mesmo apagar este dado?")) {
        win.location.href = event.target.parentNode.href;
      }
    }, false);
  }

  if (doc.querySelector('#title')) {
    let btn = doc.querySelector('#title');
    btn.addEventListener('change', (event) => {
      document.cookie = `id=${btn.value}`;
      window.location.replace(window.location.href);
    }, false);
  }

  if (doc.querySelector('#horasAtendimento')) {
    let hora = doc.querySelector('#horasAtendimento');
    document.cookie = `hora=${hora.value}`;
    hora.addEventListener('change', (event) => {
      document.cookie = `hora=${hora.value}`;
      window.location.replace(window.location.href);
    }, false);
  }

  if (doc.querySelector('#tipo_pessoa_f')) {
    let tipo = doc.querySelector('#tipo_pessoa_f');
    let inputNome = doc.querySelector('div.formGroup div.flex.items-center input#nome');
    let inputRazaoSocial = doc.querySelector('div.formGroup div.flex.items-center input#razao_social');
    tipo.addEventListener('change', (event) => {
      console.log("Carregar formulário pessoa física.");
      doc.getElementById("form-pessoa-fisica").style.display = "block";
      doc.getElementById("form-pessoa-juridica").style.display = "none";
      inputNome.required = true;
      inputRazaoSocial.required = false;
    }, false);
  }

  if (doc.querySelector('#tipo_pessoa_j')) {
    let tipo = doc.querySelector('#tipo_pessoa_j');
    let inputNome = doc.querySelector('div.formGroup div.flex.items-center input#nome');
    let inputRazaoSocial = doc.querySelector('div.formGroup div.flex.items-center input#razao_social');
    tipo.addEventListener('change', (event) => {
      console.log("Carregar formulário pessoa jurídica.");
      doc.getElementById("form-pessoa-fisica").style.display = "none";
      doc.getElementById("form-pessoa-juridica").style.display = "block";
      inputNome.required = false;
      inputRazaoSocial.required = true;
    }, false);
  }

  if (doc.querySelector('form#continuacaoCadastroForm')) {
    let servicoGrama = doc.querySelector('input.checkbox__input#servicoGrama');
    let precoGrama = doc.querySelector('div.flex.items-center input#precoGrama');
    let servicoPoda = doc.querySelector('input.checkbox__input#servicoPoda');
    let precoPoda = doc.querySelector('div.flex.items-center input#precoPoda');
    let servicoFertiliza = doc.querySelector('input.checkbox__input#servicoFertiliza');
    let precoFertilizante = doc.querySelector('div.flex.items-center input#precoFertilizante');
    let servicoPesticida = doc.querySelector('input.checkbox__input#servicoPesticida');
    let precoPesticida = doc.querySelector('div.flex.items-center input#precoPesticida');

    adicionarRequiredCheckbox(servicoGrama, precoGrama);
    adicionarRequiredCheckbox(servicoPoda, precoPoda);
    adicionarRequiredCheckbox(servicoFertiliza, precoFertilizante);
    adicionarRequiredCheckbox(servicoPesticida, precoPesticida);

  }

  function adicionarRequiredCheckbox(servicoCheckbox, servicoPrecoInput) {
    servicoCheckbox.addEventListener('change', function () {
      if (this.checked) {
        // console.log("Checkbox is checked..");
        servicoPrecoInput.required = true;
        servicoPrecoInput.disabled = false;
      } else {
        // console.log("Checkbox is not checked..");
        servicoPrecoInput.required = false;
        servicoPrecoInput.disabled = true;
      }
    });
  };

  if (doc.querySelector('div.heroarea div.heroradios')) {

    // let radio1 = doc.querySelector('div.heroradios input[type=radio]#radio1');

    if (document.getElementById("radio1")) {
      let radio = document.getElementById("radio1");
      radio.addEventListener("click", (event) => {
        document.getElementById("heroarea").style.backgroundImage = "url('lib/img/image1.png')";
      })
    }

    if (document.getElementById("radio2")) {
      let radio = document.getElementById("radio2");
      radio.addEventListener("click", (event) => {
        document.getElementById("heroarea").style.backgroundImage = "url('lib/img/image2.png')";
      })
    }

    if (document.getElementById("radio3")) {
      let radio = document.getElementById("radio3");
      radio.addEventListener("click", (event) => {
        document.getElementById("heroarea").style.backgroundImage = "url('lib/img/image3.png')";
      })
    }
  }

  const validateForm = formSelector => {
    const formElement = document.querySelector(formSelector);

    const validationOptions = [
      {
        attribute: 'minlength',
        isValid: input =>
          input.value && input.value.length >= parseInt(input.minLength, 10),
        errorMessage: (input, label) =>
          `${label.textContent} precisa ter no mínimo ${input.minLength} caracteres`,
      },
      {
        attribute: 'custommaxlength',
        isValid: input =>
          input.value &&
          input.value.length <=
          parseInt(input.getAttribute('custommaxlength'), 10),
        errorMessage: (input, label) =>
          `${label.textContent} deve ter no máximo ${input.getAttribute(
            'custommaxlength'
          )} caracteres`,
      },
      {
        attribute: 'pattern',
        isValid: input => {
          const patternRegex = new RegExp(input.pattern);
          return patternRegex.test(input.value);
        },
        errorMessage: (input, label) =>
          `${label.textContent} precisa ser um email válido`,
      },
      {
        attribute: 'match',
        isValid: input => {
          const matchSelector = input.getAttribute('match');
          const matchedElem = document.querySelector(`#${matchSelector}`);
          return matchedElem && matchedElem.value.trim() === input.value.trim();
        },
        errorMessage: (input, label) => {
          const matchSelector = input.getAttribute('match');
          const matchedElem = document.querySelector(`#${matchSelector}`);
          const matchedLabel =
            matchedElem.parentElement.parentElement.querySelector('label');
          return `${label.textContent} precisa ser igual a ${matchedLabel.textContent}`;
        },
      },
      {
        attribute: 'required',
        isValid: input => input.value.trim() !== '',
        errorMessage: (input, label) => `${label.textContent} é obrigatório`,
      },
    ];

    const validateSingleFormGroup = formGroup => {
      const label = formGroup.querySelector('label');
      const input = formGroup.querySelector('input, textarea');
      const errorContainer = formGroup.querySelector('.error');
      const errorIcon = formGroup.querySelector('.error-icon');
      const successIcon = formGroup.querySelector('.success-icon');

      let formGroupError = false;
      for (const option of validationOptions) {
        if (input.hasAttribute(option.attribute) && !option.isValid(input)) {
          errorContainer.textContent = option.errorMessage(input, label);
          input.classList.add('border-red-700');
          input.classList.remove('border-green-700');
          successIcon.classList.add('hidden');
          errorIcon.classList.remove('hidden');
          formGroupError = true;
        }
      }

      if (!formGroupError) {
        errorContainer.textContent = '';
        input.classList.add('border-green-700');
        input.classList.remove('border-red-700');
        errorIcon.classList.add('hidden');
        successIcon.classList.remove('hidden');
      }

      return !formGroupError;
    };

    const validateAllFormGroups = formToValidate => {
      const formGroups = Array.from(
        formToValidate.querySelectorAll('.formGroup')
      );

      const isFormValidArray = [];
      formGroups.forEach(formGroup => {
        isFormValidArray.push(validateSingleFormGroup(formGroup));
      });

      if (isFormValidArray.every(element => element === true) === true) {
        return true; //formulário sem erros
      }
      else {
        return false //formulário com erros
      }


    };

    // Disable HTML5 Validation
    formElement.setAttribute('novalidate', '');

    // Enable validation for each control whilst updating form
    Array.from(formElement.elements).forEach(element =>
      element.addEventListener('change', event => {
        validateSingleFormGroup(event.srcElement.parentElement.parentElement);
      })
    );

    // Only validate form when submitting
    formElement.addEventListener('submit', event => {

      const formValid = validateAllFormGroups(formElement);


      if (formValid == false) {
        event.preventDefault();
      }

    });
  };

  if (document.getElementById("registrationForm")) {
    validateForm('#registrationForm');
  }
  else if (document.getElementById("loginForm")) {
    validateForm('#loginForm');
  }
  else if (document.getElementById("formCadastro")) {
    validateForm('#formCadastro');
  }
  else if (doc.querySelector("form#continuacaoCadastroForm")) {
    validateForm('#continuacaoCadastroForm');
  }


}(window, document));