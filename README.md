# Assignment for studies at Business College Helsinki

This is an assignment for studies at Helsinki Business Gollege and is supposed to be only for studying purposes.

# About the project

Goal is to make a simple guestbook style application to show and store a little greeting made by the user. No login required in this application. Removing items will be done from database side like PhpMyAdmin.

# Install the project

Clone, download or fork project and run MySQL database at docker. For example use Symfony-MAMP provided at https://github.com/kalwar/Symfony-MAMP for Mac. Make sure the database is running at port 3308 or modify the port in the .env file.

You also may modify .env file and use your own configuration for MySQL database connection.

```shell
composer require
```

# Running the project

```shell
symfony serve -d
```

Open your browser and go to symfony dev server address, default http://127.0.0.1:8000/
