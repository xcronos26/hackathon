<?php
    

    $celular = $_REQUEST["celular"];
    $email = $_REQUEST["email"];
    $nascimento = $_REQUEST["nascimento"];
    $valor = $_REQUEST["valor"];
    $cpf = $_REQUEST["cpf"];
    $statusP = "pendente";
    


	
			$sql = "INSERT INTO doacao (
                    celular,
                    email, 
                    nascimento,
                    valor,
                    cpf,
                    statusP,
                    txid) 
                    
                VALUES (
                    '{$celular}',
                    '{$email}',
                    '{$nascimento}',
                    '{$valor}',
                    '{$cpf}',
                    '{$statusP}',
                    '{$tx_id}'
                    
                    
                )";
			 if (strlen($celular) > 0 && strlen($email) > 0 && strlen($nascimento) > 0 && strlen($valor) > 0 ){
			    $result = $conn->query($sql) or die($conn->error);
			}
			//caso nao tenha dado enviado sera dado falso e sera mandado um aviso de erro para o usuário
            else{
			    $result = false;
            }
			
			if($result==true){
				//header("Location:pagarpix.php?valor=$valor");
			}else{
				print "<div class='alert alert-danger'>Não possível cadastrar</div>";
			}
            
            
            
              
        