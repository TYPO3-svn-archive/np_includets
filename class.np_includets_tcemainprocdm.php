<?php

class tx_myextension_tcemainprocdm {
	function processDatamap_preProcessFieldArray (&$incomingFieldArray, $table, $id, &$reference) {
		if ($table != 'sys_template') {
			return;
		}
		// Setup Field
		if (strlen($incomingFieldArray['config'])) {
			$incomingFieldArray['config'] = $this->exportIncludedTyposcript($incomingFieldArray['config']);
		}
		// Constants Field
		if (strlen($incomingFieldArray['constants'])) {
			$incomingFieldArray['constants'] = $this->exportIncludedTyposcript($incomingFieldArray['constants']);
		}
	}

	function exportIncludedTyposcript($content)	{
		$pattern = '/### <INCLUDE_TYPOSCRIPT:\s*source\s*=\s*"FILE:\s*(?P<filename>[^"]*)">\s*BEGIN:\r?\n(?P<content>(?:.|\n)*?)\r?\n?### <INCLUDE_TYPOSCRIPT:\s*source\s*=\s*"FILE:\s*(?:[^"]*)">\s*END:\r?\n?/';

		$matches = array();
		preg_match_all($pattern, $content, $matches);

		for ($i=0; $i<count($matches['filename']); $i++) {
			$this->saveTyposcript($matches['filename'][$i], $matches['content'][$i]);
		}

		$content = preg_replace($pattern, '<INCLUDE_TYPOSCRIPT: source="FILE: $1">', $content);

		return $content;
	}

	function saveTyposcript($filename, $content) {
		$filenameAbsolute = t3lib_div::getFileAbsFileName($filename);

		t3lib_div::writeFile($filenameAbsolute, $content);
	}
}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/np_includets/class.np_includets_tcemainprocdm.php']) {
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/np_includets/class.np_includets_tcemainprocdm.php']);
}
?>