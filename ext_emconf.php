<?php
/**
 * $EM_CONF
 *
 * @category   Extension
 * @author     codebobbly
 */
$EM_CONF[$_EXTKEY] = [
    'title'            => 'Metaseo Fluid ViewHelpers',
    'description'      => 'Fluid ViewHelpers for Metaseo',
    'category'         => 'fe',
    'version'          => '1.0.0',
    'state'            => 'stable',
    'clearcacheonload' => 1,
    'author'           => 'codebobbly',
    'author_email'     => 'codebobbly@gmail.com',
    'constraints'      => [
        'depends' => [
            'typo3'       => '7.6.0-*',
            'metaseo' => '3.0.0-*',
        ],
    ],
];
