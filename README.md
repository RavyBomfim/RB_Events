<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

### Main Laravel commands (Principais comandos do Laravel)

#

**Command to create a Laravel project (Comando para criar um projeto Laravel):**

*composer create-project --prefer-dist laravel/laravel project_name*

#

**Command to run the server (Comando para rodar o servidor):**

*php artisan serve*

#

**Command to create controllers (Comando para criar controllers):**

*php artisan make:controller ModuleNameController*

#

**Command to create a new table in the Database (Comando para criar uma nova tabela no Banco de dados):**

*php artisan make:migration create_tableName_table*

#

**Command to add a new field to a Database table (Comando para adicionar um novo campo a uma tabela do Banco de dados):**

*php artisan make:migration add_fieldName_to_tableName_table*

#

**Command to save migrations (Comando para salvar as migrações):**

*php artisan migrate*

#

**Command to install Jetstream (Comando para instalar o Jetstream):**

*composer require laravel/jetstream*

#

**Command to install Livewire (Comando para instalar o Livewire):**

*php artisan jetstream:install livewire*

#

**Depois disso, é necessário o uso dos comandos:**

*npm install* 
*npm run dev*
*php artisan migrate*

#