<?php

/**
 * @copyright Copyright (C) Flutchman. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
namespace Flutchman\EzMigrationUiBundle\Behat\PageObject;

use EzSystems\EzPlatformAdminUi\Behat\PageObject\Page;

class LoginPage extends Page
{
    /** @var string Route under which the Page is available */
    protected $route = '/admin/login';

    /** @var string Name by which Page is recognised */
    public const PAGE_NAME = 'Authent';

    protected $fields = [
        'username' => '#username',
        'password' => '#password',
    ];

    /**
     * Performs login action.
     *
     * @param string $username
     * @param string $password
     */
    public function login(string $username, string $password): void
    {
        $this->fillUsername($username);
        $this->fillPassword($password);
        $this->clickLogin();
    }

    public function verifyTitle(): void
    {
        //Login page has no title, so we don't want to check it
    }

    /**
     * Clicks login button.
     */
    protected function clickLogin(): void
    {
        $this->context->getSession()->getPage()->findButton('Login')->click();
    }

    /**
     * Fills username field.
     *
     * @param string $username
     */
    protected function fillUsername(string $username): void
    {
        $this->context->findElement($this->fields['username'], $this->defaultTimeout)->setValue($username);
    }

    /**
     * Fills password field.
     *
     * @param string $password
     */
    protected function fillPassword(string $password): void
    {
        $this->context->findElement($this->fields['password'], $this->defaultTimeout)->setValue($password);
    }

    /**
     * Verifies that username and password fields are available.
     */
    public function verifyElements(): void
    {
        $this->context->waitUntilElementIsVisible($this->fields['username']);
        $this->context->waitUntilElementIsVisible($this->fields['password']);

        $this->context->waitUntil(5, function () {
            return '' == $this->context->findElement($this->fields['password'], $this->defaultTimeout)->getValue();
        });
    }
}
