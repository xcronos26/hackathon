CREATE TABLE loguin (
    id_loguin INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
    nome_usr VARCHAR(200) NULL,
    tipo_usr VARCHAR(200) NULL,
    tel_usr VARCHAR(200) NULL,
    email_usr VARCHAR(200) NULL,
    senha_usr VARCHAR(200) NULL,
    

  PRIMARY KEY(id_loguin)
);
INSERT INTO loguin (nome_usr, tipo_usr, tel_usr, email_usr, senha_usr ) VALUE ("lucas","1","61984731078","lucasde94@gmail.com","1");


CREATE TABLE doacao (
    id_doacao INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
    
    txid VARCHAR(200) NOT NULL,
    email VARCHAR(200) NULL,
    nascimento VARCHAR(200) NULL,
    celular VARCHAR(200) NULL,
    valor VARCHAR(200) NULL,
    cpf VARCHAR(200) NULL,
    statusP VARCHAR(200) NULL,
    

  PRIMARY KEY(id_doacao)
);