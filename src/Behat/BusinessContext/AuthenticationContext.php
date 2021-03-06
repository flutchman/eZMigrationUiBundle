<?php

/**
 * @copyright Copyright (C) Flutchman. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
namespace Flutchman\EzMigrationUiBundle\Behat\BusinessContext;

use Flutchman\EzMigrationUiBundle\Behat\PageObject\LoginPage;
use Flutchman\EzMigrationUiBundle\Behat\PageObject\PageObjectFactory;
use OutOfBoundsException;
use EzSystems\EzPlatformAdminUi\Behat\BusinessContext\BusinessContext;

/** Context for authentication actions */
class AuthenticationContext extends BusinessContext
{
    /** @var array Dictionary of known user logins and their passwords */
    private $userCredentials = [
        'admin' => 'publish',
        'jessica' => 'publish',
        'yura' => 'publish',
        'anil' => 'publish',
    ];

    /**
     * @Given I am logged as :username
     */
    public function iAmLoggedAs(string $username): void
    {
        $loginPage = PageObjectFactory::createPage($this->utilityContext, LoginPage::PAGE_NAME);
        $loginPage->open();

        if (!\array_key_exists($username, $this->userCredentials)) {
            throw new OutOfBoundsException('Login is not recognised');
        }

        $password = $this->userCredentials[$username];
        $loginPage->login($username, $password);
    }
}
