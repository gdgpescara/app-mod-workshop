# Workshop: Application Modernization in GCP

Codebase for the workshop ["Application Modernization in GCP"](https://codelabs.developers.google.com/codelabs/app-mod-workshop).

This basic code (written in **PHP 5.6**) will be used as base project for a [workshop](https://codelabs.developers.google.com/codelabs/app-mod-workshop). 

*Important*: this is NSFW (Not Suitable For Work) and it should not be used in a production environment. The code might contain security issues and is not optimized for a Cloud environment. It is based on PHP5 and MySQL.


# Database initialization

You can initialize the database using the scripts in `db/`. `01_schema.sql` will create the database schema, `02_seed.sql` will populate the database with example data. It will insert 3 users:

* an Admin user, with `admin` as username and `admin123` as password;
* a normal User, with `user1` as username and `user123` as password;
* an other normal User, with `user2` as username and `user123` as password.

The database will also be populated with some images, that are already delivered with the application.

# Basic configuration

To configure the project:

* update `config.php` to reflect the parameters that will be used to connect to the MySQL db;
* make `/uploads` directory writable.
