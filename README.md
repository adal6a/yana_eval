# Yana Eval

## **Requirements**

- Docker >= 20
- docker-compose >= 3.8

## **Environment file**

````
MYSQL_HOST=database
MYSQL_DATABASE=yana
MYSQL_USER=yana
MYSQL_PASSWORD=yana
````

## **Run Application**

- Run the following command to start the application:

```bash
docker-compose up -d --build
```

```bash
docker-compose exec -it php bash
```

```bash
cp .env.example .env
```

```bash
cd application

composer install
```
