<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form id="form">
        <input type="text" id="name" placeholder="name">
        <input type="text" id="job" placeholder="job">
        <button>Cadastrar</button>
    </form>

    <script>
        let name = document.querySelector('#name');
        let job  = document.querySelector('#job');
        let form = document.querySelector('#form');

        form.addEventListener("submit", function(event){
            event.preventDefault();

            let dados = {
                name: name.value,
                job: job.value
            }
            
            //document.write(name.value);
            //document.write(job.value);

            fetch('https://reqres.in/api/users', {  //BLOCO QUE SERA ENVIADO.. PODEMOS AQUI CHAMAR DE REQUISIÇÃO
                
                method: 'POST',             // AQUI E ONDE DEFINIMOS O METODO DE ENVIO DA REQUISIÇÃO
                body: JSON.stringify(dados) // AQUI ESTAMOS DEFININDO OS DADOS QUE ESTÃO SENDO ENVIADOS NO CORPO DA REQUISIÇÃO 
                                            // NÃO PODEMOS ENVIAR OS APENAS PASSANDO O OBJETO. A FORMA CORRETE E TRANFORMAR NOSSO OBJETO EM UM(JSON STRING) 
                                            // PARA ISSO BASTA PASSAR O OBJETO DENTRO DA FUNÇÃO => JSON.stringify(dados) DESSE MESMO MODO.. AGORA SIM PODEMOS MANDALO
            
                                            // O BLOCO ABAIXO TAMBÉM E CHAMADO DE 'PROMISES' ONDE TEMOS 2 PARTE 1º A TRANFORMAÇÃO DO RETORNO DA RESPOSTA PARA JSON E A 2º QUE E A MANIPULAÇÃO DESSE JSON
            }).then(function(response){ //BLOCO QUE TRATARA A RESPOSTA. RESPOSTA DA REQUISIÇÃO
                return response.json(); // NESSA PARTE DEVEMOS PEGAR O RETORNO DA RESPOSTA DA REQUISIÇÃO E RETORNALO COM JSON 
            }).then(function(response) {
                //AQUI IREMOS MANIPULAR A RESPOTA DE NOSSA REQUISIÇÃO AJAX
                //console.log(response);
                document.write(name.value);
                document.write("<br/>");
                document.write(job.value);
                document.write("<br/>");
                document.write('Registro cadastrado com sucesso.');
            });
        });
    </script>

    <br><br>
    <button id="btn">Buscar usuários</button>
    <ul id="list">
    </ul>

    <script>
        let btn  = document.querySelector("#btn");
        let list = document.querySelector("#list");

        btn.addEventListener("click", function(){
            fetch('https://reqres.in/api/users?page=2')
            .then(function(response){
                return response.json();
            })
            .then(function(response){
                response.data.forEach(function(user){
                    let item = document.createElement("li");

                    item.innerHTML = '<img src="'+user.avatar+'" /><span>'+user.first_name+'</span>';

                    list.appendChild(item);
                });
            });
        });

    </script>
</body>
</html>