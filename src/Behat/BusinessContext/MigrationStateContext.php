<?php

/**
 * @copyright Copyright (C) Flutchman. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
namespace Flutchman\EzMigrationUiBundle\Behat\BusinessContext;

use Behat\Gherkin\Node\TableNode;
use EzSystems\EzPlatformAdminUi\Behat\PageObject\PageObjectFactory;
use Flutchman\EzMigrationUiBundle\Behat\PageObject\MigrationStatePage;
use EzSystems\EzPlatformAdminUi\Behat\BusinessContext\BusinessContext;

/**
 * Class MigrationStateContext.
 */
class MigrationStateContext extends BusinessContext
{
    private $migrationStateTableMapping = [
        'Migration List' => 'Migration List',
    ];

    /**
     * @Then I see :tableName table with given records
     */
    public function iSeeRecordsInMigrationState(string $tableName, TableNode $records): void
    {
        $migrationStatePage = PageObjectFactory::createPage($this->utilityContext, MigrationStatePage::PAGE_NAME);
        $migrationStatePage->navLinkTabs->goToTab($this->migrationStateTableMapping[$tableName]);

        $hash = $records->getHash();
        $migrationStatePage->verifyMigrationStateRecords($tableName, $hash);
    }
}
