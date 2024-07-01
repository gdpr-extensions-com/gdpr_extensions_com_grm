<?php
defined('TYPO3') || die();

$frontendLanguageFilePrefix = 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:';
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'GdprExtensionsComGrm',
    'gdprgoogle_reviewmasonry',
    'Google Reviews Masonry'
);

$fields = [
    'gdpr_button_shape_masonry' => [
        'onChange' => 'reload',
        'config' => [
            'type' => 'select',
            'renderType' => 'selectSingle',
            'items' => [
                ['Round', '1'],
                ['Square', '2'],
            ],
            'default' =>  '1'
        ],
    ],

    // 'gdpr_business_locations_masonry' => [
    //     'config' => [
    //         'type' => 'select',
    //         'renderType' => 'selectMultipleSideBySide',
    //         'itemsProcFunc' => 'GdprExtensionsCom\GdprExtensionsComGrm\Utility\ProcessMasonryItems->getLocationsforRoodPid',
    //     ],
    // ],

    'gdpr_background_color_masonry' => [
        'config' => [
            'type' => 'input',
            'renderType' => 'colorpicker',
        ],
    ],
    'gdpr_color_of_text_masonry' => [
        'config' => [
            'type' => 'input',
            'renderType' => 'colorpicker',
        ],
    ],
    'gdpr_button_color_masonry' => [
        'config' => [
            'type' => 'input',
            'renderType' => 'colorpicker',
        ],
    ],
    'gdpr_button_text_color_masonry' => [
        'config' => [
            'type' => 'input',
            'renderType' => 'colorpicker',
        ],
    ],

    'gdpr_total_color_of_text_masonry' => [
        'config' => [
            'type' => 'input',
            'renderType' => 'colorpicker',
        ],
    ],
    'tx_gdprreviewsclient_slider_max_reviews_masonry' => [
        'displayCond' => 'FIELD:gdpr_show_all_reviews_masonry:=:0',
        'config' => [
            'type' => 'input',
            'size' => 10,
            'eval' => 'trim,int',
            'range' => [
                'lower' => 1,
                'upper' => 100,
            ],
            'default' => 4,
            'slider' => [
                'step' => 1,
                'width' => 200,
            ],
        ],
    ],

    'gdpr_show_all_reviews_masonry' => [
        'onChange' => 'reload',
        'config' => [
            'type' => 'check',
            'renderType' => 'checkboxToggle',
            'items' => [
                [
                    0 => '',
                    1 => '',
                ],
            ],
        ],
    ],
];
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tt_content', $fields);

$GLOBALS['TCA']['tt_content']['types']['gdprextensionscomgrm_gdprgoogle_reviewmasonry'] = [
    'showitem' => '
                --palette--;' . $frontendLanguageFilePrefix . 'palette.general;general,
                gdpr_color_of_text_masonry; Text Color,
                gdpr_background_color_masonry; Background Color,
                gdpr_button_color_masonry ; Button Background Color,
                gdpr_button_text_color_masonry ; Button Text Color,
                tx_gdprreviewsclient_slider_max_reviews_masonry; Max. number of reviews,
                gdpr_show_all_reviews_masonry; Show All Reviews,
                gdpr_button_shape_masonry ; Button Shape,

                --div--;' . $frontendLanguageFilePrefix . 'tabs.appearance,
                --palette--;' . $frontendLanguageFilePrefix . 'palette.frames;frames,
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language,
                --palette--;;language,
                --div--;' . $frontendLanguageFilePrefix . 'tabs.access,
                hidden;' . $frontendLanguageFilePrefix . 'field.default.hidden,
                --palette--;' . $frontendLanguageFilePrefix . 'palette.access;access,
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:notes,
        ',
];
