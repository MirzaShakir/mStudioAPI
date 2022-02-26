<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="100px">
    </a>
    <h1 align="center">Yii2 - Basic Application</h1>
    <br>
</p>

This is the basic Yii application which is used for Demonstrating the Coaches APIs.

There are two basic APIs to view availabilities of Coaches

DIRECTORY STRUCTURE
-------------------

      assets/                 contains assets definition
      commands/               contains console commands (controllers)
      config/                 contains application configurations
      controllers/            contains Web controller classes
        CoachesController   
      mail/                   contains view files for e-mails
      models/                 contains model classes
      runtime/                contains files generated during runtime
      tests/                  contains various tests for the basic application
      vendor/                 contains dependent 3rd-party packages
      views/                  contains view files for the Web application
      web/                    contains the entry script and Web resources



REQUIREMENTS
------------

The application is built on below Platform
~~~
Windows: 10
Php: 7.2.14
Mysql: 5.7.24
Apache: 2.4.37 
~~~


INSTALLATION
------------

### Install via Composer

If you do not have [Composer](http://getcomposer.org/), you may install it by following the instructions
at [getcomposer.org](http://getcomposer.org/doc/00-intro.md#installation-nix).

You can then install this project template using the following command:

~~~
composer create-project --prefer-dist MirzaShakir/mStudioAPI basic
~~~

Now you should be able to access the application through the following URL, assuming `basic` is the directory
directly under the Web root.

CONFIGURATION
-------------

### Database

Edit the file `config/db.php` with real data, for example:

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=rStudios',
    'username' => 'root',
    'password' => 'root',
    'charset' => 'utf8',
];
```

**NOTES:**
- Yii won't create the database for you, this has to be done manually before you can access it.
- Check and edit the other files in the `config/` directory to customize your application as required.
- Refer to the README in the `tests` directory for information specific to basic application tests.


### APIs to support

There are default two APIs <br/>
1. `http://localhost/mStudioAPI/web/coaches/get-coaches` to List all the coaches <br/>    
2. `http://localhost/mStudioAPI/web/coaches/get-coach-details` will show all available time slots <br/>
    Input: `coachName`: Name of the coach
    Input: `timezone` : The timezone where you want to see the slots
Note: By default the timezone will be `Asia/Kolkata`
