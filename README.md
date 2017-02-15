# Spryker Migrator

## Installation

You need to clone spryker/code-migrator into `vendor/spryker/code-migrator`

```
git clone git@github.com:spryker/code-migrator.git
```

After that you need to install all it's dependencies by running 

```
composer install
```

You can test it by running `vendor/bin/codecept run`


## Documentation

To run the updater go to the cloned repository and execute

```
vendor/bin/migrate spryker:migrate -h
```

The `-h` option will show you how to configure and use this command.

Important options are:

- `-d` running in dry mode 
- `-p=[PROJECT_NAMESPACE]` change the project namespace
- `-n` non-interaction mode

To see what will be changed execute:

```
vendor/bin/migrate spryker:migrate -d -n
```

This runs the command in dry and non-interactive mode and will print out what it will do.


Run it on a project with a project namespace different to "Pyz":

```
vendor/bin/migrate spryker:migrate -d -n -p CatFace
```

This will then use "CatFace" as your project namespace.


Run it finally:

```
vendor/bin/migrate spryker:migrate
```

After doing the manually steps you should be able to run your tests, setup install and to buy something in the shop.

Please make sure that EVERYTHING goes through QA!
