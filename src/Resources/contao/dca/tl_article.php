<?php

use \ContaoCommunityAlliance\MetaPalettes\MetaPalettes;

/**
 * Palettes
 */
MetaPalettes::appendFields(
    'tl_article',
    'default',
    'publish',
    [
        'articleConditionParameter',
        'articleConditionInvert',
    ]
);

/**
 * Fields
 */
$GLOBALS['TL_DCA']['tl_article']['fields']['articleConditionParameter'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_article']['articleConditionParameter'],
    'exclude' => true,
    'inputType' => 'text',
    'eval' => ['tl_class' => 'clr w50'],
    'sql' => ['type' => 'string', 'length' => 50, 'default' => ''],
];

$GLOBALS['TL_DCA']['tl_article']['fields']['articleConditionInvert'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_article']['articleConditionInvert'],
    'exclude' => true,
    'inputType' => 'checkbox',
    'eval' => ['tl_class' => 'w50 m12'],
    'sql' => ['type' => 'string', 'length' => 1, 'default' => ''],
];
