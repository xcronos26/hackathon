
<?php include("cabecario.php"); ?>
<?php include("config.php");
   $valor = $_REQUEST["valor"];
   $cpf = $_REQUEST["cpf"];
?>
    
        
        <div class="container">
			<div class="row">
				<div class="col-lg-12">
                    <h1><a href="informacoes.php"> <svg xmlns="http://www.w3.org/2000/svg" width="32" height="33" viewBox="0 0 32 33" fill="none">
                        <path d="M20.5465 22.1272L14.4398 16.0205L20.5465 9.90051L18.6665 8.02051L10.6665 16.0205L18.6665 24.0205L20.5465 22.1272Z" fill="#252525"/>
                        </svg> </a> Pagar PIX</h1>
                    <hr>
                    <div id="gerar">
                    <center>
                        <a href="#" class="butao2">
                            <span>valor:</span>
                            <span>R$<?php echo $valor; ?></span>
                        </a>
                        <p style="font-size: 10px;">Escaneie o QR Code em seu aplicativo para realizar o pagamento.</p>
                       <?php include("gerarpix.php"); ?>
                        
                      

                        <div class="tempo">
                            <span id="contador">00:00</span>
                        
                        </div>
                         <p style="font-size: 10px;">Tempo restante para realizar pagamento</p>
                        
                        
                        <button onclick="carregar()">aaaaaaaaaaaa</button>
                    </center>
                    </div>
				</div>
			</div>
		</div>


<!-- Modal pequeno -->

<div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
        <div class="container">
			<div class="row">
                <div class="col-lg-12">
                    <br>
                    <center>
                              <svg width="68" height="68" viewBox="0 0 68 68" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="0.362305" width="67.2754" height="67.2754" rx="33.6377" fill="#9C0606"/>
                        <rect x="2.11731" y="1.75501" width="63.7654" height="63.7654" rx="31.8827" stroke="#FF7373" stroke-opacity="0.15" stroke-width="3.51002"/>
                        <path d="M46.5288 43.5242C46.8797 43.875 47.0768 44.351 47.0768 44.8472C47.0768 45.3435 46.8797 45.8194 46.5288 46.1703C46.1779 46.5212 45.7019 46.7183 45.2057 46.7183C44.7094 46.7183 44.2335 46.5212 43.8826 46.1703L33.9999 36.2846L24.1141 46.1672C23.7632 46.5181 23.2873 46.7152 22.791 46.7152C22.2948 46.7152 21.8189 46.5181 21.468 46.1672C21.1171 45.8163 20.9199 45.3404 20.9199 44.8441C20.9199 44.3479 21.1171 43.8719 21.468 43.521L31.3538 33.6385L21.4711 23.7529C21.1202 23.402 20.923 22.926 20.923 22.4298C20.923 21.9335 21.1202 21.4576 21.4711 21.1067C21.822 20.7558 22.2979 20.5587 22.7942 20.5587C23.2904 20.5587 23.7663 20.7558 24.1172 21.1067L33.9999 30.9924L43.8857 21.1052C44.2366 20.7543 44.7125 20.5571 45.2088 20.5571C45.705 20.5571 46.181 20.7543 46.5319 21.1052C46.8828 21.4561 47.0799 21.932 47.0799 22.4282C47.0799 22.9245 46.8828 23.4004 46.5319 23.7513L36.6461 33.6385L46.5288 43.5242Z" fill="white"/>
                        </svg>
                                                <br>

                        <b>Doação expirada</b>
                                <p>O tempo para realizar o PIX da sua doação expirou, gere uma nova cobrança com o valor desejado.</p>
                                <a href="informacoes.php" class="butao3" >gerar nova doação</a>
                        <br>
                    </center>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="verificar_status.js"></script>

<!--- --------------- Fim do Modal ------------------>



<div id="carregar" style="display: none;">
<?php include("carregando2.php"); ?>
</div>




<script>
    
    
// Função para iniciar a contagem regressiva
function iniciarContagem() {
    var contadorElemento = document.getElementById('contador');
    var tempoRestante = 5 * 60; // 5 minutos em segundos

    var contadorInterval = setInterval(function() {
        var minutos = Math.floor(tempoRestante / 60);
        var segundos = tempoRestante % 60;

        // Adiciona um zero à esquerda se os minutos ou segundos forem menores que 10
        minutos = minutos < 10 ? '0' + minutos : minutos;
        segundos = segundos < 10 ? '0' + segundos : segundos;

        // Atualiza o texto do contador
        contadorElemento.textContent = minutos + ':' + segundos;

        // Verifica se o tempo acabou
        if (tempoRestante <= 0) {
            clearInterval(contadorInterval); // Para a contagem regressiva
              $('.bd-example-modal-sm').modal('show');// abrir o modal do alerta 
        } else {
            tempoRestante--; // Decrementa o tempo restante
        }
    }, 1000); // Executa a cada segundo
}

// Inicia a contagem regressiva quando a página carrega
window.onload = iniciarContagem;

    
    //Voltar para a página de informações e gera uma nova cobrança
    $('.bd-example-modal-sm').on('hidden.bs.modal', function () {
       window.location.href = 'informacoes.php';// volta para a pagina de cadastro
    });
    
var loop = "s";

$(document).ready(function(){
    function verificarStatus() {
        if (loop == "s") {
            $.ajax({
                url: 'verificacao.php?tx_id=<?php echo $tx_id; ?>&access_token=<?php echo $access_token; ?>',
                method: 'GET',
                dataType: 'json',
                success: function(response){
                    if (response.status === 'CONCLUIDA') {
                        loop = "n"; // Altera o valor de 'loop' para 'n'
                        console.log("parar o loop");
                        carregar(); // Abrir pagina de carregamento
                        window.location.href = 'doacarorecebida.php?txid=<?php echo $tx_id; ?>'; // Redireciona para outra página
                    } else {
                        console.log("continua o loop");
                        setTimeout(verificarStatus, 500); // Verificar novamente após 1 segundo
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    console.log("continua o loop");
                    setTimeout(verificarStatus, 500); // Verificar novamente após 1 segundo em caso de erro
                }
            });
        }
    }

    // Inicia a verificação do status
    verificarStatus();
});


function carregar(){
    document.getElementById('carregar').style.display = 'block';
    document.getElementById('gerar').style.display = 'none';
}
    
    
</script>

<?php 



include("rodape.php");
include("_salvar.php");

?>