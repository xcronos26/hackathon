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

<?php echo '
<style type="text/css">
              
              .corpo {
                justify-content: center; 
                align-items: center;
                text-decoration: none;
                padding: 75px; 
                font-family: Inter;
                font-size: 16px;
                font-style: normal;
                
                line-height: normal;
                letter-spacing: -0.165px;
              }
              
              .avisofinal {
                display: flex;
                justify-content: space-between; /* Distribui os itens horizontalmente */
                align-items: center;
                width: 296px;
                padding: 8px 20px;
                gap: 10px;
                border-radius: 8px;
               
                }

                .avisofinal p {
                    margin: 0; /* Remova as margens padrão do parágrafo */

                }
                
                .butao {
                
               
                width:238px;
                padding: 16px 28px;
                background: #A6193C;
                color: #FFF;
                
                font-family: Inter;
                font-size: 16px;
                font-style: normal; 
                
                }
                .butao:hover {
                    text-decoration: none; 
                    color: #FFF;
                }
        
</style>
<center>
 <div style="background-color: #A7193C ; width: 100%; height: 9px;"></div>
        <nav  style="background-color: #FFF; display: flex; justify-content: center; padding: 30px 0 24px;">
            <img src="https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEhMzPL2i7Iaiq1aeTfFMEbTUZC8FG6x7sukPHZBZ-kZW9ce_qwC022NvCJPKdNhrj2qFt2ghFeuGnk1eBpth8JutyTIpu9kJpN4ndqKVsPeMHpqqx5e_9OTUjraybZAWW-oK-kdsojbL4UEKBixVvyp0LSJz8XuYwZdOQbhaXBpoJdzbEi9a8C9FN2jwWi3/s1280/credAMIGO-BNB.png" width="145px">
        </nav>
        <div style="background-color: #A7193C ; width: 100%; height: 3px;"></div>
</center>
        
				<div>
               <br>
                    <div class="corpo">
                    <h2>Olá,</h2>
                    
                    <p classe="avisofinal">Sua doação no <b style="color:#A6193C;"> valor de R$ '.$valor.'</b> para a campanha foi concluída com sucesso, acesse abaixo o seu comprovante, com os dados da sua doação.</p><br>
                    <div class="avisofinal">
                     <img src=" https://imagemsolution.com/image/cert.png" width="67px">
                   

                    <p>Doação efetivada com sucesso!</p>
                    </div>
                        </center>
                        <h4>Dados do doador</h4>
                        <p>CPF:<br>
                        <b>'.$cpfFormatado.'</b></p>
                        <p>Telefone:<br>
                        <b>'.$celular.'</b></p>
                        <p>Data de Nascimento:<br>
                        <b>'.$dataFormatada.'</b></p>
                        <p>Email:<br>
                        <b>'.$email.'</b></p>
                        <hr>
                        <p>Id da Doação:<br>
                        <b>'.$txid.'</b></p>
                        <p>Valor:<br>
                        <b>R$ '.$valor.'</b></p><br>
                        
                       <center>
                <div class="butao">Acessar termos de doação</div>
                </center>
                <p>Precisa de ajuda?<br> 
                Entre em contato através do e-mail:  suporte@bnb.gov.br<br>
                Este é um email automático. Por favor, não responda.
                 </div>
 ';

