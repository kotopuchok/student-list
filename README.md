# Список студентов

Приложение регистрации студентов, написанное на языке PHP без использования фреймворков.

## Требования к установке

- PHP 8.0+
- Apache 2.4, в котором DocumentRoot виртуального хоста настроен на каталог /public
- MySQL 8.0+

## Установка

Перейдите в папку, в которую хотите поместить проект. Клонируйте репозиторий в нее:

```sh
  $ git clone https://github.com/kotopuchok/student-list.git
```

Создайте виртуальный хост для этого проекта. Пропишите в его конфиг следующее:

```apacheconf
<VirtualHost *:80>
    DocumentRoot "/path/to/student-list/public"
    ServerName students.com
</VirtualHost>
```

Перейдите в /path/to/student-list/public и создайте файл `.htaccess`, который настройте следующим образом:

```apacheconf
AddDefaultCharset utf-8

<IfModule mod_rewrite.c>
  RewriteEngine on
  RewriteBase /
  RewriteCond %{REQUEST_FILENAME} !-f
  RewriteCond %{REQUEST_FILENAME} !-d
  RewriteRule (^.*) /index.php?$1 [QSA,L]
</IfModule>
```

Создайте базу данных и импортируйте дамп таблицы, находящийся в корне проекта.

Скопируйте содержимое файла `config.ini.example` в новый файл `config.ini`

Измените параметры в конфиге так, чтобы они соответствовали параметрам созданной вами базы данных.

## Реализованный функционал

- Просмотр списка всех зарегистрированных абитуриентов
- Сортировка по любому столбцу списка
- Поиск по любому столбцу списка
- Регистрация нового абитуриента
- Зарегистрированный абитуриент может редактировать информацию о себе

## Скриншоты

![student-list](https://user-images.githubusercontent.com/104438625/168886386-73a2cd60-43bd-4aa2-a34c-166121c9b040.png)
![student-register](https://user-images.githubusercontent.com/104438625/168886409-e661f6d4-85b1-4493-b667-9f18e59505d0.png)
![student-search](https://user-images.githubusercontent.com/104438625/168886427-4f5b5e3b-8735-47d4-b6b0-bf12292612a6.png)
![student-edit](https://user-images.githubusercontent.com/104438625/168886437-c82aeb77-7fa2-46cd-9a46-9ceb7b69df37.png)
