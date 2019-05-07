<?php

/**
 * @copyright Copyright (C) Flutchman. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
namespace Flutchman\EzMigrationUiBundle\Behat\BusinessContext;

use Behat\Behat\Context\Context;
use Behat\Behat\Hook\Scope\BeforeScenarioScope;
use EzSystems\EzPlatformAdminUi\Behat\Helper\UtilityContext;

/**
 * Class BusinessContext
 */
abstract class BusinessContext implements Context
{
    /** @var UtilityContext */
    protected $utilityContext;

    /** @BeforeScenario
     * @param BeforeScenarioScope $scope Behat scope
     */
    public function getUtilityContext(BeforeScenarioScope $scope): void
    {
        $environment = $scope->getEnvironment();
        $this->utilityContext = $environment->getContext(UtilityContext::class);
    }
}
