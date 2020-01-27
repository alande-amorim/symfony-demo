Dashboard de Posts - Symfony Demo Application
========================

Utiliza como base o [Symfony Demo](https://github.com/symfony/demo)

Requisitos
------------

  * PHP 5.5.9 or higher;
  * PDO-SQLite PHP extension enabled;
  * and the [usual Symfony application requirements](http://symfony.com/doc/current/reference/requirements.html).

Instalando
------------

```bash
$ git clone https://github.com/alande-amorim/symfony-demo.git
$ cd symfony-demo/
$ composer install
$ ./bin/console doctrine:schema:update --force
```

Executando
-----

```bash
$ ./bin/console server:start
```

Implementações
-----
- Na interface administrativa, foi adicionado um botão "Relatório de posts" ao menu.
- Na barra lateral, foi criado um resumo das informações do blog contendo o número de posts e comentários. 
- Foi implementado um long polling em ajax que atualiza os números do resumo a cada segundo a fim de refletir mudanças realizadas por outros usuários.
- Ao clicar no botão "Salvar estado", adicionamos um registro no banco de dados com esses dados que são agrupados por usuário. A página então é atualizada a fim de exibir a lista desses estados.

Problemas
-----
- A atualização para a versão 3.4 do Symfony a partir da tag v1.0.0 do [symfony/demo](https://github.com/symfony/demo/tree/v1.0.0) mantendo as demais versões das dependências não foi possível. Foi utilizada a versão 3.4 do Symfony atualizando as versões das demais bibliotecas de modo que atendessem a versão expressamente determinada.
