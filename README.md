# Bulldesk Full-Stack Challenge

Teste para vaga de full-stack developer no Bulldesk.

Você deve criar uma aplicação que importe um arquivo CSV com informações de leads. A arquivo está disponível neste repositório.

A aplicação deve ler os cabeçalhos do arquivo e dar uma lista de opções com os campos para serem mapeados para os campos do banco de dados. 

Não é preciso ter tela de login, mas é necessário ter um usuário logado para fazer a importação. Ao finalizar a importação esse usuário deve ser notificado em tempo real.

O desafiante deve mostrar bom conhecimento no conceito de filas (independente do driver utilizado), eventos e também de toda a parte do frontend.

## Tecnologias que devem ser utilizadas

–	Vue
–	Vue Resource
–	Laravel 5.6 
–	Laravel Mix

## Requisitos

–	Os dados devem ser processados em filas através de jobs. 
- Não precisa ser um SPA, mas devem ser utilizados Single File Component do Vue.

## Como participar

Faça o fork deste repositório, crie uma branch com o seu nome eg.

`git checkout -b jack-sparrow `

Desenvolva a aplicação e então faça um pull request para este repositório.

Na descrição do pull request você pode explicar a lógica que você usou, que dificuldades você teve, o que você fez / não fez e o motivo também, não se sinta pressionado a seguir tudo como foi dito aqui.

Caso tenha alguma dúvida, abra uma issue.

## Links

- https://laravel.com/docs/5.6/migrations
- https://laravel.com/docs/5.6/queues
- https://laravel.com/docs/5.6/notifications
- https://vuejs.org/v2/guide/single-file-components.html
