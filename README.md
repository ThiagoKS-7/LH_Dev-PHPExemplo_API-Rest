# README #

Teste de Api Rest em php e Docker


### Para testar o projeto siga os passos abaixo. ###

* Subir as docker utilizando o comando docker-composer up
* Após subir os conteniers da docker, conectar o banco de dados 
** host: 127.0.0.1:33070
** user: bee_dev
** password: bee_dev
** db: bee_dev
* Na raiz do projeto temos a pasta database, nela contem um dumo do banco para ser importado do mysql.

* realizar teste acessando o link [Link](http://localhost:8080/)
* Realizar a importação da Collection no postman para uso da API.

### Postman Collection ###

* [Link](https://www.getpostman.com/collections/64ce415c61cc66f794db)

### Melhorias a serem feitas ###

* Adicionar Redis nas consulta de banco
* Adicionar middleware para melhor controle de acesso.
* Adicionar JsonSchema para validação dos payload.
