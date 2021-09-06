<h4 align="center">
  🚀 Laravel 8 - API Resful utilizando Cache com REDIS
</h4>

<p align="center">
 <img alt="PHPCS compliance" src="https://img.shields.io/static/v1?label=PHPCS&message=compliance&color=3fb950&labelColor=333333">
 <img alt="PHPStan compliance" src="https://img.shields.io/static/v1?label=PHPStan&message=compliance&color=3fb950&labelColor=333333">
 <img alt="PRs welcome!" src="https://img.shields.io/static/v1?label=PRs&message=welcome&color=7159c1&labelColor=000000"  />
</p>

## :rocket: Tecnologias

Esse projeto foi desenvolvido com as seguintes tecnologias:

- [PHP 7.4](https://php.net)
- [Laravel 8](https://laravel.com)
- [Telescope](https://github.com/laravel/telescope)
- [MySQL 5.7](https://mysql.com)
- [Docker](https://docker.com)


## 💻 Projeto

Esse projeto é uma API Restful desenvolvida como exemplo prático de criação de uma API Restful utilizando cache
com REDIS, Repository Pattern e Testes Funcionais

## 📄 Requisitos

* PHP 7.4+, Laravel 7+, MySQL 5.7+ e Docker


## ⚙️ Instalação e execução

**Windows, OS X & Linux:**

Baixe o arquivo zip e o descompacte ou baixe o projeto para sua máquina através do git clone.


- Entre no prompt de comando e vá até a pasta do projeto:

```sh
cd ir-ate-a-pasta-do-projeto
```

- Crie o arquivo .env a partir do arquivo .env.example. As variáveis de ambiente relacionadas ao banco já estão configuradas.

```sh
copy .env.example .env
```

- Assumindo que tenha o docker instalado na máquina, para subir os containeres, execute o comando:

```sh
docker-compose up -d
```

- Após isso, execute o comando abaixo para instalar as dependências do laravel.

```sh
docker-compose exec api-cache composer install
```
- Aguarde até que todas as dependências do laravel estejam instaladas. Após isso, rode o comando abaixo para instalar as migrações e os seeds:

```sh
docker-compose exec api-cache php artisan migrate
``` 

- Após rodar o comando acima, o sistema já estará pronto e acessível em [http://localhost:8989](http://localhost:8989).  

- Para rodar e testar os endpoints, use o Postman ou Insomnia.

Desenvolvido por Thiago Luna: [Linkedin!](https://www.linkedin.com/in/thiago-luna/)
