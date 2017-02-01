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

To run the updater go to the root directory of you project and execute

```
php vendor/spryker/code-migrator/src/index.php spryker:migrate -h
```

The `-h` option will show you how to configure and use this command.

Important options are:

- `-d` running in dry mode 
- `-p=[PROJECT_NAMESPACE]` change the project namespace
- `-n` non-interaction mode

To see what will be changed execute:

```
php vendor/spryker/code-migrator/src/index.php spryker:migrate -d -n
```

This runs the command in dry and non-interactive mode and will print out what it will do.


Run it on a project with a project namespace different to "Pyz":

```
php vendor/spryker/code-migrator/src/index.php spryker:migrate -d -n -p CatFace
```

This will then use "CatFace" as your project namespace.


Run it finally:

```
php vendor/spryker/code-migrator/src/index.php spryker:migrate
```

After doing the manually steps you should be able to run your tests, setup install and to buy something in the shop.

Please make sure that EVERYTHING goes through QA!


Known problems which cant be fixed or cant be found currently:

```
Propel\Runtime\Exception\RuntimeException - No connection defined for database "zed". Did you forget to define a connection or is it wrong written?
```

You need to add `new PropelServiceProvider(),` to `ApplicationDependencyProvider::getServiceProvider()` it is used in one place of this class and therefore not shown as missing.

----------------------------

```
Twig_Error_Syntax - Unknown "formatDateTime" filter.
```

You need to add `new DateTimeFormatterServiceProvider(),` to `ApplicationDependencyProvider::getServiceProvider()` it is used in one place of this class and therefore not shown as missing.

----------------------------


Any Twig related exception:

You need to add `new GuiTwigExtensionServiceProvider(),` to `ApplicationDependencyProvider::getServiceProvider()` it is used in one place of this class and therefore not shown as missing.

----------------------------



Translation on Zed side needs another plugin then this provided from Messenger bundle. If you don't have a MessengerDependencyProvider in your project add one add overwrite `addTranslationPlugin()` and use `Spryker\Zed\Glossary\Communication\Plugin\TranslationPlugin`


User bundle needs to get GroupPlugin from Acl bundle injected. You need to create a UserDependencyProvider and override the `addGroupPlugin()` method which then returns Acl's GroupPlugin instead of the one from User.

Cart bundle needs to get ItemCountPlugin from ProductBundle bundle injected. You need to create a CartDependencyProvider (Client) and override the `addItemCountPlugin()` method which then returns ProductBundles ItemCountPlugin instead of the one from Cart.
