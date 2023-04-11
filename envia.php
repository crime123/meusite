<?php
/*
* CONFIGURAR TUDO AQUI
*/

// um endereço de e-mail que estará no campo De do e-mail.
$ from = 'rei.geo@hotmail.com' ;

// um endereço de e-mail que receberá o e-mail com a saída do formulário
$ sendo = 'oliveira.reinaldo@escola.pr.gov.br' ;

// assunto do e-mail
$ subject = 'Forumlário do site' ;

// nomes de campo de formulário e suas traduções.
// nome da variável array => Texto para aparecer no e-mail
$ campos = array ( 'nome' => 'Nome' , 'sobrenome' => 'Sobrenome' , 'telefone' => 'Telefone' , 'email' => 'E-mail' , 'mensagem' => 'Mensagem ' );

// mensagem que será exibida quando tudo estiver OK :)
$ okMessage = 'Sua mensagem foi enviada com sucesso!' ;

// Se algo der errado, exibiremos esta mensagem.
$ errorMessage = 'Ocorreu um erro ao enviar o formulário.' ;

/*
* VAMOS FAZER O ENVIO
*/

// se você não está depurando e não precisa de relatórios de erros, desative isso por error_reporting(0);
error_reporting( E_ALL & ~ E_NOTICE );

tentar
{

    if (count( $ _POST ) == 0 ) lançar  novo \ Exception ( 'Formulário está vazio' );

    $ emailText = " Formulário de contato Web Fácil \n ============================= \n";

    foreach ( $ _POST  as  $ chave => $ valor ) {
        // Se o campo existir no array $fields, inclua-o no e-mail
        if (isset( $ campos [ $ chave ])) {
            $ emailText .= " $ campos [ $ chave ] : $ valor \n";
        }
    }

    // Todos os cabeçalhos necessários para o e-mail.
    $ headers = array ( 'Content-Type: text/plain; charset="UTF-8";' ,
        'De:' . $ de ,
        'Responder-Para:' . $ de ,
        'Caminho de retorno: ' . $ de ,
    );

    // Enviar email
    mail( $ sendTo , $ subject , $ emailText , implode("\n", $ headers ));

    $ responseArray = array ( 'type' => 'success' , 'message' => $ okMessage );
}
catch ( \ Exceção  $ e )
{
    $ responseArray = array ( 'type' => 'danger' , 'message' => $ errorMessage );
}


// se solicitado pela solicitação AJAX, retorna a resposta JSON
if (!empty( $ _SERVER [ 'HTTP_X_REQUESTED_WITH' ]) && strtolower( $ _SERVER [ 'HTTP_X_REQUESTED_WITH' ]) == 'xmlhttprequest' ) {
    $ encoded = json_encode( $ responseArray );

    header( 'Tipo de conteúdo: aplicativo/json' );

    echo  $ codificado ;
}
// senão apenas exibir a mensagem
outra coisa {
    echo  $ responseArray [ 'mensagem' ];
}
