
<?php include("cabecario.php"); ?>
<?php include("config.php"); ?>

        
        <div class="container" >
			<div class="row">
				<div class="col-lg-12">
                    <h1>
                        <a href="index.php"> <svg xmlns="http://www.w3.org/2000/svg" width="32" height="33" viewBox="0 0 32 33" fill="none">
                    <path d="M20.5465 22.1272L14.4398 16.0205L20.5465 9.90051L18.6665 8.02051L10.6665 16.0205L18.6665 24.0205L20.5465 22.1272Z" fill="#252525"/>
                    </svg></a>Informações do doador</h1>
                        
                    <hr>
					<div id="informativo" style="display: block;" >
                  <form action="pagarpix.php" method="post" role="form" onsubmit="return teste()"> 
                      
                    <div class="form-group">
                        <label for="exampleInputEmail1">CPF</label>
                        <input type="text" autocomplete="off" inputmode="numeric" class="form-control" id="cpf" name="cpf" aria-describedby="nascimento" placeholder="Somente os números"  maxlength="11" required>
                    </div> 
                       <small id="cpf-error" style="color: red; display: none;">CPF inválido</small>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Data de Nascimento</label>
                        <input type="date" autocomplete="off" class="form-control" id="nascimento" name="nascimento" aria-describedby="nascimento" placeholder="DD/MM/AAAA" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Número do celular</label>
                        <input type="tel" autocomplete="off" class="form-control" id="celular" name="celular" aria-describedby="celular" placeholder="(99) 99999-9999 " required>
                    </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="email" autocomplete="off" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Seu email" required>
                  </div>
                  <div class="form-group">
                      <label for="exampleInputEmail1">Valor da doação</label>
                      <input type="text" autocomplete="off" class="form-control" id="valor" inputmode="numeric" name="valor" aria-describedby="valor" placeholder="Insira o valor da doação" required>
                  </div>
                      <small id="valor-error" style="color: red; display: none;">Valor mínimo R$1,00</small>
                
                  
                  <button type="submit" style="background: #A6193C;
                color: #FFF;" class="btn btn-primary">Enviar</button>
                </form>
                    </div>
            
                    <div id="carregar" style="display: none;">
                    <?php include("carregando.php"); ?>
                    </div>
                  
				</div>
			</div>
		</div>

<script>
    //configurando o cpf e validando se o digitado é valido
document.getElementById('celular').addEventListener('input', function(event) {
    let telefone = event.target.value.replace(/\D/g, ''); // Remove todos os caracteres que não são dígitos

    // Verifica o tamanho do número de telefone e aplica a máscara
    if (telefone.length > 0) {
        // Adiciona o '(' após os dois primeiros dígitos
        if (telefone.length >= 2) {
            telefone = '(' + telefone.substring(0, 2) + ') ' + telefone.substring(2);
        }
        // Adiciona o espaço após o nono dígito
        if (telefone.length > 9) {
            telefone = telefone.substring(0, 10) + ' ' + telefone.substring(10);
        }
        // Limita o número de dígitos em 15
        if (telefone.length > 15) {
            telefone = telefone.substring(0, 15);
        }
        
    }

    // Define o valor do campo de entrada como a string formatada
    event.target.value = telefone;
});
    
//validar o CPF
document.getElementById('cpf').addEventListener('blur', function(event) {
    let cpf = event.target.value.replace(/\D/g, ''); // Remove todos os caracteres que não são dígitos
    // Verifica se o CPF tem 11 dígitos
    if (cpf.length !== 11) {
        document.getElementById('cpf-error').style.display = 'block'; // Exibe a mensagem de erro
        event.target.focus(); // Coloca o foco de volta no campo de entrada
    } else {
        // Calcula o dígito verificador
        let soma = 0;
        for (let i = 0; i < 9; i++) {
            soma += parseInt(cpf.charAt(i)) * (10 - i);
        }
        let resto = 11 - (soma % 11);
        let digitoVerificador1 = resto === 10 || resto === 11 ? 0 : resto;

        soma = 0;
        for (let i = 0; i < 10; i++) {
            soma += parseInt(cpf.charAt(i)) * (11 - i);
        }
        resto = 11 - (soma % 11);
        let digitoVerificador2 = resto === 10 || resto === 11 ? 0 : resto;

        // Verifica se os dígitos verificadores estão corretos
        if (parseInt(cpf.charAt(9)) === digitoVerificador1 && parseInt(cpf.charAt(10)) === digitoVerificador2) {
            document.getElementById('cpf-error').style.display = 'none'; // Esconde a mensagem de erro
        } else {
            document.getElementById('cpf-error').style.display = 'block'; // Exibe a mensagem de erro
            event.target.focus(); // Coloca o foco de volta no campo de entrada
        }
       
    }
});
 
    
    
    // validar o campo de valor colocando a virgula respeitando os caracteres decimais
    
document.getElementById('valor').addEventListener('input', function(event) {
    let valor = event.target.value.replace(/\D/g, ''); // Remove todos os caracteres que não são dígitos
    let length = valor.length;

    if (length === 0) {
        event.target.value = ''; // Se o campo estiver vazio, mantém vazio
    } else {
        // Remove os zeros à esquerda
        valor = valor.replace(/^0+/, '');
        // Adiciona a vírgula antes dos últimos dois dígitos
        valor = valor.slice(0, -2) + ',' + valor.slice(-2);
        // Atualiza o valor do campo de entrada
        event.target.value = valor;
    }
});
   
    
    function carregar(){
        document.getElementById('carregar').style.display = 'block';
        document.getElementById('informativo').style.display = 'none';
    }
    
function teste() {
    var valor = document.getElementById('valor').value;
    valor = parseFloat(valor.replace(',', '.')); // Converte a vírgula para ponto e converte para um número

    if (valor < 1.00) {
        document.getElementById('valor-error').style.display = 'block'; // Exibe a mensagem de erro
        document.getElementById('valor').focus(); // Coloca o foco no campo de valor
        return false; // Impede o envio do formulário
    }
    document.getElementById('valor-error').style.display = 'none';
    carregar(); // Abrir pagina de carregamento
    return true; // Permite o envio do formulário se a validação for bem-sucedida
    
}

    
</script>
<?php include("rodape.php")?>
