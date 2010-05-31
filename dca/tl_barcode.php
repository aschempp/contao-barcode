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
		'onload_callback'				=> array
		(
			array('tl_barcode', 'loadMSTag'),
		),
		'onsubmit_callback'				=> array
		(
			array('tl_barcode', 'updateMSTag'),
		),
		'ondelete_callback'				=> array
		(
			array('tl_barcode', 'deleteMSTag'),
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
		'__selector__'					=> array('type', 'ms_type'),
		'default'						=> '{type_legend},name,type',
		'qrcode'						=> '{type_legend},name,type;{qr_legend},qr_data,qr_level,qr_version',
		'ms_URITag'						=> '{type_legend},name,type;{ms_legend},ms_token,ms_title,ms_category,ms_note;{data_legend},ms_uri;{format_legend:hide},ms_image,ms_decoration,ms_size,ms_blackAndWhite',
		'ms_FreeTextTag'				=> '{type_legend},name,type;{ms_legend},ms_token,ms_title,ms_category,ms_note;{data_legend},ms_text,ms_password;{format_legend:hide},ms_image,ms_decoration,ms_size,ms_blackAndWhite',
		'ms_DialerTag'					=> '{type_legend},name,type;{ms_legend},ms_token,ms_title,ms_category,ms_note;{data_legend},ms_phone,ms_password;{format_legend:hide},ms_image,ms_decoration,ms_size,ms_blackAndWhite',
		'ms_VCardTag'					=> '{type_legend},name,type;{ms_legend},ms_token,ms_title,ms_category,ms_note;{data_legend},ms_company,ms_firstname,ms_lastname,ms_street,ms_zip,ms_city,ms_country,ms_phone,ms_mobile,ms_email,ms_uri;{format_legend:hide},ms_image,ms_decoration,ms_size,ms_blackAndWhite',
	),

	// Fields
	'fields' => array
	(
		'type' => array
		(
			'label'						=> &$GLOBALS['TL_LANG']['tl_barcode']['type'],
			'inputType'					=> 'select',
			'default'					=> 'qrcode',
			'options'					=> array('qrcode', 'ms_URITag', 'ms_FreeTextTag', 'ms_DialerTag', 'ms_VCardTag'),
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
			'default'					=> 'Main',
			'eval'						=> array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'w50'),
		),
		'ms_title' => array
		(
			'label'						=> &$GLOBALS['TL_LANG']['tl_barcode']['ms_title'],
			'inputType'					=> 'text',
			'eval'						=> array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'w50'),
		),
		'ms_note' => array
		(
			'label'						=> &$GLOBALS['TL_LANG']['tl_barcode']['ms_note'],
			'inputType'					=> 'textarea',
			'eval'						=> array('style'=>'height:60px', 'tl_class'=>'clr'),
		),
		'ms_company' => array
		(
			'label'						=> &$GLOBALS['TL_LANG']['tl_barcode']['ms_company'],
			'inputType'					=> 'text',
			'eval'						=> array('maxlength'=>255, 'tl_class'=>'clr'),
		),
		'ms_firstname' => array
		(
			'label'						=> &$GLOBALS['TL_LANG']['tl_barcode']['ms_firstname'],
			'inputType'					=> 'text',
			'eval'						=> array('maxlength'=>255, 'tl_class'=>'w50'),
		),
		'ms_lastname' => array
		(
			'label'						=> &$GLOBALS['TL_LANG']['tl_barcode']['ms_lastname'],
			'inputType'					=> 'text',
			'eval'						=> array('maxlength'=>255, 'tl_class'=>'w50'),
		),
		'ms_street' => array
		(
			'label'						=> &$GLOBALS['TL_LANG']['tl_barcode']['ms_street'],
			'inputType'					=> 'text',
			'eval'						=> array('maxlength'=>255, 'tl_class'=>'w50'),
		),
		'ms_zip' => array
		(
			'label'						=> &$GLOBALS['TL_LANG']['tl_barcode']['ms_zip'],
			'inputType'					=> 'text',
			'eval'						=> array('maxlength'=>255, 'tl_class'=>'w50'),
		),
		'ms_city' => array
		(
			'label'						=> &$GLOBALS['TL_LANG']['tl_barcode']['ms_city'],
			'inputType'					=> 'text',
			'eval'						=> array('maxlength'=>255, 'tl_class'=>'w50'),
		),
		'ms_country' => array
		(
			'label'						=> &$GLOBALS['TL_LANG']['tl_barcode']['ms_country'],
			'inputType'					=> 'text',
			'eval'						=> array('maxlength'=>255, 'tl_class'=>'w50'),
		),
		'ms_phone' => array
		(
			'label'						=> &$GLOBALS['TL_LANG']['tl_barcode']['ms_phone'],
			'inputType'					=> 'text',
			'eval'						=> array('maxlength'=>255, 'rgxp'=>'phone', 'tl_class'=>'w50'),
		),
		'ms_mobile' => array
		(
			'label'						=> &$GLOBALS['TL_LANG']['tl_barcode']['ms_mobile'],
			'inputType'					=> 'text',
			'eval'						=> array('maxlength'=>255, 'rgxp'=>'phone', 'tl_class'=>'w50'),
		),
		'ms_email' => array
		(
			'label'						=> &$GLOBALS['TL_LANG']['tl_barcode']['ms_email'],
			'inputType'					=> 'text',
			'eval'						=> array('maxlength'=>255, 'rgxp'=>'email', 'tl_class'=>'w50'),
		),
		'ms_uri' => array
		(
			'label'						=> &$GLOBALS['TL_LANG']['tl_barcode']['ms_uri'],
			'inputType'					=> 'text',
			'eval'						=> array('maxlength'=>255, 'rgxp'=>'url', 'tl_class'=>'w50'),
		),
		'ms_text' => array
		(
			'label'						=> &$GLOBALS['TL_LANG']['tl_barcode']['ms_text'],
			'inputType'					=> 'textarea',
			'eval'						=> array('style'=>'height:60px'),
		),
		'ms_password' => array
		(
			'label'						=> &$GLOBALS['TL_LANG']['tl_barcode']['ms_password'],
			'inputType'					=> 'text',
			'eval'						=> array('maxlength'=>255, 'tl_class'=>'w50'),
		),
		'ms_image' => array
		(
			'label'						=> &$GLOBALS['TL_LANG']['tl_barcode']['ms_image'],
			'inputType'					=> 'select',
			'default'					=> 'png',
			'options'					=> array('pdf', 'wmf', 'jpeg', 'png', 'gif', 'tiff'),
			'reference'					=> &$GLOBALS['TL_LANG']['tl_barcode'],
			'eval'						=> array('mandatory'=>true, 'tl_class'=>'w50'),
		),
		'ms_decoration' => array
		(
			'label'						=> &$GLOBALS['TL_LANG']['tl_barcode']['ms_decoration'],
			'inputType'					=> 'select',
			'default'					=> 'HCCBRP_DECORATION_DOWNLOAD',
			'options'					=> array('HCCBRP_DECORATION_NONE', 'HCCBRP_DECORATION_DOWNLOAD', 'HCCBRP_DECORATION_FRAMEPLAIN', 'HCCBENCODEFLAG_STYLIZED'),
			'reference'					=> &$GLOBALS['TL_LANG']['tl_barcode'],
			'eval'						=> array('mandatory'=>true, 'tl_class'=>'w50'),
		),
		'ms_size' => array
		(
			'label'						=> &$GLOBALS['TL_LANG']['tl_barcode']['ms_size'],
			'inputType'					=> 'text',
			'default'					=> 1,
			'eval'						=> array('mandatory'=>true, 'maxlength'=>4, 'rgxp'=>'digit', 'tl_class'=>'w50'),
		),
		'ms_blackAndWhite' => array
		(
			'label'						=> &$GLOBALS['TL_LANG']['tl_barcode']['ms_blackAndWhite'],
			'inputType'					=> 'checkbox',
			'eval'						=> array('tl_class'=>'w50 m12'),
		),
	)
);



class tl_barcode extends Backend
{
	
	public function loadMSTag($dc)
	{
		$objTag = $this->Database->prepare("SELECT * FROM tl_barcode WHERE id=?")->limit(1)->execute($dc->id);
		
		if (!$objTag->numRows || !in_array($objTag->type, array('ms_URITag', 'ms_FreeTextTag', 'ms_DialerTag', 'ms_VCardTag')))
			return;
			
		$GLOBALS['TL_DCA']['tl_barcode']['fields']['type']['eval']['disabled'] = 'disabled';
		$GLOBALS['TL_DCA']['tl_barcode']['fields']['type']['eval']['mandatory'] = false;
	}
	
	
	public function updateMSTag($dc)
	{
		$objTag = $this->Database->prepare("SELECT * FROM tl_barcode WHERE id=?")->limit(1)->execute($dc->id);
		
		if (!$objTag->numRows || !in_array($objTag->type, array('ms_URITag', 'ms_FreeTextTag', 'ms_DialerTag', 'ms_VCardTag')) || !strlen($objTag->ms_token) || !strlen($objTag->ms_category) || !strlen($objTag->ms_title))
			return;
					
		require_once(TL_ROOT . '/system/modules/barcode/MSTagLib/MSTag.php');
		
		$objAPI = new MSTag(new UserCredential($objTag->ms_token));
		
		if (!$objAPI->ActivateCategory($objTag->ms_category))
		{
			if ($objAPI->errorCode != 404)
			{
				$_SESSION['TL_ERROR'][] = $objAPI->error;
				$this->reload();
			}
			
			require('Category.php');
			
			$objCategory = new Category();
			$objCategory->Name = $this->getValue('ms_category', $objTag);
			$objCategory->Status = 'Active';
			$objCategory->UTCStartDate = date('r');
			$objCategory->UTCEndDate = '';
			
			if (!$objAPI->CreateCategory($objCategory))
			{
				$_SESSION['TL_ERROR'][] = $objAPI->error;
				$this->reload();
			}
		}
		
		
		$strClass = str_replace('ms_', '', $objTag->type);
		require_once(TL_ROOT . '/system/modules/barcode/MSTagLib/'.$strClass.'.php');
		$objClass = new $strClass();
		$objClass->InteractionNote = $this->getValue('ms_note', $objTag);
		$objClass->Status = 'Active';
		$objClass->Title = $this->Input->post('ms_title');
		$objClass->Types = $this->getValue('ms_image', $objTag);
		$objClass->UTCStartDate = date('r');
		$objClass->UTCEndDate = '';
				
		switch( $objTag->type )
		{
			case 'ms_URITag':
				$objClass->MedFiUrl = $this->getValue('ms_uri', $objTag);
				break;
				
			case 'ms_FreeTextTag':
				$objClass->FreeText = $this->getValue('ms_text', $objTag);
				$objClass->Password = $this->getValue('ms_password', $objTag);
				break;
				
			case 'ms_DialerTag':
				$objClass->PhoneNumber = $this->getValue('ms_phone', $objTag);
				$objClass->Password = $this->getValue('ms_password', $objTag);
				break;
				
			case 'ms_VCardTag':
				$objClass->City = $this->getValue('ms_city', $objTag);
				$objClass->Company = $this->getValue('ms_company', $objTag);
				$objClass->Country = $this->getValue('ms_country', $objTag);
				$objClass->Email = $this->getValue('ms_email', $objTag);
				$objClass->Firstname = $this->getValue('ms_firstname', $objTag);
				$objClass->Lastname = $this->getValue('ms_lastname', $objTag);
				$objClass->MobilePhone = $this->getValue('ms_mobile', $objTag);
				$objClass->State = $this->getValue('ms_state', $objTag);
				$objClass->Street = $this->getValue('ms_street', $objTag);
				$objClass->Webpage = $this->getValue('ms_uri', $objTag);
				$objClass->WorkPhone = $this->getValue('ms_phone', $objTag);
				$objClass->Zip = $this->getValue('ms_zip', $objTag);
				$objClass->Password = $this->getValue('ms_password', $objTag);
				break;
				
			default:
				throw new Exception('Unsupported Microsoft Tag');
		}
		
		
		if (!$objAPI->{'Edit'.$strClass}($objClass, $this->getValue('ms_category', $objTag), $objTag->ms_title))
		{
			if ($objAPI->errorCode != 404)
			{
				$_SESSION['TL_ERROR'][] = $objAPI->error;
				$this->reload();
			}
			
			if (!$objAPI->{'Create'.$strClass}($objClass, $this->getValue('ms_category', $objTag)))
			{
				$_SESSION['TL_ERROR'][] = $objAPI->error;
				$this->reload();
			}
		}
	}
	
	
	public function deleteMSTag($dc)
	{
		$objTag = $this->Database->prepare("SELECT * FROM tl_barcode WHERE id=?")->limit(1)->execute($dc->id);
		
		if (!$objTag->numRows || !in_array($objTag->type, array('ms_URITag', 'ms_FreeTextTag', 'ms_DialerTag', 'ms_VCardTag')) || !strlen($objTag->ms_token) || !strlen($objTag->ms_category) || !strlen($objTag->ms_title))
			return;
					
		require_once(TL_ROOT . '/system/modules/barcode/MSTagLib/MSTag.php');
		
		$objAPI = new MSTag(new UserCredential($objTag->ms_token));
		
		$objAPI->PauseTag($objTag->ms_category, $objTag->ms_title);
	}
	
	
	private function getValue($strKey, $objTag)
	{
		return strlen($this->Input->post($strKey)) ? $this->Input->post($strKey) : $objTag->$strKey;
	}
}

