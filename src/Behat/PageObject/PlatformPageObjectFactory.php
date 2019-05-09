<?php

namespace Flutchman\EzMigrationUiBundle\Behat\PageObject;

use EzSystems\EzPlatformAdminUi\Behat\Helper\UtilityContext;
use EzSystems\EzPlatformAdminUi\Behat\PageObject\Page;
use EzSystems\EzPlatformAdminUi\Behat\PageObject\DashboardPage;
use EzSystems\EzPlatformAdminUi\Behat\PageObject\ContentItemPage;
use EzSystems\EzPlatformAdminUi\Behat\PageObject\ContentTypeGroupsPage;
use EzSystems\EzPlatformAdminUi\Behat\PageObject\ContentTypeGroupPage;
use EzSystems\EzPlatformAdminUi\Behat\PageObject\AdminUpdateItemPage;
use EzSystems\EzPlatformAdminUi\Behat\PageObject\ContentUpdateItemPage;
use EzSystems\EzPlatformAdminUi\Behat\PageObject\ContentTypePage;
use EzSystems\EzPlatformAdminUi\Behat\PageObject\LanguagesPage;
use EzSystems\EzPlatformAdminUi\Behat\PageObject\LanguagePage;
use EzSystems\EzPlatformAdminUi\Behat\PageObject\RolesPage;
use EzSystems\EzPlatformAdminUi\Behat\PageObject\RolePage;
use EzSystems\EzPlatformAdminUi\Behat\PageObject\SystemInfoPage;
use EzSystems\EzPlatformAdminUi\Behat\PageObject\SectionsPage;
use EzSystems\EzPlatformAdminUi\Behat\PageObject\SectionPage;
use EzSystems\EzPlatformAdminUi\Behat\PageObject\ObjectStateGroupsPage;
use EzSystems\EzPlatformAdminUi\Behat\PageObject\ObjectStateGroupPage;
use EzSystems\EzPlatformAdminUi\Behat\PageObject\ObjectStatePage;
use EzSystems\EzPlatformAdminUi\Behat\PageObject\ContentPreviewPage;
use EzSystems\EzPlatformAdminUi\Behat\PageObject\TrashPage;
use EzSystems\EzPlatformAdminUi\Behat\PageObject\FolderPreview;

class PlatformPageObjectFactory extends PageObjectFactory
{
    /**
     * @return LoginPage|TrashPage|ContentPreviewPage|ObjectStateGroupsPage|ObjectStateGroupPage|ObjectStatePage|SystemInfoPage|DashboardPage|ContentItemPage|ContentTypeGroupsPage|SectionPage|SectionsPage|ContentUpdateItemPage|AdminUpdateItemPage|ContentTypePage|LanguagesPage|LanguagePage|RolesPage|RolePage
     */
    public static function createPage(UtilityContext $context, string $pageName, ?string ...$parameters): Page
    {
        switch ($pageName) {
            case MigrationStatePage::PAGE_NAME:
                return new MigrationStatePage($context);
            case LoginPage::PAGE_NAME:
                return new LoginPage($context);
            case DashboardPage::PAGE_NAME:
                return new DashboardPage($context);
            case ContentItemPage::PAGE_NAME:
                return new ContentItemPage($context, $parameters[0]);
            case ContentTypeGroupsPage::PAGE_NAME:
                return new ContentTypeGroupsPage($context);
            case AdminUpdateItemPage::PAGE_NAME:
                return new AdminUpdateItemPage($context);
            case ContentUpdateItemPage::PAGE_NAME:
                return new ContentUpdateItemPage($context, $parameters[0]);
            case ContentTypeGroupPage::PAGE_NAME:
                return new ContentTypeGroupPage($context, $parameters[0]);
            case ContentTypePage::PAGE_NAME:
                return new ContentTypePage($context, $parameters[0]);
            case LanguagesPage::PAGE_NAME:
                return new LanguagesPage($context);
            case LanguagePage::PAGE_NAME:
                return new LanguagePage($context, $parameters[0]);
            case RolesPage::PAGE_NAME:
                return new RolesPage($context);
            case RolePage::PAGE_NAME:
                return new RolePage($context, $parameters[0]);
            case SystemInfoPage::PAGE_NAME:
                return new SystemInfoPage($context);
            case SectionsPage::PAGE_NAME:
                return new SectionsPage($context);
            case SectionPage::PAGE_NAME:
                return new SectionPage($context, $parameters[0]);
            case ObjectStateGroupsPage::PAGE_NAME:
                return new ObjectStateGroupsPage($context);
            case ObjectStateGroupPage::PAGE_NAME:
                return new ObjectStateGroupPage($context, $parameters[0]);
            case ObjectStatePage::PAGE_NAME:
                return new ObjectStatePage($context, $parameters[0]);
            case ContentPreviewPage::PAGE_NAME:
                return new ContentPreviewPage($context, $parameters[0]);
            case TrashPage::PAGE_NAME:
                return new TrashPage($context);
            case FolderPreview::PAGE_NAME:
                return new FolderPreview($context);
            default:
                throw new \InvalidArgumentException(sprintf('Unrecognised page name: %s', $pageName));
        }
    }

    public static function getPreviewType(string $contentType): string
    {
        switch ($contentType) {
            case FolderPreview::CONTENT_TYPE:
                return FolderPreview::PAGE_NAME;
            default:
                throw new \InvalidArgumentException(sprintf('Unrecognised preview for content type: %s', $contentType));
        }
    }
}
