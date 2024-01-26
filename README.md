# Как развернуть приложение
## Поднять docker контейнеры
1. Скопировать env <br>```cp .env.template .env```
2. Отредактировать <br>```nano .env```
3. Копируем свои ssh ключи в директорию ./docker/ssh <br>
   Если под linux<br>
   ```cp ~/.ssh/id_rsa /{директория проекта}/docker/ssh/id_rsa```<br>
   ```cp ~/.ssh/id_rsa.pub /{директория проекта}/docker/ssh/id_rsa.pub```
4. Выполнить команду <br>```sudo docker-compose up -d --build```

## Поднять бекенд
1. Установить зависимости композер ```docker-compose run -u root --rm app composer i```
2. Выполнить миграции ```docker-compose run --rm app php artisan migrate```
3. Для локальной разработки необходимо скопировать файл <br>
   ```cp ./app/www/.auth.json.template ./app/www/.auth.json```<br>
4. Сделать полные права для файла ```chmod 777 ./app/www/.auth.json```
   и подставить нужные авторизационные токены.
5. Сгенерировать laravel key ```docker-compose run --rm app php artisan key:generate```
6. Установить права для хранилища ```chown -R www-data:www-data ./app/www/storage```
7. Установить символическую ссылку на хранилище ```docker-compose run --rm app php artisan storage:link```

## Поднять фронт
1. Установить зависимости ```docker-compose run --rm npm ci```
2. Собрать проект ```docker-compose run --rm npm run build```
3. Команда для watch ```docker-compose run --rm --service-ports npm run watch```


## htaccess роутер версий проекта
```
RewriteEngine On

RewriteCond %{HTTP_HOST} ^([^.]+)\.([^.]+)\.skyweb24\.ru$ [NC]
RewriteRule ^(.*)$ /%1/$1 [L]
```
