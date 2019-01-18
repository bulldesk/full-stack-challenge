# Bulldesk Full-Stack Challenge

Teste para vaga de full-stack developer (Laravel + Vue.js) no [Bulldesk](https://bulldesk.com.br).

Você deve criar uma aplicação que importe um arquivo CSV (disponível nesse repositório) com informações de leads. [Crie o banco de dados e tabelas](https://laravel.com/docs/5.6/migrations) baseados neste arquivo. 

A aplicação deve ler os cabeçalhos do arquivo e dar uma lista de opções com os campos para serem mapeados para os campos do banco de dados. Os dados devem ser importados em [filas](https://laravel.com/docs/5.6/queues) (driver beanstalkd ou redis), utilizando jobs do Laravel.

É necessário ter um usuário logado para fazer a importação, ao finalizar a importação esse usuário deve ser [notificado em tempo real](https://laravel.com/docs/5.6/notifications) no frontend.

Não precisa necessariamente ser um SPA, mas devem ser utilizados [Single File Component do Vue](https://vuejs.org/v2/guide/single-file-components.html).

O desafiante deve mostrar bom conhecimento em PHP, no conceito de filas, eventos e também de toda a parte do front.

## Tecnologias/features que devem ser utilizadas

* [Vue.js](https://vuejs.org)
* [Laravel 5.6](https://laravel.com/docs/5.6/)
* [Laravel Mix](https://laravel.com/docs/5.6/mix)
* [Migrations](https://laravel.com/docs/5.6/migrations)
* [Filas com Beanstalkd ou Redis](https://laravel.com/docs/5.6/queues)
* [Broadcasting](https://laravel.com/docs/5.6/broadcasting) + [Laravel Echo (com Pusher)](https://laravel.com/docs/5.6/broadcasting#installing-laravel-echo)

## Como participar

Faça o fork deste repositório, crie uma branch com o seu nome.

Desenvolva a aplicação e então faça um pull request para este repositório.

Na descrição do pull request você pode explicar a lógica que você usou, que dificuldades você teve, o que você fez / não fez e o motivo também, não se sinta pressionado a seguir tudo como foi dito aqui.

Caso tenha alguma dúvida, abra uma issue.

## Links

* https://laravel.com/docs/5.6
* https://laravel.com/docs/5.6/queues
* https://laravel.com/docs/5.6/migrations
* https://laravel.com/docs/5.6/notifications
* https://laravel.com/docs/5.6/broadcasting
* https://vuejs.org/v2/guide/single-file-components.html
* https://github.com/gabrielkoerich/guidelines
