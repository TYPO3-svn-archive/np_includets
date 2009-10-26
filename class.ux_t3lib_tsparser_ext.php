<?php

class ux_t3lib_tsparser_ext extends t3lib_tsparser_ext {

	function ext_getFirstTemplate($id,$template_uid=0)		{

		$row = t3lib_tsparser_ext::ext_getFirstTemplate($id, $template_uid);

		if (is_array($row)) {
			$row['config'] = t3lib_TSparser::checkIncludeLines($row['config']);
			$row['constants'] = t3lib_TSparser::checkIncludeLines($row['constants']);
		}
		return $row;
	}

}

?>