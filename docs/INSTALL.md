# eZMigrationUiBundle Installation

## Requirements

* eZ Platform 2.0+
* Kaliop/eZMigrationBundle 5.0+

## Installation steps


### Use Composer

This bundle is available through Packagist.
Run the following from your prefered command line tool starting into your website root folder:

```
$ composer require flutchman/ez-migration-ui-bundle
```

### Activate the bundle

Activate the bundle in `app/AppKernel.php` file by adding it to the `$bundles` array in `registerBundles` method, together with other required bundles:

```php
public function registerBundles()
{
    ...

    new Flutchman\EzMigrationUiBundle\FlutchmanEzMigrationUiBundle()

    return $bundles;
}
```

### Edit configuration

Put the following in your `app/config/routing.yml` file to be able to display view page:

```yml
flutchman_ez_migration_ui:
    resource: "@FlutchmanEzMigrationUiBundle/Resources/config/routing.yml"
```

### Clear the caches

Clear the eZ Platform caches with the following command:

```bash
$ php bin/console cache:clear
```

### Install assets

Run the following to correctly install assets for admin UI:

```bash
$ php bin/console assets:install --symlink --relative
```

