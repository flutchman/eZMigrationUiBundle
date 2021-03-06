<?php

/**
 * @copyright Copyright (C) Flutchman. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
namespace Flutchman\EzMigrationUiBundle\Behat\PageObject;

use EzSystems\EzPlatformAdminUi\Behat\Helper\UtilityContext;
use EzSystems\EzPlatformAdminUi\Behat\PageElement\AdminList;
use Flutchman\EzMigrationUiBundle\Behat\PageElement\ElementFactory;
use EzSystems\EzPlatformAdminUi\Behat\PageElement\Tables\SimpleTable;
use EzSystems\EzPlatformAdminUi\Behat\PageObject\Page;
use Flutchman\EzMigrationUiBundle\Behat\PageElement\Tables\MigrationStateTable;
use PHPUnit\Framework\Assert;

/**
 * Class MigrationStatePage.
 */
class MigrationStatePage extends Page
{
    public const PAGE_NAME = 'Migration State';

    /**
     * @var AdminList[]
     */
    public $adminLists;

    /**
     * @var MigrationStateTable
     */
    public $migrationStateTable;

    /**
     * MigrationStatePage constructor.
     *
     * @param UtilityContext $context
     */
    public function __construct(UtilityContext $context)
    {
        parent::__construct($context);
        $this->adminLists['Migration list'] = ElementFactory::createElement($this->context, AdminList::ELEMENT_NAME, 'Migration list', SimpleTable::ELEMENT_NAME, '.ez-main-container');
        $this->migrationStateTable = ElementFactory::createElement($context, MigrationStateTable::ELEMENT_NAME, '.ez-main-container .table');
        $this->route = '/admin/migration/state';
        $this->pageTitle = self::PAGE_NAME;
        $this->pageTitleLocator = '.ez-header h1';
    }

    public function verifyElements(): void
    {
        $this->adminLists['Migration list']->verifyVisibility();
    }

    /**
     * @param string $tabName
     */
    public function verifyMigrationStateTable(string $tabName): void
    {
        $this->migrationStateTable->verifyHeader($tabName);
    }

    /**
     * @param string $tableName
     * @param array $records
     */
    public function verifyMigrationStateRecords(string $tableName, array $records): void
    {
        $this->adminLists[$tableName]->verifyVisibility();
        $tableHash = $this->adminLists[$tableName]->table->getTableHash();

        foreach ($records as $desiredRecord) {
            $found = false;
            foreach ($tableHash as $actualRecord) {
                if ($desiredRecord['Name'] === $actualRecord['Name']) {
                    $found = true;
                    break;
                }
            }
            if (!$found) {
                Assert::fail(sprintf('Desired record [%s] not found in "%s" list.', $desiredRecord['Name'], $tableName));
            }
        }
    }
}
