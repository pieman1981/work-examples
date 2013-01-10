<?php

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// FixedPDF
// Create a PDF from static templates
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

class FixedPDF
{
	private $m_sFileName = '';
	private $m_sSaveDirectory = './temp/';
	private $m_sFontDirectory = './pdf/';
	private $m_sTemplateDirectory = './pdf/';
	private $m_sMasterPassword = 'chaucer';
	private $m_iPageWidth = 595;
	private $m_iPageHeight = 842;

	private $m_aTemplates;
	private $m_hFonts = array();
	private $m_hReplacements = array();
	private $m_hImages = array();

	function __construct()
	{
	}

	function setBlock($p_sBlock, $p_sData, $p_iTemplateNo = 0)
	{
		if ($p_iTemplateNo)
			$this->m_hReplacements[$p_iTemplateNo][$p_sBlock] = $p_sData;
		else
		{
			for ($i = 1; $i <= sizeof($this->m_aTemplates); $i++)
			{
				$this->m_hReplacements[$i][$p_sBlock] = $p_sData;
			}
		}
	}
	function insertImage($p_sBlock, $p_sFile, $p_iTemplateNo = 0)
	{
		if ($p_iTemplateNo)
			$this->m_hImages[$p_iTemplateNo][$p_sBlock] = $p_sFile;
		else
		{
			for ($i = 1; $i <= sizeof($this->m_aTemplates); $i++)
			{
				$this->m_hImages[$i][$p_sBlock] = $p_sFile;
			}
		}
	}

	function resetBlocks()
	{
		unset($this->m_hReplacements);
		$this->m_hReplacements = array();
		unset($this->m_hImages);
		$this->m_hImages = array();
	}

	function resetPageDimensions($p_bLandscape = false)
	{
		$this->m_iPageWidth = 595;
		$this->m_iPageHeight = 842;
		if ($p_bLandscape)
		{
			$this->m_iPageWidth = 842;
			$this->m_iPageHeight = 595;
		}
	}

	function addTemplate($p_sString)
	{
		$this->m_aTemplates[] = $p_sString;
	}

	function addFont($p_sAlias, $p_sFile)
	{
		$this->m_hFonts[$p_sAlias] = $p_sFile;
	}

	function setFileName($p_sString)
	{
		$this->m_sFileName = $p_sString;
	}

	function setTemplateDirectory($p_sString)
	{
		$this->m_sTemplateDirectory = $p_sString;
	}

	// returns a string upon error, otherwise empty or false
	function generate()
	{
		global $g_sPDFLibKey;

		if ($this->m_sFileName && sizeof($this->m_aTemplates))
		{
			// destroy any existing file with this name
			if (file_exists($this->m_sSaveDirectory . $this->m_sFileName))
			{
				unlink($this->m_sSaveDirectory . $this->m_sFileName);
			}

			// create the PDF object
			if ($t_oPDF = PDF_new())
			{
				PDF_set_parameter($t_oPDF, 'license', $g_sPDFLibKey);

				// load any custom fonts
				if (sizeof($this->m_hFonts))
				{
					foreach ($this->m_hFonts as $key => $val)
					{
						PDF_set_parameter($t_oPDF, "FontOutline", $key . "=" . $this->m_sFontDirectory . $val);
					}
				}

				// start the document
				if (PDF_begin_document($t_oPDF, $this->m_sSaveDirectory . $this->m_sFileName, 
					'compatibility=1.6 masterpassword=' . $this->m_sMasterPassword . ' permissions={nocopy nomodify}'))
				{
					// loop through each template
					foreach ($this->m_aTemplates as $key => $t_sTemplate)
					{
						// check for landscape portrait
						if (substr($t_sTemplate, (strlen($t_sTemplate) - 3), 3) == '~ls')
						{
							$this->resetPageDimensions(true);
							$t_sTemplate = substr($t_sTemplate, 0, strlen($t_sTemplate) - 3);
						}
						else
						{
							$this->resetPageDimensions(false);
						}

						// import the current template
						if ($t_oTemplate = PDF_open_pdi($t_oPDF, $this->m_sTemplateDirectory . $t_sTemplate, 'password=' . $this->m_sMasterPassword, 0))
						{
							// reset the page counter
							$t_iPageNo = 1;

							// loop through each page of the template
							while ($t_oPage = PDF_open_pdi_page($t_oPDF, $t_oTemplate, $t_iPageNo, ''))
							{
								// begin a new page
								PDF_begin_page_ext($t_oPDF, $this->m_iPageWidth, $this->m_iPageHeight, '');
								PDF_fit_pdi_page($t_oPDF, $t_oPage, 0.0, 0.0, '');

								// loop through each block to be replaced and insert the required value
								if (isset($this->m_hReplacements[$key + 1]) && sizeof($this->m_hReplacements[$key + 1]))
								{
									foreach($this->m_hReplacements[$key + 1] as $key2 => $val)
									{
										PDF_fill_textblock($t_oPDF, $t_oPage, $key2, $val, 'embedding=true');
									}
								}

								if (isset($this->m_hImages[$key + 1]) && sizeof($this->m_hImages[$key + 1]))
								{
									foreach($this->m_hImages[$key + 1] as $key2 => $val)
									{
										$t_oImage = PDF_load_image($t_oPDF, 'auto', $val, '');
										PDF_fill_imageblock($t_oPDF, $t_oPage, $key2, $t_oImage, '');
									}
								}

								// end the page
								PDF_close_pdi_page($t_oPDF, $t_oPage);
								PDF_end_page_ext($t_oPDF, '');
							
								// go on to the next page of the template
								$t_iPageNo++;
							}

							// close the template
							PDF_close_pdi($t_oPDF, $t_oTemplate);
						}
						else
						{
							return 'unable to load template: ' . PDF_get_errmsg($t_oPDF);
						}
					}

					// end the document
					PDF_end_document($t_oPDF, '');
	
					chmod($this->m_sSaveDirectory . $this->m_sFileName, 0644);
				}
				else
				{
					return 'unable to create document: ' . PDF_get_errmsg($t_oPDF);
				}

				// delete the PDF object
				PDF_delete($t_oPDF);
			}
			else
			{
				return 'unable to create PDF object';
			}
		}
		else
		{
			if (!$this->m_sFileName)
				return 'no filename';
			else
				return 'no template specified';
		}
	}

}

?>