<?php include("cabecariocarregando.php"); ?>
<?php include("config.php"); 
$tx_id = $_REQUEST["txid"];
	 $sql = "SELECT * FROM doacao WHERE txid = '$tx_id'";
	
	$result = $conn->query($sql) or die($conn->error);
	
	$qtd = $result->num_rows;
                    
    $row = $result->fetch_assoc();
    $email = $row["email"];
    $celular = $row["celular"];
    $nascimento = $row["nascimento"];
    $txid = $row["txid"];
    $valor = $row["valor"];
    $cpf = $row["cpf"];

function formatarCPF($cpf) {
    $parte1 = substr($cpf, 0, 3);
    $parte2 = substr($cpf, 3, 3);
    $parte3 = substr($cpf, 6, 3);
    $parte4 = substr($cpf, 9, 2);

    return $parte1 . '.' . $parte2 . '.' . $parte3 . '-' . $parte4;
}
function formatarData($nascimento) {
    // Converte a data para o formato desejado
    $dataFormatada = date('d/m/Y', strtotime($nascimento));
    return $dataFormatada;
}
$cpfFormatado = formatarCPF($cpf);
$dataFormatada = formatarData($nascimento);
?>
        <div class="container">
			<div class="row">
				<div class="col-lg-12">

                    <div class="spacer"></div>
                    <center>
                        <div class="certo">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="19" viewBox="0 0 28 19" fill="none">
                          <path d="M26.6024 0.762466C26.9091 1.06285 27.0814 1.47003 27.0814 1.89457C27.0814 2.31911 26.9091 2.7263 26.6024 3.02668L10.7702 18.513C10.4631 18.813 10.0468 18.9816 9.61279 18.9816C9.17877 18.9816 8.7625 18.813 8.45541 18.513L1.35822 11.5709C1.06907 11.267 0.911616 10.8653 0.918946 10.4502C0.926276 10.0352 1.09782 9.63904 1.39753 9.34511C1.69802 9.05195 2.10299 8.88416 2.52733 8.87698C2.95167 8.86981 3.36233 9.02383 3.67299 9.30666L9.61279 15.1167L24.2876 0.762466C24.5947 0.462457 25.011 0.293945 25.445 0.293945C25.879 0.293945 26.2953 0.462457 26.6024 0.762466Z" fill="white"/>
                        </svg></div>
                        <p>Doação enviada com sucesso!</p>
                        </center>
                        <h4>Dados do doador</h4>
                        <p>CPF:<br>
                        <b><?php  echo $cpfFormatado; ?></b></p> 
                        <p>Telefone:<br>
                        <b><?php  echo $row["celular"]; ?></b></p>
                        <p>Data de Nascimento:<br>
                        <b><?php  echo $dataFormatada; ?></b></p>
                        <p>Email:<br>
                        <b><?php  echo $row["email"]; ?></b></p>
                        <hr>
                        <p>Id da Doação:<br>
                        <b><?php  echo $row["txid"]; ?></b></p>
                        <p>Valor:<br>
                        <b>R$ <?php  echo $row["valor"]; ?></b></p>
                        <hr>
                        


                        <div class="avisofinal">
                            <div class="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="19" viewBox="0 0 18 19" fill="none">
                                    <path d="M8.25 13.1821H9.75V8.68213H8.25V13.1821ZM9 7.18213C9.2125 7.18213 9.39075 7.11013 9.53475 6.96613C9.67875 6.82213 9.7505 6.64413 9.75 6.43213C9.75 6.21963 9.678 6.04163 9.534 5.89813C9.39 5.75463 9.212 5.68263 9 5.68213C8.7875 5.68213 8.6095 5.75413 8.466 5.89813C8.3225 6.04213 8.2505 6.22013 8.25 6.43213C8.25 6.64463 8.322 6.82288 8.466 6.96688C8.61 7.11088 8.788 7.18263 9 7.18213ZM9 16.9321C7.9625 16.9321 6.9875 16.7351 6.075 16.3411C5.1625 15.9471 4.36875 15.4129 3.69375 14.7384C3.01875 14.0634 2.4845 13.2696 2.091 12.3571C1.6975 11.4446 1.5005 10.4696 1.5 9.43213C1.5 8.39463 1.697 7.41963 2.091 6.50713C2.485 5.59463 3.01925 4.80088 3.69375 4.12588C4.36875 3.45088 5.1625 2.91663 6.075 2.52313C6.9875 2.12963 7.9625 1.93263 9 1.93213C10.0375 1.93213 11.0125 2.12913 11.925 2.52313C12.8375 2.91713 13.6313 3.45138 14.3063 4.12588C14.9813 4.80088 15.5157 5.59463 15.9097 6.50713C16.3037 7.41963 16.5005 8.39463 16.5 9.43213C16.5 10.4696 16.303 11.4446 15.909 12.3571C15.515 13.2696 14.9808 14.0634 14.3063 14.7384C13.6313 15.4134 12.8375 15.9479 11.925 16.3419C11.0125 16.7359 10.0375 16.9326 9 16.9321Z" fill="#424242"/>
                                </svg>
                            </div>
                            <p class="texto">Os dados da proposta e os termos da doação serão encaminhados em breve para e-mail informado.</p>
                        </div>


        
<?php 
                    include("email.php");
                    include("rodapecarregando.php");
                    ?>