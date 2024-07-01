<?php
defined('TYPO3') || die();

(static function() {
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'GdprExtensionsComGrm',
        'gdprgoogle_reviewmasonry',
        [
            \GdprExtensionsCom\GdprExtensionsComGrm\Controller\GdprGoogleReviewmasonryController::class => 'index , showReviews'
        ],
        // non-cacheable actions
        [
            \GdprExtensionsCom\GdprExtensionsComGrm\Controller\GdprGoogleReviewmasonryController::class => 'showReviews',
            \GdprExtensionsCom\GdprExtensionsComGrm\Controller\GdprManagerController::class => 'create, update, delete'
        ],
        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT
    );

    // register plugin for cookie widget
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'GdprExtensionsComGrm',
        'gdprcookiewidget',
        [
            \GdprExtensionsCom\GdprExtensionsComGrm\Controller\GdprCookieWidgetController::class => 'index'
        ],
        // non-cacheable actions
        [],
    );

      // wizards
      \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
        'mod.wizards.newContentElement.wizardItems {
               gdpr.header = LLL:EXT:gdpr_extensions_com_grm/Resources/Private/Language/locallang_db.xlf:tx_gdpr_extensions_com_grm_gdprgoogle_reviewslider.name.tab
        }'
    );

    // wizards
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
        'mod {
            wizards.newContentElement.wizardItems.plugins {
                elements {
                    gdprcookiewidget {
                        iconIdentifier = gdpr_extensions_com_grm-plugin-gdprgoogle_reviewslider
                        title = cookie
                        description = LLL:EXT:gdpr_extensions_com_grm/Resources/Private/Language/locallang_db.xlf:tx_gdpr_two_x_greview_masonry_gdprgoogle_reviewslider.description
                        tt_content_defValues {
                            CType = list
                            list_type = gdprtwoxgreviewmasonry_gdprcookiewidget
                        }
                    }
                }
                show = *
            }
       }'
    );
    // wizards
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
        'mod {
            wizards.newContentElement.wizardItems.gdpr {
                elements {
                    gdprgoogle_reviewmasonry {
                        iconIdentifier = gdpr_extensions_com_grm-plugin-gdprgoogle_reviewmasonry
                        title = LLL:EXT:gdpr_extensions_com_grm/Resources/Private/Language/locallang_db.xlf:tx_gdpr_two_x_greview_masonry_gdprgoogle_reviewslider.name
                        description = LLL:EXT:gdpr_extensions_com_grm/Resources/Private/Language/locallang_db.xlf:tx_gdpr_two_x_greview_masonry_gdprgoogle_reviewslider.description
                        tt_content_defValues {
                            CType = gdprextensionscomgrm_gdprgoogle_reviewmasonry
                        }
                    }
                }
                show = *
            }
       }'
    );
    $registeredTasks = $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['scheduler']['tasks'];

    $alreadyRegistered = 0;
    foreach($registeredTasks as $registeredTask){

        if(
            isset($registeredTask['extension']) &&
            (strpos($registeredTask['extension'], 'Googlereview') || strpos($registeredTask['extension'], 'greview')) !== false &&
            strpos($registeredTask['extension'], 'Header') === false
        ) {
            $alreadyRegistered += 1;
        }

    }

    if(!$alreadyRegistered){
        $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['scheduler']['tasks'][\GdprExtensionsCom\GdprExtensionsComGrm\Commands\SyncReviewsTask::class] = [
            'extension' => 'GdprExtensionsComGrm',
            'title' => 'Sync gdpr reviews',
            'description' => 'Sync gdpr reviews',
            'additionalFields' => \GdprExtensionsCom\GdprExtensionsComGrm\Commands\SyncReviewsTask::class,
        ];
    }
})();

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processDatamapClass'][] = \GdprExtensionsCom\GdprExtensionsComGrm\Hooks\DataHandlerHook::class;
if (!isset($GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['GdprExtensionsComGrm'])) {
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['GdprExtensionsComGrm'] = [
        'frontend' => \TYPO3\CMS\Core\Cache\Frontend\VariableFrontend::class,
        'backend' => \TYPO3\CMS\Core\Cache\Backend\FileBackend::class,
        'groups' => ['all', 'GdprExtensionsComGrm'],
        'options' => [
            'defaultLifetime' => 3600, // Cache lifetime in seconds
        ],
    ];
}

