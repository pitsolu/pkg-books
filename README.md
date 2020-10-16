Strukt Books
===

## Getting Started

Project `strukt/pkg-books` is a `strukt` module for accountancy.

### Prerequisite

Install `strukt/strukt` and generate application also use commands below:

```sh
composer create-project strukt/strukt:dev-master --prefer-dist
console generate:app yourappname
```

### Installation

```sh
composer require strukt/pkg-books
composer publish:package pkg-do
composer publish:package pkg-books
console generate:loader
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
