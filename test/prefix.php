<?php
function getAbsolutePrefix($path)
{
	preg_match('{^(?P<prefix>([a-zA-Z]+:)?\/\/?)}', $path, $matches);

	if (empty($matches['prefix'])) {
	    return '';
	}

	return strtolower($matches['prefix']);
}

var_dump(getAbsolutePrefix('/var/wwwsdfsdf/sdfsdfsdf/sdfsdf:'));
