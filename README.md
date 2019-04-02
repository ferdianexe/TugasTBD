# TugasTBD
Tugas TBD Judulnya masih TBD juga

#Installasi
## About Laravel default project

Laravel 5.4 default project without predefined assets, views nor routes.

**Step 1**: clone the project with git

```sh
$ git clone https://github.com/ferdianexe/TugasTBD.git
```

**Step 2**: go into the `TugasTBD` folder and run composer
```sh
$ cd TugasTBD
$ composer install
```

**Step 2.1**: if you want to get the last vendor versions, run composer update
```sh
$ composer update
```

**Step 3**: install node modules with [yarn](https://yarnpkg.com/) or npm
```sh
# with yarn
$ yarn
# with npm 
$ npm install
```

**Step 3.1**: if you want to upgrade to the last module versions, do it with yarn or npm
```sh
# with yarn
$ yarn upgrade
# with npm 
$ npm update
```

**Step 4.1**: if this your first time clone you must set the database , username and drivers database in .env
by default there's given .env.example copy that file and rename it to .env then change 'DB_DATABASE' , 'DB_USERNAME','DB_PASSWORD','DB_CONNECTION'


**Step 4.2**: then run the migration first, it will make all the databases that needed for you project run once only after you cloning this
```sh
# create all database
$ php artisan migrate
```

**Step 5**: if theres nothing to do anymore you can run project
```sh
# start project 
$ php artisan serve
```
