<?php

/**
 * @copyright Copyright (C) Flutchman. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
namespace Flutchman\EzMigrationUiBundle\EventListener;

use EzSystems\EzPlatformAdminUi\Menu\Event\ConfigureMenuEvent;
use EzSystems\EzPlatformAdminUi\Menu\MainMenuBuilder;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Class MenuListener.
 */
class MenuListener implements EventSubscriberInterface
{
    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            ConfigureMenuEvent::MAIN_MENU => ['onMenuConfigure', 0],
        ];
    }

    /**
     * @param ConfigureMenuEvent $event
     */
    public function onMenuConfigure(ConfigureMenuEvent $event)
    {
        // Getting current menu configuration
        $menu = $event->getMenu();
        $factory = $event->getFactory();
        // options passed from the context (i.e. Content item in Content View)
        $options = $event->getOptions();

        // your customizations
        // In this case: adding subitem into "Admin" menu
        $menu[MainMenuBuilder::ITEM_ADMIN]->addChild(
            'migration_list',
            [
                'label' => 'adminui.migration.menu.label',
                'route' => 'flutchman_ez_migration_ui_migration_state',
                'extras' => [
                    'icon' => 'publish',
                    'translation_domain' => 'messages',
                ],
            ]
        );
    }
}
