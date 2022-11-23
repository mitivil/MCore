# MCore
Micro-framework на кодовом языке PHP , по классической структуре MVC, имеет минимальный функционал и обеспечивает максимальную скорость работы.
Подходит для быстрой развёртки небольших проектов и тестирования.

* Инструкция на стадии доработки ! 

##### Требования
- PHP 7.4
- Composer
- Стандарты PSR-4
- MySql
- Apache, nginx

##### Конфигурация для Apache
  Переименовать файл в корне проекта **hta.ccess**  на  **.htaccess** для правильной маршрутизации.

##### Конфигурация для Nginx
```
server {
        listen 80;
        server_name     name_site.ru; # доменное имя, относящиеся к текущему виртуальному хосту
        charset utf-8;
        root  /www/public/name_site/; # каталог в котором лежит проект, путь к точке входа
        
        index index.php index.html;
        # add_header Access-Control-Allow-Origin *;

        # serve static files directly
        location ~* \.(jpg|jpeg|gif|css|png|js|ico|html)$ {
                access_log off;
                expires max;
                log_not_found off;
        }

        location ~* \.php$ {
        try_files $uri = 404;
        include fastcgi_params;        
        fastcgi_split_path_info ^(.+\.php)(/.+)$;
        fastcgi_pass unix:/var/run/php/php7.4-fpm.sock; # подключаем сокет php-fpm
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    }
    location ~ /\.ht {
                deny all;
    }
    location / {
                # add_header Access-Control-Allow-Origin *;
                # try_files $uri $uri/ /index.php?$query_string;
               try_files   $uri $uri/ /index.php;
    }
}
```



