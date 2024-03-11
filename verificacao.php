<?php

$tx_id= $_REQUEST["tx_id"];
$access_token= $_REQUEST["access_token"];
/*
  $access_token = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6IjE1OGI1MzdjLTc5ZmYtNGJlMy05YWNhLWY2N2U5ZjBjNDJkNCIsInNjb3BlcyI6WyJjb2Iud3JpdGUiXSwiaWF0IjoxNzA5ODM5NzExLCJleHAiOjE3MDk4NDMzMTF9.5kehqX4H_aJKoYA5hoXdtvZoQepaWa6jdl888WLRGCk';
*/

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.bcodex.io/cob/'.$tx_id,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer '. $access_token
  ),
));

$response = curl_exec($curl);

curl_close($curl);




// Decodifica a resposta JSON
$responseData = json_decode($response, true);

// Verifica se a decodificação foi bem sucedida e se o status está presente na resposta
if ($responseData !== null && isset($responseData['status'])) {
    // Obtém o valor do status
    $status = $responseData['status'];
    
    // Verifica se o status é "CONCLUIDA"
    if ($status === 'CONCLUIDA') {
        echo json_encode(array('status' => $responseData['status']));
    } else {
      echo json_encode(array('error' => 'Não foi possível obter o status da resposta da API.'));
        
    }
} else {
    echo "Não foi possível obter o status da resposta da API.\n";
}
?>
