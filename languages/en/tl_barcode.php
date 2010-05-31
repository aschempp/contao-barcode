<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

/**
 * TYPOlight webCMS
 * Copyright (C) 2005-2009 Leo Feyer
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 2.1 of the License, or (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 * 
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at http://www.gnu.org/licenses/.
 *
 * PHP version 5
 * @copyright  Andreas Schempp 2010
 * @author     Andreas Schempp <andreas@schempp.ch>
 * @license    http://opensource.org/licenses/lgpl-3.0.html
 * @version    $Id$
 */


/**
 * Fields
 */
$GLOBALS['TL_LANG']['tl_barcode']['name']				= array('Name', 'Please enter a name for this tag.');
$GLOBALS['TL_LANG']['tl_barcode']['type']				= array('Code type', 'Select a type. You can\'t change an existing Microsoft Tag!');
$GLOBALS['TL_LANG']['tl_barcode']['qr_data']			= array('Data', 'Please enter the data you want to convert to a QR code.');
$GLOBALS['TL_LANG']['tl_barcode']['qr_level']			= array('Level', 'Error correct level');
$GLOBALS['TL_LANG']['tl_barcode']['qr_version']			= array('Version', '');
$GLOBALS['TL_LANG']['tl_barcode']['ms_token']			= array('API Token', 'The token that was provided to you by the Microsoft Tag Team. You can apply for a token <a href="http://tag.microsoft.com/ws/accessrequest.aspx?wa=wsignin1.0" style="text-decoration:underline"' . LINK_NEW_WINDOW . '>here</a>.');
$GLOBALS['TL_LANG']['tl_barcode']['ms_category']		= array('Category name', 'The name of the category in which the Tag needs to be created. Default category is Main');
$GLOBALS['TL_LANG']['tl_barcode']['ms_title']			= array('Title', 'The title for the Tag');
$GLOBALS['TL_LANG']['tl_barcode']['ms_note']			= array('Note', 'You can add a note to this tag');
$GLOBALS['TL_LANG']['tl_barcode']['ms_company']			= array('Company');
$GLOBALS['TL_LANG']['tl_barcode']['ms_firstname']		= array('Firstname');
$GLOBALS['TL_LANG']['tl_barcode']['ms_lastname']		= array('Lastname');
$GLOBALS['TL_LANG']['tl_barcode']['ms_street']			= array('Street');
$GLOBALS['TL_LANG']['tl_barcode']['ms_zip']				= array('Postal code');
$GLOBALS['TL_LANG']['tl_barcode']['ms_city']			= array('City');
$GLOBALS['TL_LANG']['tl_barcode']['ms_country']			= array('Country');
$GLOBALS['TL_LANG']['tl_barcode']['ms_phone']			= array('Phone number');
$GLOBALS['TL_LANG']['tl_barcode']['ms_mobile']			= array('Mobile phone');
$GLOBALS['TL_LANG']['tl_barcode']['ms_email']			= array('Email address');
$GLOBALS['TL_LANG']['tl_barcode']['ms_uri']				= array('Website URL');
$GLOBALS['TL_LANG']['tl_barcode']['ms_text']			= array('Free text', 'The text that will be displayed when the Tag is resolved.');
$GLOBALS['TL_LANG']['tl_barcode']['ms_password']		= array('Password', 'The password that protects the Tag from being accessed after it has been resolved.');
$GLOBALS['TL_LANG']['tl_barcode']['ms_image']			= array('Tag image format');
$GLOBALS['TL_LANG']['tl_barcode']['ms_decoration']		= array('Decoration type', 'The type of decoration that is added to the Tag on generation.');
$GLOBALS['TL_LANG']['tl_barcode']['ms_size']			= array('Size', 'The size of the Tag in inches. Should be between 0.75 and 2.');
$GLOBALS['TL_LANG']['tl_barcode']['ms_blackAndWhite']	= array('Black and white', 'Indicates if the tag should be rendered in black and white or in color.');



/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_barcode']['new']				= array('New barcode', 'Create a new barcode');
$GLOBALS['TL_LANG']['tl_barcode']['edit']				= array('Edit barcode', 'Edit barcode ID %s');
$GLOBALS['TL_LANG']['tl_barcode']['copy']				= array('Duplicate barcode', 'Duplicate barcode ID %s');
$GLOBALS['TL_LANG']['tl_barcode']['delete']				= array('Delete barcode', 'Delete barcode ID %s');
$GLOBALS['TL_LANG']['tl_barcode']['show']				= array('Barcode details', 'Show details of barcode ID %s');


/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_barcode']['type_legend']		= 'Code type';
$GLOBALS['TL_LANG']['tl_barcode']['qr_legend']			= 'QR code configuration';
$GLOBALS['TL_LANG']['tl_barcode']['ms_legend']			= 'Microsoft Tag configuration';
$GLOBALS['TL_LANG']['tl_barcode']['data_legend']		= 'Tag data';
$GLOBALS['TL_LANG']['tl_barcode']['format_legend']		= 'Tag format';


/**
 * References
 */
$GLOBALS['TL_LANG']['tl_barcode']['qrcode']				= 'QR Code';
$GLOBALS['TL_LANG']['tl_barcode']['ms_URITag']			= 'Microsoft URI Tag';
$GLOBALS['TL_LANG']['tl_barcode']['ms_FreeTextTag']		= 'Microsoft Free Text Tag';
$GLOBALS['TL_LANG']['tl_barcode']['ms_DialerTag']		= 'Microsoft Dialer Tag (phone number)';
$GLOBALS['TL_LANG']['tl_barcode']['ms_VCardTag']		= 'Microsoft VCard Tag';
$GLOBALS['TL_LANG']['tl_barcode']['pdf']				= 'PDF';
$GLOBALS['TL_LANG']['tl_barcode']['wmf']				= 'WMF';
$GLOBALS['TL_LANG']['tl_barcode']['jpeg']				= 'JPEG';
$GLOBALS['TL_LANG']['tl_barcode']['png']				= 'PNG';
$GLOBALS['TL_LANG']['tl_barcode']['gif']				= 'GIF';
$GLOBALS['TL_LANG']['tl_barcode']['tiff']				= 'TIFF';
$GLOBALS['TL_LANG']['tl_barcode']['HCCBRP_DECORATION_NONE']			= 'Plain';
$GLOBALS['TL_LANG']['tl_barcode']['HCCBRP_DECORATION_DOWNLOAD']		= 'With Helper & Download Instructions';
$GLOBALS['TL_LANG']['tl_barcode']['HCCBRP_DECORATION_FRAMEPLAIN']	= 'Full Frame';
$GLOBALS['TL_LANG']['tl_barcode']['HCCBENCODEFLAG_STYLIZED']		= 'Custom';

