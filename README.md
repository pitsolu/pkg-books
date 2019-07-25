Strukt Books
===

## Getting Started

Project `strukt/books` is a `strukt` module for accountancy.

### Installation

```sh
composer require strukt/books
composer exec publish-strukt-do
composer exec config-do
./console generate:app nameofyourapp
./console generate:loader
composer exec publish-strukt-books
./console~ generate:loader #note the ~
chmod +x console
```

### Database Setup: Migrations, Models & Seeders

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
./console seeder:exec all
```

### Shell

After dropping into shell do `list` and/or `help`

```sh
./console books:shell
```

Have a good one!
