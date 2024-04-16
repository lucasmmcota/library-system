# SGBib - Sistema para gerenciamento de bibliotecas escolares

## Introdução

Bibliotecas não informatizadas enfrentam alguns desafios que afetam sua eficiência, acessibilidade e capacidade de gerenciar os recursos de informação. O processo de informatização tem em vista introduzir melhorias nas atividades e tarefas das bibliotecas, além de resolver problemas como a manutenção e o monitoramento do acervo.

Diante disso, foi desenvolvido um projeto durante o trabalho de conclusão de curso da Universidade Federal de Ouro Preto (UFOP) que consiga superar estas adversidades, trata-se do SGBib. O programa visa cadastrar, alterar e excluir livros e membros com facilidade, além de realizar ações de empréstimo, renovação e devolução de forma ágil e intuitiva. Também é oferecida ao bibliotecário a possibilidade de configurar os termos de empréstimo, como a quantidade de dias e o número máximo de renovações.

Além disso, o sistema oferece recursos, como a geração de etiquetas para os livros, facilitando o monitoramento físico do acervo. E para contribuir na migração e aceitação do sistema, são disponibilizadas ferramentas que incluem a importação de dados de membros e livros e a leitura de código de barras e/ou QR Code para realização de empréstimos.

Durante o trabalho de conclusão de curso, o projeto foi disponibilizado em produção empregando recursos da AWS (Amazon Web Services). O sistema foi implementado em uma máquina virtual utilizando o serviço da EC2 (Elastic Compute Cloud) enquanto o seu banco de dados era armazenado em nuvem com os serviços da RDS (Relational Database Service). A maneira como isto foi feito, assim como mais detalhes sobre o projeto, podem ser vistos realizando a leitura da monografia: [SGBib : um sistema web open source para o gerenciamento de bibliotecas](https://www.monografias.ufop.br/handle/35400000/6052).

A seguir é possível observar um passo a passo para a implementação do projeto na sua máquina.

## Softwares necessários

Os seguintes softwares são essenciais para a instalação do projeto:

[![git](https://img.shields.io/badge/git-2.44.0-brightgreen.svg?logo=git)](https://git-scm.com/)
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
[![php](https://img.shields.io/badge/php-8.2.5-brightgreen.svg?logo=php)](https://www.php.net/)
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
[![laravel](https://img.shields.io/badge/laravel-10.48.7-brightgreen.svg?logo=laravel)](https://laravel.com/)
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
[![node](https://img.shields.io/badge/node-21.6.2-brightgreen.svg?logo=nodedotjs)](https://nodejs.org/en)
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
[![npm](https://img.shields.io/badge/npm-10.5.2-brightgreen.svg?logo=npm)](https://www.npmjs.com/)
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
[![composer](https://img.shields.io/badge/composer-2.7.2-brightgreen.svg?logo=composer)](https://getcomposer.org/)

A versão informada é a utilizada atualmente no projeto e diferente das versões indicadas na monografia. O Laravel está incluso no projeto e não possui a necessidade de instalação prévia.

## Como instalar

Após possuir os softwares essenciais devidamente instalados, você pode instalar o projeto da seguinte maneira:

- Clone o repositório.
```
git clone https://github.com/lucasmmcota/sgbib.git
```

- Modifique para a pasta do projeto.
```
cd sgbib
```

- Instale as bibliotecas front-end do projeto.
```
npm install
```

- Instale as bibliotecas PHP do projeto.
```
composer install
```

- Ao instalar as bibliotecas do projeto, a pasta de tradução em português é excluída. Caso você deseje ter as mensagens de validação em português, é necessário rodar o comando abaixo.
```
git checkout vendor\laravel\framework\src\Illuminate\Translation\lang\pt_br
```

- Crie o arquivo de configuração `.env` conforme a instrução a seguir. Logo após, você pode configurá-lo segundo as suas necessidades.
```
cp .env.example .env
```

- Gere a chave da sua aplicação.
```
php artisan key:generate
```

- Crie as tabelas do banco de dados.
```
php artisan migrate
```

- Crie um usuário para acesso.
```
php artisan db:seed
```

- Execute o sistema.
```
php artisan serve
```

- O login pode ser realizado com as seguintes credencias:
    - E-mail: admin@admin.com
    - Senha: admin123

Concluindo a instalação do repositório com êxito já é possível cadastrar membros, livros e realizar operações de empréstimo!
