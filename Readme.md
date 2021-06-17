<h1 align="center">Project Symfony</h1>

## Comandos

```
docker-compose up -d --build
```

### Acessar php docker
```
 docker-compose exec php /bin/bash
```

### Instalar dependencias
```
composer install
```

### Config Database acess:
(Adicionar ao .env)
DATABASE_URL="mysql://root:secret@database:3306/symfony_docker?serverVersion=8.0"
 
```
symfony console make:migration
```

```
symfony console doctrine:migrations:migrate
```

```
symfony console doctrine:migrations:execute --up 'DoctrineMigrations\Version20210617163623'
```

### Acess mysql
```
 docker-compose exec database /bin/bash
```


Molde Docker [https://www.twilio.com/blog/get-started-docker-symfony]