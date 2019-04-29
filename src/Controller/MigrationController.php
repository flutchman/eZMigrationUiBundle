<?php

namespace Flutchman\EzMigrationUiBundle\Controller;

use eZ\Bundle\EzPublishCoreBundle\Controller;
use Symfony\Component\HttpFoundation\Request;
use Kaliop\eZMigrationBundle\API\Value\Migration;
use Symfony\Component\Translation\TranslatorInterface;

/**
 * Class MigrationController
 * @package Flutchman\EzMigrationUiBundle\Controller
 */
class MigrationController extends Controller
{
    const MSG_INFO = "info";
    const MSG_WARNING = "warning";
    const MSG_DANGER = "danger";
    /** @var TranslatorInterface */
    private $translator;

    /**
     * MigrationController constructor.
     * @param TranslatorInterface $translator
     */
    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function stateDisplayAction(Request $request)
    {
        $migrationService = $this->container->get("ez_migration_bundle.migration_service");
        $migrationList = $migrationService->getMigrations();

        /* Checking status to be more readable */
        foreach ($migrationList as $migration) {
            switch ($migration->status) {
                case Migration::STATUS_DONE:
                    $status = [
                        "type" => self::MSG_INFO,
                        "message" => $this->translator->trans("adminui.migration.messages.executed", [], "messages")
                    ];
                    break;
                case Migration::STATUS_STARTED:
                    $status = [
                        "type" => self::MSG_WARNING,
                        "message" => $this->translator->trans("adminui.migration.messages.started", [], "messages")
                    ];
                    break;
                case Migration::STATUS_TODO:
                    $status = [
                        "type" => self::MSG_DANGER,
                        "message" => $this->translator->trans("adminui.migration.messages.todo", [], "messages")
                    ];
                    break;
                case Migration::STATUS_SKIPPED:
                    $status = [
                        "type" => self::MSG_WARNING,
                        "message" => $this->translator->trans("adminui.migration.messages.skipped", [], "messages")
                    ];
                    break;
                case Migration::STATUS_PARTIALLY_DONE:
                    $status = [
                        "type" => self::MSG_WARNING,
                        "message" => $this->translator->trans("adminui.migration.messages.partial", [], "messages")
                    ];
                    break;
                case Migration::STATUS_SUSPENDED:
                    $status = [
                        "type" => self::MSG_WARNING,
                        "message" => $this->translator->trans("adminui.migration.messages.suspended", [], "messages")
                    ];
                    break;
                case Migration::STATUS_FAILED:
                    $status = [
                        "type" => self::MSG_DANGER,
                        "message" => $this->translator->trans("adminui.migration.messages.failed", [], "messages")
                    ];
                    break;
            }
            $migration->verbose = $status;
        }

        /* Sending migration list to custom view */
        return $this->render('@FlutchmanEzMigrationUi/state.html.twig', [
            'migrationList' => $migrationList->getArrayCopy(),
            'projectPath' => $this->container->getParameter("kernel.project_dir")
        ]);
    }
}
