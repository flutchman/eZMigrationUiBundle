<?php

/**
 * @copyright Copyright (C) Flutchman. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
namespace Flutchman\EzMigrationUiBundle\Behat\PageElement\Tables;

use EzSystems\EzPlatformAdminUi\Behat\Helper\UtilityContext;
use EzSystems\EzPlatformAdminUi\Behat\PageElement\Tables\Table;
use PHPUnit\Framework\Assert;

/**
 * Class MigrationStateTable.
 */
class MigrationStateTable extends Table
{
    public const ELEMENT_NAME = 'Migration state Table';

    /**
     * MigrationStateTable constructor.
     *
     * @param UtilityContext $context
     * @param $containerLocator
     */
    public function __construct(UtilityContext $context, $containerLocator)
    {
        parent::__construct($context, $containerLocator);
        $this->fields['listElement'] = $this->fields['list'] . ' td:nth-child(1)';
    }

    /**
     * @param string $header
     * @param string|null $secondHeader
     *
     * @return string
     */
    public function getTableCellValue(string $header, ?string $secondHeader = null): string
    {
        $columnPosition = $this->context->getElementPositionByText(
            $header,
            $this->fields['listElement']
        );

        return $this->getCellValue($columnPosition, 2);
    }

    /**
     * @param string $header
     */
    public function verifyHeader(string $header): void
    {
        Assert::assertEquals(
            $header,
            $this->context->findElement($this->fields['horizontalHeaders'])->getText(),
            'Migration state table "%s" has wrong header.'
        );
    }
}
