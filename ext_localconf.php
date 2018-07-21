<?php
/**
 * General ext_localconf file and also an example for your own extension
 */
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

$signalSlotDispatcher = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Extbase\SignalSlot\Dispatcher::class);
$signalSlotDispatcher->connect(
    \Metaseo\Metaseo\Page\Part\MetatagPart::class,  // Signal class name
    'metatagOutput',                                // Signal name
    \RGU\MetaseoVhs\Signals\MetaseoExtend::class, // Slot class name
    'metatagOutput'                                 // Slot name
);
