<?php

if ((int)\TYPO3\CMS\Core\Utility\VersionNumberUtility::getCurrentTypo3Version() >= 12) {
  

        return[
            'gdpr' => [
                'labels' => 'LLL:EXT:gdpr_extensions_com_grm/Resources/Private/Language/locallang_mod_web.xlf',
                'iconIdentifier' => 'gdpr_extensions_com_tab',
                'navigationComponent' => '@typo3/backend/page-tree/page-tree-element',
            ],

            'grm' => [
                'parent' => 'gdpr',
                'position' => [],
                'access' => 'user,group',
                'iconIdentifier' => 'gdpr_extensions_com_grm-plugin-gdprgoogle_reviewmasonry',
                'path' => '/module/grm',
                'labels' => 'LLL:EXT:gdpr_extensions_com_grm/Resources/Private/Language/locallang_gdprmanager.xlf',
                'extensionName' => 'GdprExtensionsComGrm',
                'controllerActions' => [
                    \GdprExtensionsCom\GdprExtensionsComGrm\Controller\GdprManagerController::class => [
                        'list',
                        'index',
                        'show',
                        'new',
                        'create',
                        'edit',
                        'update',
                        'delete',
                        'uploadImage',
                        'manage'
                    ],
                ],
            ]
        ];

    }


