<?php
    $host = "108.181.92.68";
    $user = "primeiro";
    $pass = "12qwaszx";
    $base = "primeiro";

    $conn = new mysqli($host, $user, $pass, $base);

    //opcional: mostrar o erro caso não consiga conectar
    if ($conn->connect_error) {
        die('Error: ' . $conn->connect_error);
    }

    // Definir a codificação de caracteres para UTF-8
    $conn->set_charset("utf8");


        
    // Configuração do access_token
    if (!defined('ACCESS_TOKEN')) {
        define('ACCESS_TOKEN', 'Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6ImNiMjQxNTMyLWFlNmMtNDZlOS04NzUwLTQ4ZGVlMjJmMTk1ZSIsInNjb3BlcyI6WyJjb2Iud3JpdGUiXSwiaWF0IjoxNzA5NzU5OTM0LCJleHAiOjE3MDk3NjM1MzR9.rhB7DsUVUeXavflNsHksKSpfaiwswZMBUwqfr6J8HAc');
    }
    
    $access_token = 'Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6IjE1OGI1MzdjLTc5ZmYtNGJlMy05YWNhLWY2N2U5ZjBjNDJkNCIsInNjb3BlcyI6WyJjb2Iud3JpdGUiXSwiaWF0IjoxNzA5ODE4MTAxLCJleHAiOjE3MDk4MjE3MDF9.OoqWqlpk1-8uIMQtlmieYZS4Qs6sDS4_XeUSvUbeESQ';

    
?>
