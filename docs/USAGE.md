# eZMigrationUiBundle Usage

## Use eZ Platform Admin Ui

In your Back Office (or Admin Ui) interface, below `Admin` you should find a new tab called `Migration state`.

For example, in an ezplatform-demo instance the access should look like:
[http://127.0.0.1:8000/admin/migration/state](http://127.0.0.1:8000/admin/migration/state)

## What it does

- Display registered project migrations
- Display migrations locations (hover)
- Display current status
- Display migration's latest execution date

## Tests

This bundle offers a behat test scenario dedicated to this interface.
To run it, please refer the suites in your `behat.yml` import scope and then run `./bin/.travis/get_behat_features.sh -p adminui -s migration | bin/fastest -o -v "bin/behat {} --profile=adminui --suite=migration --no-interaction -vv --strict"`

Note: This test will succeed from the moment you will have run at least one migration
