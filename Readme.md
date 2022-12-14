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


##### Меню
<ul dir="auto">
<li><a href="#kitStart">Быстрый старт</a></li>
<li><a href="#filesStructure">Файловая структура</a></li>
<li><a href="#configApacheNginx">Конфигурация для Apache, Nginx</a></li>
<li><a href="#rout">Работа с маршрутизацией</a></li>
<li><a href="#logic">Работа с контролёром и моделью</a></li>
<li><a href="#view">Работа с шаблонами "View"</a></li>
</ul>



<a id="kitStart"></a>
##### Быстрый старт
 - Скачать все файлы проекта
 - Установить composer и выполнить команду в директории проекта: ```composer install```
 - Ознакомится и настроить конфиг-файл: ```config.php```




<a id="rout"></a>
##### Работа с маршрутизацией
По умолчанию маршрутизатор настроен в режиме ```AUTO``` <br>
Переключать режим маршрутизации проекта следует в файле  ```System\configSys.php```
```
├─ Router\     "Все файлы с маршрутизациями проекта находятся здесь"
```
В Маршрутизаторе проекта имеется 3 режима
 - CNC   
    + стандартный ЧПУ режим, пример запроса: ```www.mysite.ru/home``` в таком случае маршрутизатор ядра обратиться к контроллеру по пути ```Logic\Controller\home.php```  
 - ROUTE
   + Режим только указаны маршрут, в таком случае маршрутизатор ядра осуществит поиск маршрута по всем файлам ```.php```  в каталоге ``` Router\ ``` при нахождении обратиться в указаны контроллер. 
 - AUTO
   + Режим автоматической маршрутизации, в таком случае маршрутизатор ядра осуществит поиск в режиме ```ROUTE```  если маршрут был не найден, тогда производится поиск маршрута в режиме ```CNC```

 



<a id="filesStructure"></a>
##### Файловая структура
```
├─ Logic\                    
│     ├─ Controller\   "Контролёры проекта"           
│     └─ Model\        "Модели проекта"                
│                           
├─ Resource\           "Ресурсы проекта, картинки, документы и тп.."                   
│                         
├─ Router\             "Маршрутизация проекта, можно переключиться на ЧПУ В config.php" 
│     └ Base.php       "Файл маршрутизации, *Добавляйте свои файлы маршрутизации*"
│
├─ System\             "Системные файлы проекта, *Ядро, загрузчик, логгер, отладчик*"
│
├─ View\               "Каталог для показа сайта *HTML,CSS,JS* и тп..."
│     ├ 404.php        "При отсутствие маршрута обращается в файл"
│     ├ error.php      "При возникновение ошибок обращается в файл"
│     └ index.php      "Стартовый файл отдела View"
│
├─ .gitignore          "Игнорировать файлы проекта в Git"
├─ composer.json       
├─ config.php          "Конфигурационный файл с настройками *Проекта*"
├─ hta.ccess           "Подготовительный файл конфигурации для apache"
├─ index.php           "Стартующий файл проекта *Единая точка входа*"
```



<a id="configApacheNginx"></a>
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


