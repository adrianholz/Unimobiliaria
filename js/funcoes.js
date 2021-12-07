function exibir_ocultar_tipo_venda() {
  /* Pagina CADASTRO_IMOVEL.PHP */
  /*
  let aluguel = document.getElementById("mostrar_tipo_aluguel");
  let venda = document.getElementById("mostrar_tipo_venda");
     aluguel.remove();
      venda.remove();
  */
  var tipo_de_venda = document.getElementById("tipo_de_venda").value;

  if (tipo_de_venda == 'Venda') {
    document.getElementById('mostrar_tipo_aluguel').innerHTML = ("");

    document.getElementById('mostrar_tipo_venda').innerHTML = ("<h3>Valor Venda</h3> <input type='number' name='valor_venda' class='form-alterar-texto' required>");
  } else if (tipo_de_venda == 'Aluguel') {
    document.getElementById('mostrar_tipo_venda').innerHTML = ("")
    document.getElementById('mostrar_tipo_aluguel').innerHTML = ("<h3>Valor Aluguel</h3> <input type='number' name='valor_aluguel' class='form-alterar-texto' required>");

  } else {
    document.getElementById('mostrar_tipo_venda').innerHTML = ("<h3>Valor Venda</h3> <input type='number' name='valor_venda' class='form-alterar-texto' required>");
    document.getElementById('mostrar_tipo_aluguel').innerHTML = ("<h3>Valor Aluguel</h3> <input type='number' name='valor_aluguel' class='form-alterar-texto' required>");
  }
};


/* Formatar Real */
function formatarMoeda() {
  var elemento = document.getElementById('valor');
  var valor = elemento.value;

  valor = valor + '';
  valor = parseInt(valor.replace(/[\D]+/g, ''));
  valor = valor + '';
  valor = valor.replace(/([0-9]{2})$/g, ",$1");

  if (valor.length > 6) {
    valor = valor.replace(/([0-9]{3}),([0-9]{2}$)/g, ".$1,$2");
  }

  elemento.value = valor;
  if (valor == 'NaN') elemento.value = '';
}
/* Fim Formatar */


/* Mascara Telefone */
function mascara(o, f) {
  v_obj = o
  v_fun = f
  setTimeout("execmascara()", 1)
}

function execmascara() {
  v_obj.value = v_fun(v_obj.value)
}

function mtel(v) {
  v = v.replace(/\D/g, ""); //Remove tudo o que não é dígito
  v = v.replace(/^(\d{2})(\d)/g, "($1) $2"); //Coloca parênteses em volta dos dois primeiros dígitos
  v = v.replace(/(\d)(\d{4})$/, "$1-$2"); //Coloca hífen entre o quarto e o quinto dígitos
  return v;
}

function id(el) {
  return document.getElementById(el);
}
window.onload = function () {
  id('telefone').onkeyup = function () {
    mascara(this, mtel);
  }
}
/* Fim Mascara */


/* Confirmação de Senha */
let senha = document.getElementById('senha');
let senhaC = document.getElementById('senhaC');

function validarSenha() {
  if (senha.value != senhaC.value) {
    senhaC.setCustomValidity("Senhas diferentes!");
    senhaC.reportValidity();
    return false;
  } else {
    senhaC.setCustomValidity("");
    return true;
  }
}


//constantes para recuperar as tags do HTML e trabalhar com elas
const passwordInput = document.getElementById("senha")
const eyeSvg = document.getElementById("eyeSvg")

function eyeClick() {
  let inputTypeIsPassword = passwordInput.type == "password"

  if (inputTypeIsPassword) {
    showPassword()
  } else {
    hidePassword()
  }
}

function showPassword() {
  passwordInput.setAttribute("type", "text")
  eyeSvg.setAttribute("src", "../icones/hidden32px.png")
}

function hidePassword() {
  passwordInput.setAttribute("type", "password")
  eyeSvg.setAttribute("src", "../icones/eye32px.png")
}