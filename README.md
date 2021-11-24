# Stage Lms 2021

#### Для запуска проекта, требуется выполнить следующие шаги:
- git clone https://git.devspark.ru/m_kultyshev/stage-lms-2021.git
- composer install
- переименовать файл .env.example в .env и произвести необходимые настройки

Настройки почтового сервера:
```
MAIL_MAILER=smtp
MAIL_HOST=smtp.googlemail.com
MAIL_PORT=465
MAIL_USERNAME=lms.laravel
MAIL_PASSWORD=GGYxEjLjRr9JL9v
MAIL_ENCRYPTION=ssl
MAIL_FROM_ADDRESS=lms.laravel@gmail.com
MAIL_FROM_NAME="${APP_NAME}"
```

#### Создание новой миграции
php artisan make:migration create_flights_table
#### Запуск миграций
php artisan migrate
#### Откат произвольного числа миграций
php artisan migrate:rollback --step=5
#### Создание сидера
php artisan make:seeder UserSeeder
#### Запуск сидера
php artisan db:seed --class=UserSeeder
### Видео Плеер
Используется Video.js

[Полная документация Video.js](/node_modules/video.js/README.md)

### Wysiwyg
Используется TinyMCE

У всех элементов textarea, где его необходимо реализовать, в качестве id указать basic-wysiwyg

[Полная документация TinyMCE](/wysiwyg.md)

