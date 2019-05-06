<?php

/**
 * @copyright Copyright (C) Flutchman. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */

namespace Flutchman\EzMigrationUiBundle\Behat\PageElement\Tables;

use EzSystems\EzPlatformAdminUi\Behat\Helper\UtilityContext;
use PHPUnit\Framework\Assert;

class MigrationStateTable extends Table
{
    public const ELEMENT_NAME = 'Migration state Table';

    public function __construct(UtilityContext $context, $containerLocator)
    {
        parent::__construct($context, $containerLocator);
        $this->fields['listElement'] = $this->fields['list'] . ' td:nth-child(1)';
    }

    public function getTableCellValue(string $header, ?string $secondHeader = null): string
    {
        $columnPosition = $this->context->getElementPositionByText(
            $header,
            $this->fields['listElement']
        );

        return $this->getCellValue($columnPosition, 2);
    }

    public function verifyHeader(string $header): void
    {
        Assert::assertEquals(
            $header,
            $this->context->findElement($this->fields['horizontalHeaders'])->getText(),
            'Migration state table "%s" has wrong header.'
        );
    }
}
