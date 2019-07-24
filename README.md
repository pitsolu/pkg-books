Strukt Books
===

## Getting Started

Project `strukt/books` is a `strukt` module for accountancy.

### Prerequisite

You will require to install `strukt/strukt` via [strukt-strukt](https://github.com/pitsolu/strukt-strukt). Then install module `strukt/do` via [strukt-do](https://github.com/pitsolu/strukt-do)

### Installation

Install `strukt/books`:

```sh
composer require strukt/books
```

Setup `strukt/do` module first.

```sh
composer exec publish-strukt-do
composer exec config-do
````

Create your application.

```sh
./console generate:app payroll
./console generate:loader
```

The `generate:app` command will create your app folder with your `app/src/Payroll/AuthModule`  and
load your `app-name` into the `cfg/app.ini` file.  The `generate:loader` command will create your `lib/App/Loader.php` that is used to bootstrap your modules.


### Publish your package

```sh
composer exec publish-strukt-books
```

Now, the above publish command replaces a number of files and one of them is `console` in your
root folder to `console~` will be the old console.

You need to run the old `console~` to reload application modules. The new one will fail because 
contains new commands and the `strukt/books` module is not loaded in `lib/App/Loader.php` yet.

```sh
./console~ generate:loader
```

You can now do away with `console~` and embrace `console` by making it executable.

```sh
chmod +x console
```

### Set up database

Set up your database connection in `cfg/db.ini` , don't forget to set the correct driver.

Now run the migrations.

```sh
./console migrate:exec
```

You'll now need to generate your application models:

```sh
./console generate:models
```

If you may need to, run the seeders.

```sh
./console seeder:exec
```

### Shell

Drop into accounting shell do `list` and/or `help`

```sh
./console books:shell
```

Have a good one!
