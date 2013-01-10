<?php

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// DynamicPDF
// Create a complete PDF on the fly
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

class DynamicPDF
{
	private $m_iPDFHandle;

	private $m_sFileName = '';
	private $m_sSaveDirectory = './temp/';
	private $m_sFontDirectory = './images/';
	private $m_sImageDirectory = './images/';
	private $m_sMasterPassword = 'chaucer';
	private $m_iPageWidth = 595;
	private $m_iPageHeight = 842;

	public $m_iMarginLeft = 40;
	public $m_iMarginRight = 555;
	public $m_iMarginTop = 40;
	public $m_iMarginBottom = 802;

	private $m_hTextFlows = array();
	private $m_aFonts = array();
	private $m_aImages = array();
	private $m_hStyles = array();
	private $m_hTableOptions = array();
	private $m_aTables = array();

	function __construct($p_sFileName)
	{
		global $g_sPDFLibKey;

		$this->m_sFileName = $p_sFileName;

		if ($this->m_iPDFHandle = PDF_new())
		{
			PDF_set_parameter($this->m_iPDFHandle, 'license', $g_sPDFLibKey);

			if (PDF_begin_document($this->m_iPDFHandle, $this->m_sSaveDirectory . $this->m_sFileName, 'compatibility=1.6 masterpassword=' . $this->m_sMasterPassword . ' permissions={nocopy nomodify}'))
			{
			}
			else
			{
				throw new Exception('unable to create PDF document');
			}
		}
		else
		{
			throw new Exception('unable to create PDF object');
		}
	}

	function endPDF()
	{
		PDF_end_document($this->m_iPDFHandle, '');
		PDF_delete($this->m_iPDFHandle);
		if (file_exists($this->m_sSaveDirectory . $this->m_sFileName))
		{
			chmod($this->m_sSaveDirectory . $this->m_sFileName, 0644);
		}
		return $this->m_sFileName;
	}

	function loadFont($p_sName)
	{
		$i = PDF_load_font($this->m_iPDFHandle, $p_sName, 'auto', '');
		$this->m_aFonts[] = $i;
		return $i;
	}

	function loadImage($p_sName)
	{
		$i = PDF_load_image($this->m_iPDFHandle, 'auto', $this->m_sImageDirectory . $p_sName, '');
		$this->m_aImages[] = $i;
		return $i;
	}

	function addStyle($p_sName, $p_sStyle)
	{
		$this->m_hStyles[$p_sName] = $p_sStyle;
	}

	function addTextFlow($p_sName, $p_sContent, $p_sStyle)
	{
		$i = PDF_create_textflow($this->m_iPDFHandle, $p_sContent, $this->m_hStyles[$p_sStyle]);
		$this->m_hTextFlows[$p_sName] = $i;
		return $i;
	}

	function placeTextFlow($p_sTextFlow, $p_iY)
	{
		PDF_fit_textflow($this->m_iPDFHandle, $this->m_hTextFlows[$p_sTextFlow], $this->m_iMarginLeft, $p_iY, $this->m_iMarginRight, $this->m_iMarginBottom, 'fitmethod=auto');
		PDF_delete_textflow($this->m_iPDFHandle, $this->m_hTextFlows[$p_sTextFlow]);
	}

	function placeTextLine($p_iFont, $p_sContent, $p_iX, $p_iY, $p_iFontSize = 9, $p_fR = 0.0, $p_fG = 0.0, $p_fB=0.0)
	{
		PDF_setfont($this->m_iPDFHandle, $this->m_aFonts[$p_iFont], $p_iFontSize);
		PDF_fit_textline($this->m_iPDFHandle, $p_sContent, $p_iX, $p_iY, 'fillcolor={rgb ' . $p_fR . ' ' . $p_fG . ' ' . $p_fB . '}');
	}

	function placeImage($p_iImage, $p_iX, $p_iY, $p_iWidth = 0, $p_iHeight = 0)
	{
		PDF_fit_image($this->m_iPDFHandle, $this->m_aImages[$p_iImage], $p_iX, $p_iY, ($p_iWidth ? 'boxsize={' . $p_iWidth . ' ' . $p_iHeight . '} ' : '') . 'fitmethod=auto');
	}

	function startPage($p_bLandscape = false)
	{
		if ($p_bLandscape)
		{
			PDF_begin_page_ext($this->m_iPDFHandle, $this->m_iPageHeight, $this->m_iPageWidth, 'topdown');
			$this->m_iMarginLeft = 40;
			$this->m_iMarginRight = $this->m_iPageHeight - 40;
			$this->m_iMarginTop = 40;
			$this->m_iMarginBottom = $this->m_iPageWidth - 40;
		}
		else
		{
			PDF_begin_page_ext($this->m_iPDFHandle, $this->m_iPageWidth, $this->m_iPageHeight, 'topdown');
			$this->m_iMarginLeft = 40;
			$this->m_iMarginRight = $this->m_iPageWidth - 40;
			$this->m_iMarginTop = 40;
			$this->m_iMarginBottom = $this->m_iPageHeight - 40;
		}
	}

	function orientate($p_bLandscape = false)
	{
		if ($p_bLandscape)
		{
			$this->m_iMarginLeft = 40;
			$this->m_iMarginRight = $this->m_iPageHeight - 40;
			$this->m_iMarginTop = 40;
			$this->m_iMarginBottom = $this->m_iPageWidth - 40;
		}
		else
		{
			$this->m_iMarginLeft = 40;
			$this->m_iMarginRight = $this->m_iPageWidth - 40;
			$this->m_iMarginTop = 40;
			$this->m_iMarginBottom = $this->m_iPageHeight - 40;
		}
	}

	function endPage()
	{
		PDF_end_page_ext($this->m_iPDFHandle, '');
	}


	function beginTemplate($p_iWidth = 0, $p_iHeight = 0)
	{
		return PDF_begin_template($this->m_iPDFHandle, $p_iWidth, $p_iHeight);
	}
	function endTemplate()
	{
		PDF_end_template($this->m_iPDFHandle);
	}

	// tables

	function addTableOption($p_sName, $p_iColumnWidth, $p_sTextFlow = '', $p_iFont = 0, $p_sHorizontalAlign = 'left', $p_sVerticalAlign = 'top', 
		$p_iFontSize = 9, $p_iMargin = 5, $p_iColSpan = 1, $p_iRowSpan = 1, $p_fR = 0.0, $p_fG = 0.0, $p_fB=0.0, $p_iRowHeight = 0, $p_iImage = -1, $p_sImagePosition = 'center', $p_bNoSideMargin = false, $p_sImageScale = '{1 1}')
	{
		$t_sString = 'fittextline={position={' . $p_sHorizontalAlign . ' ' . $p_sVerticalAlign . '} font=' . $this->m_aFonts[$p_iFont] . ' fillcolor={rgb ' . $p_fR . ' ' . $p_fG . ' ' . $p_fB . '} fontsize=' . $p_iFontSize . '} margin=' . $p_iMargin . ' colwidth=' . $p_iColumnWidth . ' ' . ($p_iRowHeight ? 'rowheight=' . $p_iRowHeight . ' ' : '') . ' ' . ($p_iImage > -1 ? 'image=' . $this->m_aImages[$p_iImage] . ' fitimage={fitmethod=clip scale=' . $p_sImageScale . ' position=' . $p_sImagePosition . '} ' : '') . 'colspan=' . $p_iColSpan . ' rowspan=' . $p_iRowSpan;
		if ($p_sTextFlow != '')
		{
			$t_sString .= ' margintop=1 fittextflow={verticalalign=' . $p_sVerticalAlign . '} textflow=' . $this->m_hTextFlows[$p_sTextFlow];
		}
		else if ($p_sVerticalAlign != 'bottom')
		{
			$t_sString .= ' marginbottom=' . $p_iMargin; //' . ($p_iMargin+11); // 0
		}
		else
		{
			$t_sString .= ' marginbottom=' . ($p_iMargin+2);
		}
		if ($p_bNoSideMargin)
		{
			$t_sString .= ' marginleft=0 marginright=0 marginbottom=0';
		}
		$this->m_hTableOptions[$p_sName] = $t_sString;
	}

	function startTable($p_iColumn, $p_iRow, $p_sContent, $p_sTableOption)
	{
		$t_iNewNum = PDF_add_table_cell($this->m_iPDFHandle, 0, $p_iColumn, $p_iRow, $p_sContent, $this->m_hTableOptions[$p_sTableOption]);
		$this->m_aTables[] = $t_iNewNum;
		return $t_iNewNum;
	}

	function addCell($p_iTableNum, $p_iColumn, $p_iRow, $p_sContent, $p_sTableOption)
	{
		PDF_add_table_cell($this->m_iPDFHandle, $p_iTableNum, $p_iColumn, $p_iRow, $p_sContent, $this->m_hTableOptions[$p_sTableOption]);
	}

	function placeTableEx($p_iTableNum, $p_iX1, $p_iY1, $p_iX2, $p_iY2 , $p_bSplit = false, $p_fR = 0.0, $p_fG = 0.0, $p_fB = 0.0, $p_fLineWidth = 0.5, $p_fLineWidthInner = 0)
	{
		return PDF_fit_table($this->m_iPDFHandle, $p_iTableNum, $p_iX1, $p_iY1, $p_iX2, $p_iY2, 'vertshrinklimit=100% stroke={{line=frame linewidth=' . $p_fLineWidth . ' strokecolor={rgb ' . $p_fR . ' ' . $p_fG . ' ' . $p_fB . '}} {line=other linewidth=' . $p_fLineWidthInner . ' strokecolor={rgb ' . $p_fR . ' ' . $p_fG . ' ' . $p_fB . '}}}' . ($p_bSplit ? ' header=1' : ''));
	}

	function placeTable($p_iTableNum, $p_iY, $p_iPaddingBottom = 0, $p_bSplit = false, $p_fR = 0.0, $p_fG = 0.0, $p_fB = 0.0, $p_fLineWidth = 0.5, $p_fLineWidthInner = 0)
	{
		$this->placeTableEx($p_iTableNum, $this->m_iMarginLeft, $p_iY, $this->m_iMarginRight, $this->m_iMarginBottom, $p_bSplit, $p_fR, $p_fG, $p_fB, $p_fLineWidth, $p_fLineWidthInner);
		$p_iY += $this->getTableHeight($p_iTableNum) + $p_iPaddingBottom;
		$this->endTable($p_iTableNum);
		return $p_iY;
	}

	function placeTableSplit($p_iTableNum, $p_iY, $p_fR = 0.0, $p_fG = 0.0, $p_fB = 0.0)
	{
		return $this->placeTableEx($p_iTableNum, $this->m_iMarginLeft, $p_iY, $this->m_iMarginRight, $this->m_iMarginBottom, true, $p_fR, $p_fG, $p_fB);
	}

	function getTableHeight($p_iTableNum)
	{
		return PDF_info_table($this->m_iPDFHandle, $p_iTableNum, 'height');
	}
	function getTableWidth($p_iTableNum)
	{
		return PDF_info_table($this->m_iPDFHandle, $p_iTableNum, 'width');
	}

	function endTable($p_iTableNum)
	{
		PDF_delete_table($this->m_iPDFHandle, $p_iTableNum, '');
	}

}

?>