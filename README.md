# Bulldesk Full-Stack Challenge

Teste para vaga de full-stack developer no [Bulldesk](https://bulldesk.com.br).

Você deve criar uma aplicação que importe um arquivo CSV com informações de leads. A arquivo está disponível neste repositório.

A aplicação deve ler os cabeçalhos do arquivo e dar uma lista de opções com os campos para serem mapeados para os campos do banco de dados. Os dados devem ser importados em filas, utilizando jobs do Laravel.

É necessário ter um usuário logado para fazer a importação, ao finalizar a importação esse usuário deve ser notificado em tempo real no frontend.

Não precisa necessariamente ser um SPA, mas devem ser utilizados Single File Component do Vue.

O desafiante deve mostrar bom conhecimento no conceito de filas (utilizando driver beanstalkd ou redis), eventos e também de toda a parte do front.

## Tecnologias que devem ser utilizadas

* [Vue.js](https://vuejs.org)
* [Laravel 5.6](https://laravel.com/docs/5.6/)
* [Laravel Mix](https://laravel.com/docs/5.6/mix)
* [Broadcasting](https://laravel.com/docs/5.6/broadcasting) + [Laravel Echo (com Pusher)](https://laravel.com/docs/5.6/broadcasting#installing-laravel-echo)
* [Filas com Beanstalkd ou Redis](https://laravel.com/docs/5.6/queues)

## Como participar

Faça o fork deste repositório, crie uma branch com o seu nome.

Desenvolva a aplicação e então faça um pull request para este repositório.

Na descrição do pull request você pode explicar a lógica que você usou, que dificuldades você teve, o que você fez / não fez e o motivo também, não se sinta pressionado a seguir tudo como foi dito aqui.

Caso tenha alguma dúvida, abra uma issue.

## Links

* https://laravel.com/docs/5.6/migrations
* https://laravel.com/docs/5.6/queues
* https://laravel.com/docs/5.6/notifications
* https://vuejs.org/v2/guide/single-file-components.html
