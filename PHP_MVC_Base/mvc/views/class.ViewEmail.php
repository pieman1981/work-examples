<?php

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// ViewEmail
// Class for setting up the sending of an email using a template
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

class ViewEmail
{
	private $m_oEmail;

	function __construct($p_sTemplate, $p_oRecipient)
	{
		global $g_sSendingEmailAddress, $g_sSendingEmailName, $g_hViewVars;

		$this->m_oEmail = new EmailCommunication();
		$t_oRecipient2 = new EmailRecipient($g_sSendingEmailAddress, $g_sSendingEmailName);
		$this->m_oEmail->setIsHTML(true);
		$this->m_oEmail->addToRecipient($p_oRecipient);
		$this->m_oEmail->setSender($t_oRecipient2);

		$t_aNameParts = explode(' ', $p_oRecipient->getRecipientName());
		$g_hViewVars['FirstName'] = $t_aNameParts[0];
		// add subject and attachments
		switch ($p_sTemplate)
		{
			case 'Test':
				$this->m_oEmail->setSubject('Test');
				break;

			default:
				$this->m_oEmail->setSubject('no subject');
				break;
		}

		$t_oHTMLView = new ViewXHTML('email/EmailHTML' . $p_sTemplate . '.phtml', $g_hViewVars);
		$t_oTextView = new ViewXHTML('email/EmailText' . $p_sTemplate . '.phtml', $g_hViewVars);

		$this->m_oEmail->setBody($t_oHTMLView->render(false));
		$this->m_oEmail->setAltBody($t_oTextView->render(false));
	}

	function send()
	{
		try
		{
			$this->m_oEmail->send();
		}
		catch (Exception $e)
		{
			return false;
		}
		return true;
	}
}

?>