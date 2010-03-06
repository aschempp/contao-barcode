<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

/**
 * MSTagLib - <http://mstagrestlib.codeplex.com/>
 * A php library that uses a facade REST service to easily connect with the Microsoft Tag API
 * This library uses a third-party REST interface to the Microsoft TAG API located at: http://tag.ws.suddenelfilio.net
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 */

require('Tag.php');

final class URITag extends Tag 
{
	
	var $MedFiUrl; 
	
	public function __construct(){}
	
	/*public function __construct($interactionNote, $status, $title, $type, $utcEndDate, $utcStartDate, $medFiUrl)
	{
		parent::__construct($interactionNote, $status, $title, $type, $utcEndDate, $utcStartDate);
		$this->MedFiUrl = $medFiUrl;	
	}*/
}

