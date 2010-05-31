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
 

require('UserCredential.php');

class MSTag
{
	protected $base = 'http://tag.ws.suddenelfilio.net/mstagrest.svc';
	var $Credentials;
	public $http_status;
	public $error;
	public $errorCode;
	public $response;
	protected $args;

	public function __construct($userCredential)
	{
		$this->Credentials = $userCredential;
	}

	function GetQueryString($args)
	{
		$this->args = $args;
		
		$query_string = "";

		foreach ($args as $key => $value)
		{
			if($value != '')
			$query_string .= "$key=" . urlencode($value) . "&";
		}
		return trim($query_string,"&");
	}


	public function MakeRequest($url, $raw=false)
	{
		$curl_handle = curl_init();
		curl_setopt($curl_handle, CURLOPT_URL, $url);
		curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($curl_handle, CURLOPT_HTTPHEADER, array('Expect:'));
			
		$output=curl_exec($curl_handle);
		$this->http_status = curl_getinfo($curl_handle, CURLINFO_HTTP_CODE);
			
			
		if(curl_errno($curl_handle))
		{
			$info = curl_getinfo($curl_handle);

			print_r($info);
		}

		curl_close($curl_handle);
		return $raw ? $output : $this->parseOutput($output);
	}


	public function CreateURITag($uriTag,$category)
	{

		$params = array( 'at' => $this->Credentials->accessToken,
			    'cn'  => $category,
			    'in'  => $uriTag->InteractionNote,
			    'mfu' => $uriTag->MedFiUrl,
			    'ts'  => $uriTag->Status,
			    't'   => $uriTag->Title,
			    'it'  => $uriTag->Types ,
			    'ued' => $uriTag->UTCEndDate,
				'usd' => $uriTag->UTCStartDate
		);

		$qs= $this->GetQueryString($params);
		$url = $this->base . "/CreateURITag?$qs";
			
		return $this->MakeRequest($url);
	}

	public function CreateFreeTextTag($freeTextTag,$category)
	{

		$params = array( 'at' => $this->Credentials->accessToken,
			    'cn'  => $category,
			    'in'  => $freeTextTag->InteractionNote,
			    'ft'  => $freeTextTag->FreeText,
				'p'   => $freeTextTag->Password,
			    'ts'  => $freeTextTag->Status,
			    't'   => $freeTextTag->Title,
			    'it'  => $freeTextTag->Types ,
			    'ued' => $freeTextTag->UTCEndDate,
				'usd' => $freeTextTag->UTCStartDate
		);

		$qs= $this->GetQueryString($params);
		$url = $this->base . "/CreateFreeTextTag?$qs";
			
		$result = $this->MakeRequest($url);
		return $result;
	}

	public function CreateDialerTag($dialerTag,$category)
	{

		$params = array( 'at' => $this->Credentials->accessToken,
			    'cn'  => $category,
			    'in'  => $dialerTag->InteractionNote,
			    'pn'  => $dialerTag->PhoneNumber,
				'p'   => $dialerTag->Password,
			    'ts'  => $dialerTag->Status,
			    't'   => $dialerTag->Title,
			    'it'  => $dialerTag->Types ,
			    'ued' => $dialerTag->UTCEndDate,
				'usd' => $dialerTag->UTCStartDate
		);

		$qs= $this->GetQueryString($params);
		$url = $this->base . "/CreateDialerTag?$qs";
			
		$result = $this->MakeRequest($url);
		return $result;
	}

	public function CreateVCardTag($vcardTag,$category)
	{

		$params = array( 'at' => $this->Credentials->accessToken,
			    'cn'  => $category,
			    'in'  => $vcardTag->InteractionNote,
			    'c'   => $vcardTag->City,
				'co'  => $vcardTag->Company,
			    'cou' => $vcardTag->Country,
				'e'   => $vcardTag->Email,
				'f'   => $vcardTag->Fax,
				'fn'  => $vcardTag->Firstname,
				'ln'  => $vcardTag->Lastname,
				'w'   => $vcardTag->Webpage,
				'mp'  => $vcardTag->MobilePhone,
				'st'  => $vcardTag->State,
				'wp'  => $vcardTag->WorkPhone,
				'z'   => $vcardTag->Zip,
				'str' => $vcardTag->Street,
				'p'   => $vcardTag->Password,
			    'ts'  => $vcardTag->Status,
			    't'   => $vcardTag->Title,
			    'it'  => $vcardTag->Types ,
			    'ued' => $vcardTag->UTCEndDate,
				'usd' => $vcardTag->UTCStartDate
		);

		$qs= $this->GetQueryString($params);
		$url = $this->base . "/CreateVcardTag?$qs";
			
		$result = $this->MakeRequest($url);
		return $result;
	}

	public function GenerateBarcode($category,$tagName,$imageType,$size,$decoration,$blackAndWhite)
	{
		$params = array( 'at' => $this->Credentials->accessToken,
			    'cn'  => $category,
			    'tn'  => $tagName,
			    'it'  => $imageType,
				's'   => $size,
			    'dt'  => $decoration,
			    'bw'  => $blackAndWhite
		);


		$qs= $this->GetQueryString($params);
		$url = $this->base . "/GenerateBarcode?$qs";
			
		$result = $this->MakeRequest($url, true);
		return base64_decode($result);
	}
	public function CreateCategory($category)
	{
		$params = array( 'at' => $this->Credentials->accessToken,
			    'cn'  => $category->Name,
			    's'   => $category->Status,
			    'usd' => $category->UTCStartDate,
				'ued' => $category->UTCEndDate
		);


		$qs= $this->GetQueryString($params);
		$url = $this->base . "/CreateCategory?$qs";
			
		$result = $this->MakeRequest($url);
		return $result;
	}

	public function EditCategory($currentCategoryName,$newCategory)
	{
		$params = array( 'at' => $this->Credentials->accessToken,
   			    'ocn' => $currentCategoryName,
			    'ncn' => $newCategory->Name,
			    's'   => $newCategory->Status,
			    'usd' => $newCategory->UTCStartDate,
				'ued' => $newCategory->UTCEndDate
		);


		$qs= $this->GetQueryString($params);
		$url = $this->base . "/EditCategory?$qs";
			
		$result = $this->MakeRequest($url);
		return $result;
	}

	public function ActivateCategory($categoryName)
	{
		$params = array( 'at' => $this->Credentials->accessToken,
   			    'cn' => $categoryName
		);
			
		$qs= $this->GetQueryString($params);
		$url = $this->base . "/ActivateCategory?$qs";
			
		$result = $this->MakeRequest($url);
		return $result;
	}

	public function PauseCategory($categoryName)
	{
		$params = array( 'at' => $this->Credentials->accessToken,
   			    'cn' => $categoryName
		);
			
		$qs= $this->GetQueryString($params);
		$url = $this->base . "/PauseCategory?$qs";
			
		$result = $this->MakeRequest($url);
		return $result;
	}

	public function ActivateTag($categoryName, $tagName)
	{
		$params = array( 'at' => $this->Credentials->accessToken,
   			    'cn' => $categoryName,
   				'tt' => $tagName
		);
			
		$qs= $this->GetQueryString($params);
		$url = $this->base . "/ActivateTag?$qs";
			
		$result = $this->MakeRequest($url);
		return $result;
	}

	public function PauseTag($categoryName, $tagName)
	{
		$params = array( 'at' => $this->Credentials->accessToken,
   			    'cn' => $categoryName,
   				'tt' => $tagName
		);
			
		$qs= $this->GetQueryString($params);
		$url = $this->base . "/PauseTag?$qs";
			
		$result = $this->MakeRequest($url);
		return $result;
	}

	public function EditURITag($uriTag,$category,$title)
	{

		$params = array( 'at' => $this->Credentials->accessToken,
			    'cn'  => $category,
				'ct'  => $title,
			    'in'  => $uriTag->InteractionNote,
			    'mfu' => $uriTag->MedFiUrl,
			    'ts'  => $uriTag->Status,
			    't'   => $uriTag->Title,
			    'it'  => $uriTag->Types ,
			    'ued' => $uriTag->UTCEndDate,
				'usd' => $uriTag->UTCStartDate
		);

		$qs= $this->GetQueryString($params);
		$url = $this->base . "/EditURITag?$qs";
			
		return $this->MakeRequest($url);
	}

	public function EditFreeTextTag($freeTextTag,$category,$title)
	{

		$params = array( 'at' => $this->Credentials->accessToken,
			    'cn'  => $category,
			'ct'  => $title,
			    'in'  => $freeTextTag->InteractionNote,
			    'ft'  => $freeTextTag->FreeText,
				'p'   => $freeTextTag->Password,
			    'ts'  => $freeTextTag->Status,
			    't'   => $freeTextTag->Title,
			    'it'  => $freeTextTag->Types ,
			    'ued' => $freeTextTag->UTCEndDate,
				'usd' => $freeTextTag->UTCStartDate
		);

		$qs= $this->GetQueryString($params);
		$url = $this->base . "/EditFreeTextTag?$qs";
			
		$result = $this->MakeRequest($url);
		return $result;
	}

	public function EditDialerTag($dialerTag,$category,$title)
	{

		$params = array( 'at' => $this->Credentials->accessToken,
			    'cn'  => $category,
			'ct'  => $title,
			    'in'  => $dialerTag->InteractionNote,
			    'pn'  => $dialerTag->PhoneNumber,
				'p'   => $dialerTag->Password,
			    'ts'  => $dialerTag->Status,
			    't'   => $dialerTag->Title,
			    'it'  => $dialerTag->Types ,
			    'ued' => $dialerTag->UTCEndDate,
				'usd' => $dialerTag->UTCStartDate
		);

		$qs= $this->GetQueryString($params);
		$url = $this->base . "/EditDialerTag?$qs";
			
		$result = $this->MakeRequest($url);
		return $result;
	}

	public function EditVCardTag($vcardTag,$category,$title)
	{

		$params = array( 'at' => $this->Credentials->accessToken,
			    'cn'  => $category,
			'ct'  => $title,
			    'in'  => $vcardTag->InteractionNote,
			    'c'   => $vcardTag->City,
				'co'  => $vcardTag->Company,
			    'cou' => $vcardTag->Country,
				'e'   => $vcardTag->Email,
				'f'   => $vcardTag->Fax,
				'fn'  => $vcardTag->Firstname,
				'ln'  => $vcardTag->Lastname,
				'w'   => $vcardTag->Webpage,
				'mp'  => $vcardTag->MobilePhone,
				'st'  => $vcardTag->State,
				'wp'  => $vcardTag->WorkPhone,
				'z'   => $vcardTag->Zip,
				'str' => $vcardTag->Street,
				'p'   => $vcardTag->Password,
			    'ts'  => $vcardTag->Status,
			    't'   => $vcardTag->Title,
			    'it'  => $vcardTag->Types ,
			    'ued' => $vcardTag->UTCEndDate,
				'usd' => $vcardTag->UTCStartDate
		);

		$qs= $this->GetQueryString($params);
		$url = $this->base . "/EditVcardTag?$qs";
			
		$result = $this->MakeRequest($url);
		return $result;
	}
	
	
	/**
	 * Parse the API Output
	 *
	 * @author Andreas Schempp <andreas@schempp.ch>
	 */
	private function parseOutput($strOutput)
	{
		$this->response = $strOutput;
		
		if (strpos($strOutput, 'Token does not exist') !== false)
		{
			$this->error = sprintf($GLOBALS['TL_LANG']['ERR']['ms_token'], $this->Credentials->accessToken);
			$this->errorCode = 403;
			return false;
		}
		
		if (strpos($strOutput, 'Category with this name not exist') !== false)
		{
			$this->error = sprintf($GLOBALS['TL_LANG']['ERR']['ms_categoryMissing'], $this->args['cn']);
			$this->errorCode = 404;
			return false;
		}
		
		if (strpos($strOutput, 'Tag not found') !== false)
		{
			$this->error = sprintf($GLOBALS['TL_LANG']['ERR']['ms_tagMissing'], $this->args['tt']);
			$this->errorCode = 404;
			return false;
		}
		
		return true;
	}
}

