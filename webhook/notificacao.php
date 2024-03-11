<?php
include("config.php");
// Recebe o JSON do corpo da requisição
$json = file_get_contents('php://input');

// Decodifica o JSON em um array associativo
$data = json_decode($json, true);

// Verifica se o JSON foi decodificado corretamente e se o campo "pix" existe
if (isset($data['pix'])) {
    // Itera sobre cada transação PIX recebida
    foreach ($data['pix'] as $pix) {
        // Acessa os campos de cada transação PIX
        $tx_id = $pix['txId'];
        
        // Executa a query SQL para atualizar o status da doação
        $sql = "UPDATE doacao SET statusP='Aprovd' WHERE txid = '$tx_id'";
        
        // Executa a query
        $result = $conn->query($sql) or die($conn->error);
        
        // Verifica se a query foi executada com sucesso
        if ($result) {
            print "<div class='alert alert-success'>Certinho</div>";
        } else {
            print "<div class='alert alert-danger'>Não foi possível editar!</div>";
        }
    }
} else {
    print "<div class='alert alert-danger'>JSON inválido ou campo 'pix' não encontrado!</div>";
}
?>
