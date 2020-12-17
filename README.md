REST API for the project CRM_OSBB 

Technologies used: PHP 7.4, Laravel 7.29, MySQL 5.7, Nginx, Docker

Launch instruction:
- Clone project from Github repository
- If you still don't have docker installed on your local machine, follow **[this instruction](https://www.digitalocean.com/community/tutorials/docker-ubuntu-18-04-1-ru)** or whatever
- Go to **.dockerSettings/nginx/conf.d/default.conf** and check **server_name** param
- Edit **/etc/hosts** file and add **server_name** host from previous step (you can use command **nano /etc/hosts**)
- Run **docker-compose build** command to build docker environment
- Run **docker-compose up -d** command to bring up all containers
- Create database for the project (you can go to http://your-local-server:8183 to get phpmyadmin)
- Create .env file in root directory (or copy and rename **.env.example** file) and fill it with your database connection (default DB connection listed below)
- Go into fpm container with **docker exec -it your_project_name_fpm_1 bash** (for example: crm_osbb_api_fpm_1)
- Switch to container project directory **cd ../../../usr/share/nginx/html**
- Ensure you are in project directory (**ls -l** command will show listing of directories and files and it should be the same as project files in project's directory on your local machine)
- Create composer.phar file using command **curl -sS https://getcomposer.org/installer | php 
                                             sudo mv composer.phar /usr/bin/composer**
- Install project dependencies by typing **php composer.phar install** command
- Run **php artisan key:generate** to set application key
- Run migrations and seeds with **php artisan migrate --seed**
- Go to server_name (from 4-th step)
- If some error occured, go to your teammate with cookies
- Have fun!

Default docker database credentials:
- Host: mysql,
- Username: root
- Pass: admin
- Port (if connect to 127.0.0.1): 3308, otherwise 3306
