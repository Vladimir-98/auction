##_Auction 2_
<small>_Приложение работает только с __HTTPS___</small><br>
<small>_Все запросы с фронта проверяются на наличие заголовка __X-Init-Data__ с данными __Telegram.WebApp.InitData__, без них и по прямой ссылки приложение не доступно._</small><br>
<small>_Пользователь записывается только при открытии приложения._</small><br>
---
###_Установка_
<small>_Для локальной установки изменить __nginx.conf__ на соответствующий_</small>
1. <small>_Скопировать .env-example в .env_</small>
2. <small>_Указать свои __APP_NAME, APP_URL___</small>
3. <small>_В переменных __#DOCKER__ указать настройки базы_</small>
4. ``` docker-compose build ``` 
5. ``` docker-compose up -d ```
6. ``` docker exec -it auction_php bash``` <small>_- войти в контейнер_</small>
7. ``` composer install ```
8. ``` php artisan key:generate```
9. ``` php artisan migrate```
10. ``` php artisan shield:install ```  <small>_- создание супер админа_</small>
11. ``` php artisan db:seed```


####_Кэширование конфигурационных файлов и маршрутов_<br>

<small>_Чистка конфигов и кэша системы_</small>
``` 
php artisan optimize:clear
``` 

<small>_Кэширование_</small>
```
php artisan config:cache 
php artisan route:cache 
php artisan view:cache 
```  

<small>_Если есть проблемы к доступу к storage_</small>
``` 
sudo chown -R www-data:www-data /var/www/auction/storage
sudo chown -R www-data:www-data /var/www/auction/bootstrap/cache
 ```
 ___
###_Telegram_
1. <small>_В переменных __#TELEGRAM__ добавить токен и платежные данные_</small>
2. ``` php artisan optimize:clear``` <small>_- чистит конфиги и кэш системы_</small>
3. ``` php artisa tg:set``` <small>_- устанавливает webhook_</small>

``` php artisa tg:del``` <small>_- удаляет webhook_</small>
    

<small>_Для локальной разработки раскомментировать __TELEGRAM_WEB_HOOK_URL__<br>
и указать ссылку туннеля, по типу __ngrok___</small>
___
###_OpenAPI_
<small>_Документация по командам и по работе с API находится здесь [/api/documentation](URL)_</small><br>
``` php artisan l5-swagger:generate ``` <small>_- Если нужно сгенерировать заново_</small>
___
###_Admin panel Filament_

<small>_Предоставить доступ можно двумя способами:_</small>
- <small>_Добавить пользователю роль_</small>
- <small>_При редактировании пользователя, но без роли он ничего не увидет_</small>
