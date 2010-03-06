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
 * Table tl_barcode
 */
$GLOBALS['TL_DCA']['tl_barcode'] = array
(

	// Config
	'config' => array
	(
		'dataContainer'					=> 'Table',
		'enableVersioning'				=> true,
		'onsubmit_callback'				=> array
		(
			array('tl_barcode', 'updateMSTag'),
		),
	),

	// List
	'list' => array
	(
		'sorting' => array
		(
			'mode'						=> 1,
			'fields'					=> array('name'),
			'flag'						=> 1,
			'panelLayout'				=> 'filter;search,limit',
		),
		'label' => array
		(
			'fields'					=> array('name', 'type'),
			'format'					=> '%s <span style="color:#b3b3b3; padding-left:3px;">[%s]</span>',
		),
		'global_operations' => array
		(
			'all' => array
			(
				'label'					=> &$GLOBALS['TL_LANG']['MSC']['all'],
				'href'					=> 'act=select',
				'class'					=> 'header_edit_all',
				'attributes'			=> 'onclick="Backend.getScrollOffset();"'
			)
		),
		'operations' => array
		(
			'edit' => array
			(
				'label'					=> &$GLOBALS['TL_LANG']['tl_barcode']['edit'],
				'href'					=> 'act=edit',
				'icon'					=> 'edit.gif'
			),
			'copy' => array
			(
				'label'					=> &$GLOBALS['TL_LANG']['tl_barcode']['copy'],
				'href'					=> 'act=copy',
				'icon'					=> 'copy.gif'
			),
			'delete' => array
			(
				'label'					=> &$GLOBALS['TL_LANG']['tl_barcode']['delete'],
				'href'					=> 'act=delete',
				'icon'					=> 'delete.gif',
				'attributes'			=> 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\')) return false; Backend.getScrollOffset();"'
			),
			'show' => array
			(
				'label'					=> &$GLOBALS['TL_LANG']['tl_barcode']['show'],
				'href'					=> 'act=show',
				'icon'					=> 'show.gif'
			),
		)
	),

	// Palettes
	'palettes' => array
	(
		'__selector__'					=> array('type'),
		'default'						=> '{type_legend},name,type',
		'qrcode'						=> '{type_legend},name,type;{qr_legend},qr_data,qr_level,qr_version',
		'mstag'							=> '{type_legend},name,type;{auth_legend},ms_token;{ms_legend},ms_category',
	),

	// Fields
	'fields' => array
	(
		'type' => array
		(
			'label'						=> &$GLOBALS['TL_LANG']['tl_barcode']['type'],
			'inputType'					=> 'select',
			'default'					=> 'qrcode',
			'options'					=> array('qrcode', 'mstag'),
			'reference'					=> &$GLOBALS['TL_LANG']['tl_barcode'],
			'eval'						=> array('mandatory'=>true, 'submitOnChange'=>true, 'tl_class'=>'w50'),
		),
		'name' => array
		(
			'label'						=> &$GLOBALS['TL_LANG']['tl_barcode']['name'],
			'inputType'					=> 'text',
			'eval'						=> array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'w50'),
		),
		'qr_data' => array
		(
			'label'						=> &$GLOBALS['TL_LANG']['tl_barcode']['qr_data'],
			'inputType'					=> 'text',
			'eval'						=> array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'long'),
		),
		'qr_level' => array
		(
			'label'						=> &$GLOBALS['TL_LANG']['tl_barcode']['qr_level'],
			'inputType'					=> 'select',
			'default'					=> 'M',
			'options'					=> array('L', 'M', 'Q', 'H'),
			'eval'						=> array('mandatory'=>true, 'tl_class'=>'w50'),
		),
		'qr_version' => array
		(
			'label'						=> &$GLOBALS['TL_LANG']['tl_barcode']['qr_version'],
			'inputType'					=> 'select',
			'default'					=> '0',
			'options'					=> range(0, 40),
			'reference'					=> array(0=>'auto'),
			'eval'						=> array('tl_class'=>'w50'),
		),
		'ms_token' => array
		(
			'label'						=> &$GLOBALS['TL_LANG']['tl_barcode']['ms_token'],
			'inputType'					=> 'text',
			'eval'						=> array('mandatory'=>true, 'maxlength'=>36, 'tl_class'=>'clr'),
		),
		'ms_category' => array
		(
			'label'						=> &$GLOBALS['TL_LANG']['tl_barcode']['ms_category'],
			'inputType'					=> 'text',
			'eval'						=> array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'w50'),
		),
	)
);



class tl_barcode extends Backend
{
	
	public function updateMSTag($dc)
	{
		$objTag = $this->Database->prepare("SELECT * FROM tl_barcode WHERE id=?")->limit(1)->execute($dc->id);
		
		if (!$objTag->numRows || $objTag->type != 'mstag' || !strlen($objTag->ms_category))
			return;
			
		require_once(TL_ROOT . '/system/modules/barcode/MSTagLib/MSTag.php');
		
		$objAPI = new MSTag(new UserCredential($objTag->ms_token));
		
		if (!$objAPI->ActivateCategory($objTag->ms_category))
		{
			$_SESSION['TL_ERROR'][] = $objAPI->error;
			$this->reload();
		}
	}
	
}

