<?php

if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

$TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['t3lib/class.t3lib_tsparser_ext.php'] = t3lib_extMgm::extPath('np_includets').'class.ux_t3lib_tsparser_ext.php';

$TYPO3_CONF_VARS['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processDatamapClass'][] = 'EXT:np_includets/class.np_includets_tcemainprocdm.php:tx_myextension_tcemainprocdm';
?>