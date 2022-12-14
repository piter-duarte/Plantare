//Todo o nosso Javascript estará neste arquivo
(function (win, doc) {
  'use strict';

  //Configurações e exibição do FullCalendar
  function getCalendar(perfil, div, dir) {
    let calendarEl = doc.querySelector(div);
    let calendar = new FullCalendar.Calendar(calendarEl,
      {
        initialView: 'dayGridMonth',

        //TODO V2.0 lista eventos da semana com -> listweek view
        timeZone: 'local',
        //Configurar ver mais no calendário
        dayMaxEvents: true,
        displayEventTime: false,
        height: "95%",
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
        events: `${dir}/controllers/meuCalendarioEventos.php`,  //adiciona os eventos ao calendário, pegando o JSON da tabela eventos do Banco de Dados
        eventClick: function (info) {
          if (perfil == 'manager') {         
              
            //Convertendo as datas para string devido a erros referentes ao update
            //convertendo a hora inicial
            let start = info.event.start;
            let manipulacaoStart = new Date(start);
            let ano1 = manipulacaoStart.getFullYear();
            let dia1 = manipulacaoStart.getDate();
            let mes1 = manipulacaoStart.getMonth() + 1;
            let horario1 = manipulacaoStart.toLocaleTimeString();

            let horaInicial = `${ano1}-${mes1}-${dia1} ${horario1}`;
          
            //convertendo a hora final
            let end = info.event.end;
            let manipulacaoEnd= new Date(end);
            let ano2 = manipulacaoEnd.getFullYear();
            let dia2 = manipulacaoEnd.getDate();
            let mes2 = manipulacaoEnd.getMonth() + 1;
            let horario2 = manipulacaoEnd.toLocaleTimeString();

            let horaFinal = `${ano2}-${mes2}-${dia2} ${horario2}`;

            //passando todos os dados do objeto evento
            //&title=${info.event.title}&description=${info.event.description}&color=${info.event.color}&start=${horaInicial}&end=${horaFinal}&clienteEmail=${info.event.extendedProps.clienteEmail}&provedorEmail=${info.event.extendedProps.provedorEmail}&idServico=${info.event.extendedProps.idServico}&preco=${info.event.extendedProps.precoServico}&status=${info.event.extendedProps.status}&rating=${info.event.extendedProps.rating}
            win.location.href = `statusPedidos.php?id=${info.event.id}`;
          }
          else if(perfil == 'user') 
          {
           
            //convertendo a hora inicial
            let start = info.event.start;
            let manipulacaoStart = new Date(start);
            let ano1 = manipulacaoStart.getFullYear();
            let dia1 = manipulacaoStart.getDate();
            let mes1 = manipulacaoStart.getMonth() + 1;
            let horario1 = manipulacaoStart.toLocaleTimeString();

            let horaInicial = `${ano1}-${mes1}-${dia1} ${horario1}`;
        
            //convertendo a hora final
            let end = info.event.end;
            let manipulacaoEnd= new Date(end);
            let ano2 = manipulacaoEnd.getFullYear();
            let dia2 = manipulacaoEnd.getDate();
            let mes2 = manipulacaoEnd.getMonth() + 1;
            let horario2 = manipulacaoEnd.toLocaleTimeString();

            let horaFinal = `${ano2}-${mes2}-${dia2} ${horario2}`;

            //passando todos os dados do objeto evento
            //&title=${info.event.title}&description=${info.event.description}&color=${info.event.color}&start=${horaInicial}&end=${horaFinal}&clienteEmail=${info.event.extendedProps.clienteEmail}&provedorEmail=${info.event.extendedProps.provedorEmail}&idServico=${info.event.extendedProps.idServico}&preco=${info.event.extendedProps.precoServico}&status=${info.event.extendedProps.status}&rating=${info.event.extendedProps.rating}
            win.location.href = `statusPedidos.php?id=${info.event.id}`;     
          }
        },
      });
    calendar.render();
  }
  
  //Função utilizada para realizar a validação dos formulários
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

  //Função utilizada para adicionar required nos checkboxs
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

  //Página Assets / Testes
  if(doc.querySelector('form#testeForm'))
  {
    validateForm('#testeForm');
  }

  //Página Index
  if(doc.querySelector('main.index')){
    //função para modificar imagem do slide
    if (doc.querySelector('div.heroarea div.heroradios')) 
    {
        if (document.getElementById("radio1")) 
        {
          let radio = document.getElementById("radio1");
          radio.addEventListener("click", (event) => {
            document.getElementById("heroarea").style.backgroundImage = "url('lib/img/image1.png')";
          })
        }

        if (document.getElementById("radio2")) 
        {
          let radio = document.getElementById("radio2");
          radio.addEventListener("click", (event) => {
            document.getElementById("heroarea").style.backgroundImage = "url('lib/img/image2.png')";
          })
        }

        if (document.getElementById("radio3")) 
        {
          let radio = document.getElementById("radio3");
          radio.addEventListener("click", (event) => {
            document.getElementById("heroarea").style.backgroundImage = "url('lib/img/image3.png')";
          })
        }
    }
  }

  //Página Cadastro
  if(doc.querySelector('main.cadastroPage')){
    
    //verifica se tem um calendário e fica continuamente o validando
    if (document.getElementById("formCadastro")) {
      validateForm('#formCadastro');
    }

    //verifica se a opção pessoa física foi selecionado e oculta razão social e cnpj
    if (doc.querySelector('#tipo_pessoa_f')) {
      let tipo = doc.querySelector('#tipo_pessoa_f');
      let inputNome = doc.querySelector('div.formGroup div.flex.items-center input#nome');
      let inputRazaoSocial = doc.querySelector('div.formGroup div.flex.items-center input#razao_social');
      tipo.addEventListener('change', (event) => {
        doc.getElementById("form-pessoa-fisica").style.display = "block";
        doc.getElementById("form-pessoa-juridica").style.display = "none";
        inputNome.required = true;
        inputRazaoSocial.required = false;
      }, false);
    }

    //verifica se a opção pessoa jurídica foi selecionada e oculta nome completo e cpf
    if (doc.querySelector('#tipo_pessoa_j')) {
      let tipo = doc.querySelector('#tipo_pessoa_j');
      let inputNome = doc.querySelector('div.formGroup div.flex.items-center input#nome');
      let inputRazaoSocial = doc.querySelector('div.formGroup div.flex.items-center input#razao_social');
      tipo.addEventListener('change', (event) => {
        doc.getElementById("form-pessoa-fisica").style.display = "none";
        doc.getElementById("form-pessoa-juridica").style.display = "block";
        inputNome.required = false;
        inputRazaoSocial.required = true;
      }, false);
    }
  }

  //Página Continuação Cadastro
  if(doc.querySelector('main.continuacaoCadastro')){
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
  
      doc.querySelector('form#continuacaoCadastroForm').addEventListener('submit', event => 
      {
        if(!servicoGrama.checked && !servicoPoda.checked && !servicoPesticida.checked && !servicoFertiliza.checked)
        {
          event.preventDefault();
          alert("Pelo menos um serviço deve ser selecionado para ser prestado!")
        }
          validateForm('form#continuacaoCadastroForm');
      });
    }

    let btCancelar = doc.querySelector('input#cancelar');
    btCancelar.addEventListener('click', function(){

      //pegando a url do sistema
      let pathArray = window.location.pathname.split('/');
      let pasta = pathArray[1];
      let  url = window.location.protocol + "//" + window.location.host + "/" + pasta + "/index.php";
      
      window.location.replace(`${url}`);
    });
  }

  //Página Login
  if(doc.querySelector('main.loginPage')){
    if (document.getElementById("loginForm")) 
    {
      validateForm('#loginForm');
    }
  }

  //Página Meu Calendário (Usuário)
  if(doc.querySelector('main.logadoPage div.conteudo div.calendarUser'))
  {
    //observa no documento se existe a classe .calendarUser e traz o calendário de usuário
    if (doc.querySelector('.calendarUser'))
    {
      const loc = window.location.pathname;
      const dir = loc.substring(0, loc.lastIndexOf("/v"));
      getCalendar('user', '.calendarUser', dir);
    }
  }

  //Página Meu Calendário (Provedor)
  if(doc.querySelector('main.logadoPage div.conteudo div.calendarManager'))
    {
      //observa no documento se existe a classe .calendarManager e traz o calendário do provedor
      if (doc.querySelector('.calendarManager'))
      {
        const loc = window.location.pathname;
        const dir = loc.substring(0, loc.lastIndexOf("/v"));
        getCalendar('manager', '.calendarManager', dir);
      }
  }

  //Página Meu Perfil (Ambas View's)
  if(doc.querySelector('main.logadoPage div.conteudo.meuPerfil'))
  {
    if (doc.querySelector('form#formMeuPerfil')) 
    {
      let btSalvar          = doc.querySelector('button#salvar');
      let btEditar          = doc.querySelector('button#editar');
      let inputNome         = doc.querySelector('input#nome');
      let inputCpf          = doc.querySelector('input#cpf');         
      let inputRazaoSocial  = doc.querySelector('input#razao_social'); 
      let inputCnpj         = doc.querySelector('input#cnpj'); 
      let inputTelefone     = doc.querySelector('input#telefone'); 
      let inputCep          = doc.querySelector('input#cep');
      let inputEndereco     = doc.querySelector('input#endereco');
      btEditar.addEventListener('click', function ()
      {
        if(btEditar.innerHTML == 'Editar')
        {
          btEditar.innerHTML='Cancelar';
          btEditar.classList.add('bts');
          btSalvar.classList.remove('bts');
          inputNome.disabled = false;
          inputCpf.disabled = false;
          inputRazaoSocial.disabled = false;
          inputCnpj.disabled = false;
          inputTelefone.disabled = false;
          inputCep.disabled = false;
          inputEndereco.disabled = false;
          
          btSalvar.disabled = false; //permite com que o formulário seja enviado
        } 
        else if(btEditar.innerHTML == 'Cancelar')
        {
          btEditar.innerHTML='Editar';
          btEditar.classList.remove('bts');
          btSalvar.classList.add('bts');

          inputNome.disabled = true;
          inputCpf.disabled = true;
          inputRazaoSocial.disabled = true;
          inputCnpj.disabled = true;
          inputTelefone.disabled = true;
          inputCep.disabled = true;
          inputEndereco.disabled = true;
          
          btSalvar.disabled = true; //impede que o formulário seja enviado
        }
      });
    }
  }

  //Página Cadastrar Serviços (Usuário) || -> SE TORNAR PROVEDOR
  if(doc.querySelector('main.logadoPage div.conteudo.cadastrarServicos')) {
  }

  //Página Meus Serviços (Provedor)
  if(doc.querySelector('main.logadoPage div.conteudo.meusServicos')) {
    if (doc.querySelector('form#formMeusServicos')) {
      let btSalvar          = doc.querySelector('button#salvar');
      let btEditar          = doc.querySelector('button#editar');
      let inputPrecoGrama         = doc.querySelector('input#precoGrama');
      let inputPrecoPoda        = doc.querySelector('input#precoPoda');
      let inputPrecoPesticida         = doc.querySelector('input#precoPesticida');
      let inputPrecoFertilizante        = doc.querySelector('input#precoFertilizante');

      btEditar.addEventListener('click', function ()
      {
        if(btEditar.innerHTML == 'Editar')
        {
          btEditar.innerHTML='Cancelar';
          btEditar.classList.add('bts');
          btSalvar.classList.remove('bts');
          inputPrecoGrama.disabled = false;
          inputPrecoPoda.disabled = false;
          inputPrecoPesticida.disabled = false;
          inputPrecoFertilizante.disabled = false;

          btSalvar.disabled = false; //permite com que o formulário seja enviado
        } 
        else if(btEditar.innerHTML == 'Cancelar')
        {
          btEditar.innerHTML='Editar';
          btEditar.classList.remove('bts');
          btSalvar.classList.add('bts');
  
          inputPrecoGrama.disabled = true;
          inputPrecoPoda.disabled = true;
          inputPrecoPesticida.disabled = true;
          inputPrecoFertilizante.disabled = true;
          
          btSalvar.disabled = true; //impede que o formulário seja enviado
        }
      });
    }
  }

  //Página Realizar Orçamento (Usuário)
  if(doc.querySelector('main.logadoPage div.conteudo.realizarOrcamento')){
    //Abaixo serão realizadas todas as buscas automáticas de acordo com
    //as opções selecionadas pelo usuário e criado o pop-up com o orçamento final
    if (doc.querySelector("form#realizarOrcamento")) 
    {
      //realiza a pesquisa no banco de acordo com o serviço selecionado
      if (doc.querySelector('#title')) {
        let btn = doc.querySelector('#title');
        btn.addEventListener('change', (event) => {
          document.cookie = `id=${btn.value}`;
          window.location.replace(window.location.href);
        }, false);
      }
    
      //realiza a pesquisa no banco de acordo com o tempo de atendimento selecionado
      if (doc.querySelector('#horasAtendimento')) {
        let hora = doc.querySelector('#horasAtendimento');
        document.cookie = `hora=${hora.value}`;
        hora.addEventListener('change', (event) => {
          document.cookie = `hora=${hora.value}`;
          window.location.replace(window.location.href);
        }, false);
      }
  
      //realiza a pesquisa no banco de acordo com o provedor selecionado e o serviço (para coletar informações referentes ao preço)
      if (doc.querySelector('select#provider_key')) {
        let selectProfissional = doc.querySelector('select#provider_key');
        document.cookie = `email=${selectProfissional.value}`;
        selectProfissional.addEventListener('change', (event) => {
          document.cookie = `email=${selectProfissional.value}`;
          window.location.replace(window.location.href);
        }, false);
      }
  

      //Passando as informações do formulário para um pop-up
      doc.querySelector("input#solicitarOrcamento").addEventListener("click", function(){
        //adiciona o pop-up
        doc.querySelector("div.popup.realizarOrcamento").classList.add("active");
       
        //remove a opacidade do formulário atrás
        doc.querySelector("div.space80").classList.add("disabled");
        
        /*coleta as informações do form*/
        let servico = doc.querySelector("select#title"); //serviço
        let servicoNome = servico.options[servico.selectedIndex].text;
  
        let data = doc.querySelector("input#date"); //data
        let dataString = data.value;
        dataString = dataString.split("-").reverse().join("/");
  
        let time = doc.querySelector("input#time"); //hora inicial
  
        let tempoAtendimento = doc.querySelector("select#horasAtendimento"); //pegando o tempo de atendimento
        let horaFinal = new Date();
  
        //convertendo a string de hora inicial para numero
        let myArray = time.value.split(":"); //pegando somente a hora antes do :00
        let numHoraInicio = myArray[0];
  
        horaFinal.setHours(parseInt(numHoraInicio) + parseInt(tempoAtendimento.value)); // adicionando o tempo de atendimento a hora inicial para obter a hora final
  
        let profissional = doc.querySelector("select#provider_key"); //select do form
        
        let infosProfissional = profissional.options[profissional.selectedIndex].innerHTML //informações profissional
        
        let myArray2 = infosProfissional.split("|");
        let nomeProfissional = myArray2[0];
        let notaProfissional = myArray2[1];
        let precoHora = doc.querySelector("input#precoServico"); //input do form escondido que possui o preço
  
        let totalPagar = precoHora.value * tempoAtendimento.value; //total a pagar
        //tranferindo para o pop-up
        let h4pop = doc.querySelector("div.popup.realizarOrcamento h4");
        let pData = doc.querySelector("div#popup-p-group p:nth-child(1)");
        let pHoraI = doc.querySelector("div#popup-p-group p:nth-child(2)");
        let pHoraF = doc.querySelector("div#popup-p-group p:nth-child(3)");
        let pProfissional = doc.querySelector("div#popup-p-group p:nth-child(4)");
        let pPrecoHora = doc.querySelector("div#popup-p-group p:nth-child(5)");
        let pTotalPagar = doc.querySelector("div#popup-p-group p:nth-child(6)");
  
        if(h4pop.innerHTML == "Orçamento - "){
          h4pop.innerHTML = `${h4pop.innerHTML} ${servico.options[servico.selectedIndex].innerHTML}`;
        }
        if(pData.innerHTML == "Data: "){
          pData.innerHTML = `${ pData.innerHTML} ${dataString}`;
        }
        if(pHoraI.innerHTML == "Hora Inicial: "){
          pHoraI.innerHTML = `${ pHoraI.innerHTML} ${time.value}`;
        }
        if(pHoraF.innerHTML == "Hora Final: "){
          pHoraF.innerHTML = `${ pHoraF.innerHTML} ${horaFinal.getHours()}:00`; //como não são aceitas horas quebras não tem problema colocar :00 no final
        }
        if(pProfissional.innerHTML == "Profissional: "){
          pProfissional.innerHTML = `${ pProfissional.innerHTML} ${nomeProfissional}`;
        }
        if(pPrecoHora.innerHTML == "Preço por hora: "){
          if(precoHora.value % 1 == 0){
            precoHora.value = parseInt(precoHora.value);
          }
          pPrecoHora.innerHTML = `${ pPrecoHora.innerHTML} R$${precoHora.value}`;
        }
        if(pTotalPagar.innerHTML == "Total a pagar: "){
          if(totalPagar% 1 !== 0)
          {
            totalPagar = Math.round(totalPagar * 100) / 100;
          }
          pTotalPagar.innerHTML = `${ pTotalPagar.innerHTML} R$${totalPagar}`;
        }
      });
    
      //Escutando a interação do usuário com o botão cancelar do pop-up
      doc.querySelector("input#popCancel").addEventListener("click", function(){
        doc.querySelector("div.popup.realizarOrcamento").classList.remove("active");
        doc.querySelector("div.space80").classList.remove("disabled");
      });
    }
  }
  
  //Página Status do Pedido
  if(doc.querySelector('main.logadoPage div.conteudo.StatusPedido')){
  }

}(window, document));