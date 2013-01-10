<?php

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// ViewXHTML
// Render a web page from a template and input variables
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

require_once('class.View.php');

class ViewXHTML extends View
{
	function outputDocType($p_sType = 'XHTML 1.0 Strict')
	{
		if ($p_sType == 'XHTML 1.0 Strict')
			return '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">';
	}

	function outputPageTitle()
	{
		$t_sString = '<title>' . $this->m_hVars['PageTitle'] . '</title>';
		if (isset($this->m_hVars['Description']) && $this->m_hVars['Description'])
			$t_sString .= '<meta name="description" content="' . $this->m_hVars['Description'] . '" />';
		if (isset($this->m_hVars['Keywords']) && $this->m_hVars['Keywords'])
			$t_sString .= '<meta name="keywords" content="' . $this->m_hVars['Keywords'] . '" />';

		return $t_sString;
	}

	function outputStyleSheet($p_sFileName)
	{
		global $g_sSitePath;

		return '<link href="' . $g_sSitePath . 'styles/' . $p_sFileName . '" rel="stylesheet" type="text/css" />';
	}

	function outputScript($p_sFileName)
	{
		global $g_sSitePath;

		return '<script type="text/javascript" src="' . $g_sSitePath . 'scripts/' . $p_sFileName . '"></script>';
	}

	function contentReplace($p_sContent)
	{
		global $g_hRequestVars, $g_sSitePath, $g_sSiteName, $g_sCompanyNameShort, $g_sCompanyName, $g_sDomain;

		$t_aReplace = array();
		preg_match_all("/\[\[[a-z0-9\.\,\?:\-=&;\(\) ]+\]\]/i", $p_sContent, $t_hTags);

		foreach ($t_hTags[0] as $key => $val)
		{
			// strip enclosing square brackets
			$val = substr($val, 2, strlen($val)-4);
			// explode by : character
			$t_aTagParts = explode(':', $val);
			$t_sTagName = $t_aTagParts[0];
			switch ($t_sTagName)
			{
				case 'SSLSeal':
					$t_sString = '<script type="text/javascript" src="https://seal.verisign.com/getseal?host_name=www.insurewithease.com&amp;size=M&amp;use_flash=NO&amp;use_transparent=NO&amp;lang=en"></script>';
					$t_aReplace[$key] = $t_sString;
					break;

				case 'SaleTracking':
					if ($g_bTracking)
					{
						$t_sPolicyNumber = isset($this->m_hVars['PolicyNumber']) ? $this->m_hVars['PolicyNumber'] : '';
						$t_fTotalDue = isset($this->m_hVars['TotalDue']) ? $this->m_hVars['TotalDue'] : '';
						$t_aReplace[$key] = '<!-- Google Code for Sale Conversion Page --><script type="text/javascript">/* <![CDATA[ */var google_conversion_id = 1039152578; var google_conversion_language = "en_GB"; var google_conversion_format = "1"; var google_conversion_color = "ffffff"; var google_conversion_label = "JmdSCJyjfhDC68DvAw"; var google_conversion_value = 0;/* ]]> */</script><script type="text/javascript" src="https://www.googleadservices.com/pagead/conversion.js"></script><noscript><div style="display:inline;"><img height="1" width="1" style="border-style:none;" alt="" src="https://www.googleadservices.com/pagead/conversion/1039152578/?value=1.0&amp;label=JmdSCJyjfhDC68DvAw&amp;guid=ON&amp;script=0"/></div></noscript>';

						$t_aReplace[$key] .= "<script type=\"text/javascript\">var _gaq = _gaq || []; _gaq.push(['_setAccount', 'UA-6270670-6']); _gaq.push(['_trackPageview']); _gaq.push(['_addTrans', '" . $t_sPolicyNumber . "', 'insurewithease.com', '" . $t_fTotalDue . "', '', '', '', '', '']); _gaq.push(['_trackTrans']); //submits transaction to the Analytics servers (function() { var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true; ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js'; var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);})();</script>";

						$t_aReplace[$key] .= '<!-- <webgains tracking code> --><script language="javascript" type="text/javascript">var wgOrderReference = "' . $t_sPolicyNumber . '"; var wgOrderValue = "' . $t_fTotalDue . '"; var wgEventID =1784; var wgComment = ""; var wgLang = "en_EN"; var wgsLang = "javascript-client"; var wgVersion = "1.2"; var wgProgramID =1061; var wgSubDomain = "track"; var wgCheckSum = ""; var wgItems = ""; var wgVoucherCode = ""; var wgCustomerID = ""; if(location.protocol.toLowerCase() == "https:") wgProtocol="https"; else wgProtocol = "http"; wgUri = wgProtocol + "://" + wgSubDomain + ".webgains.com/transaction.html" + "?wgver=" + wgVersion + "&wgprotocol=" + wgProtocol + "&wgsubdomain=" + wgSubDomain + "&wgslang=" + wgsLang + "&wglang=" + wgLang + "&wgprogramid=" + wgProgramID + "&wgeventid=" + wgEventID + "&wgvalue=" + wgOrderValue + "&wgchecksum=" + wgCheckSum + "&wgorderreference="  + wgOrderReference + "&wgcomment=" + escape(wgComment) + "&wglocation=" + escape(document.referrer) + "&wgitems=" + escape(wgItems) + "&wgcustomerid=" + escape(wgCustomerID) + "&wgvouchercode=" + escape(wgVoucherCode); document.write(\'<sc\'+\'ript language="JavaScript" type="text/javascript" src="\'+wgUri+\'"></sc\'+\'ript>\'); </script><noscript><img src="http://track.webgains.com/transaction.html?wgver=1.2&wgprogramid=1061&wgrs=1&wgvalue=' . $t_fTotalDue . '&wgeventid=1784&wgorderreference=' . $t_sPolicyNumber . '&wgitems=&wgvouchercode=&wgcustomerid=" alt="" /></noscript><!-- </webgains tracking code> -->';
					}
					else
						$t_aReplace[$key] = '';
					break;

				case 'PageTracking':
					if ($g_bTracking)
					{
						$t_aReplace[$key] = "<script type=\"text/javascript\">var _gaq = _gaq || []; _gaq.push(['_setAccount', 'UA-6270670-6']); _gaq.push(['_trackPageview']); (function() {var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true; ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js'; var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);})();</script>";
					}
					else
						$t_aReplace[$key] = '';
					break;

				case 'PageTrackingQuote':
					if ($g_bTracking)
					{
						$t_aReplace[$key] = "<script type=\"text/javascript\">var _gaq = _gaq || []; _gaq.push(['_setAccount', 'UA-6270670-6']); (function() {var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true; ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js'; var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);})();</script>";
					}
					else
						$t_aReplace[$key] = '';
					break;

				case 'DocType':
					$t_aReplace[$key] = $this->outputDocType();
					break;

				case 'PageTitle':
					$t_aReplace[$key] = $this->outputPageTitle();
					break;

				case 'DocTitle':
					$t_aReplace[$key] = $this->m_hVars['PageTitle'];
					break;

				case 'CurrentURL':
					$t_aReplace[$key] = $g_sDomain . $_SERVER['REQUEST_URI'];
					break;

				case 'SitePath':
					$t_aReplace[$key] = $g_sSitePath;
					break;

				case 'CompanyNameShort':
					$t_aReplace[$key] = $g_sCompanyNameShort;
					break;

				case 'SiteName':
					$t_aReplace[$key] = $g_sSiteName;
					break;

				case 'CompanyNameFull':
					$t_aReplace[$key] = $g_sCompanyName;
					break;

				case 'Styles':
					$t_sStyles = '';
					if (sizeof($t_aTagParts) > 1)
					{
						foreach ($t_aTagParts as $key2 => $val2)
						{
							if ($key2 > 0)
							{
								$t_aSubParts = explode('=', $val2);
								if ($t_aSubParts[0] == 'File')
								{
									// files separated by ,
									$t_aSubSubParts = explode(',', $t_aSubParts[1]);
									foreach ($t_aSubSubParts as $key3 => $val3)
									{
										$t_sStyles .= $this->outputStyleSheet($val3);
									}
								}
							}
						}
					}
					$t_aReplace[$key] = $t_sStyles;
					break;

				case 'Scripts':
					$t_sScripts = '';
					if (sizeof($t_aTagParts) > 1)
					{
						foreach ($t_aTagParts as $key2 => $val2)
						{
							if ($key2 > 0)
							{
								$t_aSubParts = explode('=', $val2);
								if ($t_aSubParts[0] == 'File')
								{
									// files separated by ,
									$t_aSubSubParts = explode(',', $t_aSubParts[1]);
									foreach ($t_aSubSubParts as $key3 => $val3)
									{
										$t_sSecure = '';
										if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on')
											$t_sSecure = 's';

										if ($val3 == 'jquery')
											$t_sScripts .= '<script type="text/javascript" src="http' . $t_sSecure . '://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>';
										else if ($val3 == 'jqueryui')
											$t_sScripts .= '<script type="text/javascript" src="http' . $t_sSecure . '://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>';
										else
											$t_sScripts .= $this->outputScript($val3);
									}
								}
							}
						}
					}
					// tracking
					/*$t_sScripts .= '<script type="text/javascript">var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www."); document.write(unescape("%3Cscript src=\'" + gaJsHost + "google-analytics.com/ga.js\' type=\'text/javascript\'%3E%3C/script%3E"));</script>';
					$t_sScripts .= '<script type="text/javascript">try {var pageTracker = _gat._getTracker("UA-6270670-9");	pageTracker._trackPageview();} catch(err) {}</script>';*/
					$t_aReplace[$key] = $t_sScripts;
					break;

				case 'Var':
					$t_sName = ''; $t_iKey = -1; $t_sAttr = '';
					$t_bHTML = false; $t_bLowerCase = false; $t_sDate = ''; $t_bPremium = false; $t_bEncrypt = false; $t_bBenefit = false;

					if (sizeof($t_aTagParts) > 1)
					{
						foreach ($t_aTagParts as $key2 => $val2)
						{
							if ($key2 > 0)
							{
								$t_aSubParts = explode('=', $val2);
								if ($t_aSubParts[0] == 'Name')
								{
									$t_sName = $t_aSubParts[1];
								}
								if ($t_aSubParts[0] == 'Key')
								{
									$t_iKey = $t_aSubParts[1];
								}
								if ($t_aSubParts[0] == 'Attr')
								{
									$t_sAttr = $t_aSubParts[1];
								}
								if ($t_aSubParts[0] == 'HTML')
								{
									$t_bHTML = true;
								}
								if ($t_aSubParts[0] == 'LowerCase')
								{
									$t_bLowerCase = true;
								}
								if ($t_aSubParts[0] == 'Date')
								{
									$t_sDate = $t_aSubParts[1];
								}
								if ($t_aSubParts[0] == 'Premium')
								{
									$t_bPremium = true;
								}
								if ($t_aSubParts[0] == 'Benefit')
								{
									$t_bBenefit = true;
								}
								if ($t_aSubParts[0] == 'Encrypt')
								{
									$t_bEncrypt = true;
								}
							}
						}
					}
					if (isset($this->m_hVars[$t_sName]))
					{
						if ($t_iKey > -1)
						{
							$t_aReplace[$key] = $this->m_hVars[$t_sName][$t_iKey][$t_sAttr];
						}
						else
						{
							$t_aReplace[$key] = $this->m_hVars[$t_sName];
						}
					}
					else
						$t_aReplace[$key] = '';

					if ($t_sDate)
					{
						$t_aReplace[$key] = ViewHelper::formatDate($t_aReplace[$key], $t_sDate);
					}
					if ($t_bPremium)
					{
						$t_aReplace[$key] = ViewHelper::formatPremium($t_aReplace[$key]);
					}
					if ($t_bBenefit)
					{
						$t_aReplace[$key] = ViewHelper::formatBenefit($t_aReplace[$key]);
					}
					if ($t_bLowerCase)
					{
						$t_aReplace[$key] = ViewHelper::formatLowerCase($t_aReplace[$key]);
					}
					if ($t_bEncrypt)
					{
						$t_aReplace[$key] = Encrypt::encryptString($t_aReplace[$key]);
					}
					if ($t_bHTML)
					{
						$t_aReplace[$key] = ViewHelper::formatHTML($t_aReplace[$key]);
					}
		
					break;
				
				case 'Link':
					$t_sName = ''; $t_bIcon = false;
					if (sizeof($t_aTagParts) > 1)
					{
						foreach ($t_aTagParts as $key2 => $val2)
						{
							if ($key2 == 1)
								$t_sName = $val2;
							if ($key2 == 2 && $val2 == 'Icon')
								$t_bIcon = true;
						}
					}
					$t_hResult = $g_oDb->select(array('*'), array('custom_page'), "name = '" . $g_oDb->escapeString($t_sName) . "'", true);
					if (sizeof($t_hResult))
					{
						if ($t_bIcon)
							$t_aReplace[$key] = '<a href="' . $g_sSitePath . $t_hResult['url'] . '" title="' . $t_hResult['link_title'] . '"><img src="' . $g_sSitePath . 'images/icon_' . strtolower($t_sName) . '.png" alt="" class="linkIcon" /></a><a href="' . $g_sSitePath . $t_hResult['url'] . '" title="' . $t_hResult['link_title'] . '">' . ViewHelper::formatHTML($t_hResult['link_text']) . '</a>';
						else
							$t_aReplace[$key] = '<a href="' . $g_sSitePath . $t_hResult['url'] . '" title="' . $t_hResult['link_title'] . '">' . ViewHelper::formatHTML($t_hResult['link_text']) . '</a>';
					}
					else
						$t_aReplace[$key] = 'BROKEN LINK';
					break;


				case 'Input':
					$t_sType = 'text'; $t_sID = 'a'; $t_iMax = ''; $t_sClasses = ''; $t_sValue = ''; $t_iRows = '';
					if (sizeof($t_aTagParts) > 1)
					{
						foreach ($t_aTagParts as $key2 => $val2)
						{
							if ($key2 > 0)
							{
								$t_aSubParts = explode('=', $val2);
								if ($t_aSubParts[0] == 'Type')
								{
									$t_sType = $t_aSubParts[1];
								}
								if ($t_aSubParts[0] == 'Id')
								{
									$t_sID = $t_aSubParts[1];
								}
								if ($t_aSubParts[0] == 'Max')
								{
									$t_iMax = $t_aSubParts[1];
								}
								if ($t_aSubParts[0] == 'Value')
								{
									$t_sValue = $t_aSubParts[1];
								}
								if ($t_aSubParts[0] == 'Rows')
								{
									$t_iRows = $t_aSubParts[1];
								}
								if ($t_aSubParts[0] == 'Class')
								{
									// classes separated by ,
									$t_aSubSubParts = explode(',', $t_aSubParts[1]);
									foreach ($t_aSubSubParts as $key3 => $val3)
									{
										if ($key3 > 0){$t_sClasses .= ' ';}
										$t_sClasses .= $val3;
									}
								}
							}
						}
					}
					if ($t_sType == 'checkbox'){$t_sClasses .= ' checkbox';}
					if (isset($this->m_hVars[$t_sID])){$t_sValue = $this->m_hVars[$t_sID];}
					if ($t_sType == 'textarea')
					{
						$t_aReplace[$key] = '<textarea' . ($t_sClasses ? ' class="' . $t_sClasses . '"' : '') . ' name="' . $t_sID . '" id="' . $t_sID . '" rows="' . ($t_iRows ? $t_iRows : 1) . '" cols="">' . ($t_sValue ? $t_sValue : '') . '</textarea>';
					}
					else if ($t_sType == 'checkbox')
					{
						$t_aReplace[$key] = '<input type="checkbox" name="' . $t_sID . '" id="' . $t_sID . '" value="1"' . (isset($this->m_hVars[$t_sID]) && $this->m_hVars[$t_sID] == 1 ? ' checked="checked"' : '') . ($t_sClasses ? ' class="' . $t_sClasses . '"' : '') . ' />';
					}
					else
					{
						$t_aReplace[$key] = '<input type="' . $t_sType . '" name="' . $t_sID . '" id="' . $t_sID . '"' . ($t_iMax ? ' maxlength="' . $t_iMax . '"' : '') . ($t_sValue || strval($t_sValue) === strval(0) ? ' value="' . $t_sValue . '"' : '') . ($t_sClasses ? ' class="' . $t_sClasses . '"' : '') . ' />';
					}
					break;

				case 'Spaces':
					$t_iNum = 1;
					if (sizeof($t_aTagParts) > 1)
					{
						foreach ($t_aTagParts as $key2 => $val2)
						{
							if ($key2 > 0)
							{
								$t_aSubParts = explode('=', $val2);
								if ($t_aSubParts[0] == 'Number')
								{
									$t_iNum = $t_aSubParts[1];
								}
							}
						}
					}
					$t_aReplace[$key] = str_repeat('&nbsp;', $t_iNum);
					break;

				case 'SectionStart':
				case 'SectionEnd':
				case 'BaseTemplate':
				case 'Section':
					// keep original tag for later
					$t_aReplace[$key] = '[[' . $val . ']]';
					break;
			}
			// replace enclosing brackets for the replacement
			$t_hTags[0][$key] = "/\[\[" . $val . "\]\]/";
		}
		// replace back into the content
		return preg_replace($t_hTags[0], $t_aReplace, $p_sContent, 1);
	}


	function render($p_bEchoResult = true)
	{
		global $g_sSiteName;

// LOCATE BASE TEMPLATE DETAILS FROM MAIN TEMPLATE /////////////////////////////////////////////////////////////////////////////////////////////////

		$t_sBaseTemplateFile = '';
		$this->m_hVars['GridImage'] = 'home';

		if (!$this->m_bNoBase)
		{
			preg_match("/\[\[BaseTemplate[a-z0-9\.\,\?:=&;\(\)\-<>' ]+\]\]/i", $this->m_sContent, $t_aBaseTag);
			$t_aBaseTag[0] = substr($t_aBaseTag[0], 2, strlen($t_aBaseTag[0])-4);

			$t_aBaseTagParts = explode(':', $t_aBaseTag[0]);
			if (sizeof($t_aBaseTagParts) > 1)
			{
				foreach ($t_aBaseTagParts as $key => $val)
				{
					if ($key > 0)
					{
						$t_aBaseSubParts = explode('=', $val);
						if ($t_aBaseSubParts[0] == 'File')
						{
							$t_sBaseTemplateFile = $t_aBaseSubParts[1];
						}
						if ($t_aBaseSubParts[0] == 'PageTitle')
						{
							$t_aBaseSubParts[1] = str_replace('<<SiteName>>', $g_sSiteName, $t_aBaseSubParts[1]);
							$this->m_hVars['PageTitle'] = $t_aBaseSubParts[1];
						}
						if ($t_aBaseSubParts[0] == 'Description')
						{
							$this->m_hVars['Description'] = $t_aBaseSubParts[1];
						}
						if ($t_aBaseSubParts[0] == 'Keywords')
						{
							$this->m_hVars['Keywords'] = $t_aBaseSubParts[1];
						}
					}
				}
			}
			$t_sBaseTemplateFile = './mvc/templates/' . $t_sBaseTemplateFile;
		}

// LOAD AND PROCESS BASE TEMPLATE //////////////////////////////////////////////////////////////////////////////////////////////////////////////////

		if (!$this->m_bNoBase)
		{
			if (!$t_oFile = fopen($t_sBaseTemplateFile, 'r'))
		    {
				throw new Exception('The base template could not be opened');
			}
			else
			{
				$this->m_sBaseContent = fread($t_oFile, filesize($t_sBaseTemplateFile));
				fclose($t_oFile);
				$this->m_sBaseContent = $this->contentReplace($this->m_sBaseContent);
			}
		}

// PROCESS MAIN TEMPLATE ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

		// create repeating collections
		unset ($t_aReplace); unset ($t_hTags);
		$t_aReplace = array();
		preg_match_all("/\[\[CollectionStart[a-z0-9\.\,:=\(\) ]+\]\]/i", $this->m_sContent, $t_hTags);

		foreach ($t_hTags[0] as $key => $val)
		{
			$t_sSectionName = ''; $t_sType = ''; $t_sVar = ''; $t_iPerRow = 1; $t_sEmpty = '';
			
			$val = substr($val, 2, strlen($val)-4);
			$t_aTagParts = explode(':', $val);
			if (sizeof($t_aTagParts) > 1)
			{
				foreach ($t_aTagParts as $key2 => $val2)
				{
					if ($key2 > 0)
					{
						$t_aSubParts = explode('=', $val2);
						if ($t_aSubParts[0] == 'Name')
						{
							$t_sSectionName = $t_aSubParts[1];
						}
						if ($t_aSubParts[0] == 'Type')
						{
							$t_sType = $t_aSubParts[1];
						}
						if ($t_aSubParts[0] == 'Var')
						{
							$t_sVar = $t_aSubParts[1];
						}
						if ($t_aSubParts[0] == 'Empty')
						{
							$t_sEmpty = $t_aSubParts[1];
						}
						if ($t_aSubParts[0] == 'PerRow')
						{
							$t_iPerRow = $t_aSubParts[1];
						}
					}
				}
			}

			// find all the content within the collection that is to be repeated
			if ($t_sSectionName)
			{
				$t_sRepeatedContent = ''; $t_sNewContent = '';
				if ($t_sType == 'RepeatedTable'){$t_sNewContent .= '<table>';}

				preg_match("/\[\[CollectionStart:[a-z0-9\.\,:=\(\) ]*?Name=" . $t_sSectionName . "[a-z0-9\.\,:= ]*?\]\]([^\e]*?)\[\[CollectionEnd:Name=" . $t_sSectionName . "\]\]/i", $this->m_sContent, $t_aSection);
				if (isset($t_aSection[1]))
				{
					$t_sRepeatedContent = $t_aSection[1];
					if (isset($this->m_hVars[$t_sVar]))
					{
						// loop through the main variable and add to the replacement each iteration
						foreach ($this->m_hVars[$t_sVar] as $key2 => $val2)
						{
							unset ($t_aCollectionReplace); unset ($t_hCollectionTags);
							$t_sPartial = $t_sRepeatedContent;
							$t_aCollectionReplace = array();
							preg_match_all("/\[\[SubVar[a-z0-9\.\,\?:= ]+\]\]/i", $t_sPartial, $t_hCollectionTags);

							foreach ($t_hCollectionTags[0] as $key3 => $val3)
							{
								$t_sCollectionAttribute = '';
								$val3 = substr($val3, 2, strlen($val3)-4);
								$t_aTagParts = explode(':', $val3);
								if (sizeof($t_aTagParts) > 1)
								{
									foreach ($t_aTagParts as $key4 => $val4)
									{
										if ($key4 > 0)
										{
											$t_aSubParts = explode('=', $val4);
											if ($t_aSubParts[0] == 'Name')
											{
												$t_sCollectionAttribute = $t_aSubParts[1];
											}
										}
									}
								}

								$t_aCollectionReplace[$key3] = str_replace('SubVar:Name=' . $t_sCollectionAttribute, 'Var:Name=' . $t_sVar . ':Key=' . $key2 . ':Attr=' . $t_sCollectionAttribute, $val3);
								$t_aCollectionReplace[$key3] = '[[' . $t_aCollectionReplace[$key3] . ']]';
							
								$t_hCollectionTags[0][$key3] = "/\[\[" . $val3 . "\]\]/";
							}

							$t_sPartial = preg_replace($t_hCollectionTags[0], $t_aCollectionReplace, $t_sPartial, 1);

							if ($t_sType == 'RepeatedTable' && $key2 % $t_iPerRow == 0){$t_sNewContent .= '<tr>';}

							$t_sNewContent .= $t_sPartial;

							if ($t_sType == 'RepeatedTable' && ($key2 + 1) % $t_iPerRow == 0){$t_sNewContent .= '</tr>';}
						}
					}
				}
				if (substr($t_sNewContent, 5) != '</tr>' && $t_sType == 'RepeatedTable'){$t_sNewContent .= '</tr>';}
				if ($t_sType == 'RepeatedTable'){$t_sNewContent .= '</table>';}

				if (!isset($this->m_hVars[$t_sVar]) || sizeof($this->m_hVars[$t_sVar]) == 0)
					$t_sNewContent = $this->m_hVars[$t_sEmpty];

				// put in the new content
				$this->m_sContent = preg_replace("/\[\[CollectionStart:[a-z0-9\.\,:= ]*?Name=" . $t_sSectionName . "[a-z0-9\.\,:= ]*?\]\]([^\e]*?)\[\[CollectionEnd:Name=" . $t_sSectionName . "\]\]/i", $t_sNewContent, $this->m_sContent, 1);

			}
		}

		// replace tags within the sub content
		unset ($t_aReplace); unset ($t_hTags);
		$t_aReplace = array();

		$this->m_sContent = $this->contentReplace($this->m_sContent);

// COMBINE MAIN CONTENT INTO BASE TEMPLATE /////////////////////////////////////////////////////////////////////////////////////////////////////////

		if (!$this->m_bNoBase)
		{
			unset ($t_aReplace); unset ($t_hTags);
			$t_aReplace = array();
			preg_match_all("/\[\[Section[a-z0-9\.\,:=\(\) ]+\]\]/i", $this->m_sBaseContent, $t_hTags);

			foreach ($t_hTags[0] as $key => $val)
			{
				$t_sSectionName = '';
				// strip enclosing square brackets
				$val = substr($val, 2, strlen($val)-4);
				// explode by : character
				$t_aTagParts = explode(':', $val);
				if (sizeof($t_aTagParts) > 1)
				{
					foreach ($t_aTagParts as $key2 => $val2)
					{
						if ($key2 > 0)
						{
							$t_aSubParts = explode('=', $val2);
							if ($t_aSubParts[0] == 'Name')
							{
								$t_sSectionName = $t_aSubParts[1];
							}
						}
					}
				}

				if ($t_sSectionName)
				{
					// find corresponding section content in the sub content
					$t_sSubContent = '';

					preg_match("/\[\[SectionStart:Name=" . $t_sSectionName . "\]\]([^\e]*?)\[\[SectionEnd:Name=" . $t_sSectionName . "\]\]/i", $this->m_sContent, $t_aSection);
					if (isset($t_aSection[1]))
					{
						$t_sSubContent = $t_aSection[1];
						$t_aReplace[$key] = $t_sSubContent;
					}
					else 
					{
						$t_aReplace[$key] = '';
					}
				}

				// replace enclosing brackets for the replacement
				$t_hTags[0][$key] = "/\[\[" . $val . "\]\]/";
			}

			$this->m_sBaseContent = preg_replace($t_hTags[0], $t_aReplace, $this->m_sBaseContent, 1);
		}
		else
		{
			$this->m_sBaseContent = $this->m_sContent;
		}


		if ($p_bEchoResult)
			echo $this->m_sBaseContent;
		else
			return $this->m_sBaseContent;
	}
}

?>