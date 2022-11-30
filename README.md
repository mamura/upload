Para rodar esse projerto deve ser necessário ter instalado previamente o Docker e o Docker Compose:
- [Get Docker](https://docs.docker.com/get-docker/)
- [Install Docker Compose](https://docs.docker.com/compose/install/)

## Criando a dev network
Para permitir que nossos contâineres se comuniquem, precisamos criar uma rede compartilhada, então, execute o comando abaixo:

```bash
docker network create dev-network
```

Utilizei como imagem Docker uma imagem personalizada que contém Nginx e php-fpm como serviços. O Dockerfile dessa imagem está disponível em meu [Github](https://github.com/mamura)

Uso também uma stack de desenvolvimento que cria uma camada de rede com DNS e Proxy para facilitar a alocação de portas e possibilitar ter vários projetos sem muitas configurações. Ela não é necessária nesse projeto, mas há uma referência a ela no arquivo docker-compose.yml. Ela também está disponível em meu [Github](https://github.com/mamura/phpStack)

## Executando a aplicação
Para executar o projeto execute os seguintes comandos:

```bash
docker-compose up -d
docker-compose exec app composer install
```
Com isso o container Docker é criado e instalado as dependências do projeto.