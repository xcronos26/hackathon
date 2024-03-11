<?php

include ("config.php");
require_once 'phpqrcode/qrlib.php';
require __DIR__ . '/vendor/autoload.php';

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.bcodex.io/oauth/token',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => 'client_id=158b537c-79ff-4be3-9aca-f67e9f0c42d4&client_secret=b4833f04ea48c3495ab7fd249c39122c&grant_type=client_credentials&scope=cob.write',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/x-www-form-urlencoded'
  ),
));

$response = curl_exec($curl);

curl_close($curl);

// Decodifica a resposta JSON
$responseData = json_decode($response, true);

// Verifica se a decodificação foi bem sucedida e se o token está presente na resposta
if ($responseData !== null && isset($responseData['access_token'])) {
    // Obtém o valor do access token
    $access_token = $responseData['access_token'];

    
    // Inicie outra requisição cURL para criar o PIX
    $curl = curl_init();
    // Definir a função para gerar um ID aleatório de 28 caracteres
    function generateRandomId() {
        return bin2hex(random_bytes(14));
    }

    // Gerar o ID aleatório de 28 caracteres
    $tx_id = generateRandomId();


    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://api.bcodex.io/cob/'.$tx_id,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'PUT',
      CURLOPT_POSTFIELDS =>'{
        "calendario": {
          "expiracao": 200000
        },
        "valor": {
          "original": "'.$valor.'",
          "modalidadeAlteracao": 1
        },
        "chave": "ae9af655-64f6-44ae-bfcc-8b41d271ee6b",
        "solicitacaoPagador": "Serviço realizado.",
        "infoAdicionais": [
          {
            "nome": "software_express",
            "valor": "Informação Adicional1 do PSP-Recebedor"
          }
        ]
      }',
       CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization:  Bearer ' . $access_token,
            ),
    ));

    $response = curl_exec($curl);
    
    // Imprime a resposta da requisição PIX
   
    
    curl_close($curl);

    // Decodifica a resposta JSON do PIX
    $responseData = json_decode($response, true);

    // Verifica se a decodificação foi bem sucedida
    if ($responseData !== null && isset($responseData['pixCopiaECola'])) {
        // Obtém o valor do PIX copia e cola
        $pixCopiaECola = $responseData['pixCopiaECola'];

        // Imprime o valor do PIX copia e cola
       
        
        
// Construir o payload PIX
$payloadPix = $pixCopiaECola;

// Nome do arquivo temporário onde o QR Code será salvo
$arquivoQRCodeTemporario = tempnam(sys_get_temp_dir(), 'qr_code_');

// Gerar o QR Code e salvar como arquivo temporário
QRcode::png($payloadPix, $arquivoQRCodeTemporario);

// Ler o conteúdo do arquivo temporário
$imagemQRCode = file_get_contents($arquivoQRCodeTemporario);

// Codificar a imagem PNG em base64
$base64 = base64_encode($imagemQRCode);

// Exibir o QR Code na tela usando uma tag <img> HTML
echo '<img  width="250px" src="data:image/png;base64,' . $base64 . '" />';

// Remover o arquivo temporário
unlink($arquivoQRCodeTemporario);
    } else {
        echo "Não foi possível obter o valor do PIX copia e cola .\n";
    }
    
} else {
    echo "Não foi possível obter o access token da resposta da API.\n";
}
?>
