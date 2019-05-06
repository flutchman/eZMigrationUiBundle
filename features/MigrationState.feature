Feature: Migration state verification
  As an administrator
  In order to customize my eZ installation
  I want to have access to all Migration State.

  Background:
    Given I am logged as "admin"

  @javascript @common
  Scenario: Check Information
    When I go to "Migration state" in "Admin" tab
    Then I see "Migration List" table with given records
        | Name                                    |
        | 20100101000200_MigrateV1ToV2.php	      |
