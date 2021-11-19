# Stage Lms 2021

#### Для запуска проекта, требуется выполнить следующие шаги:
- git clone https://git.devspark.ru/m_kultyshev/stage-lms-2021.git
- composer install
- переименовать файл .env.example в .env и произвести необходимые настройки

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
