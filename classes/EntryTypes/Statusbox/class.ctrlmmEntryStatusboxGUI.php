<?php
/* Copyright (c) 1998-2010 ILIAS open source, Extended GPL, see docs/LICENSE */
require_once('./Customizing/global/plugins/Services/UIComponent/UserInterfaceHook/CtrlMainMenu/classes/Entry/class.ctrlmmEntryGUI.php');


/**
 * ctrlmmEntryStatusboxGUI
 *
 * @author  Fabian Schmid <fs@studer-raimann.ch>
 * @version 2.0.02
 *
 */
class ctrlmmEntryStatusboxGUI extends ctrlmmEntryGUI {

	/**
	 * @var ctrlmmEntryStatusbox
	 */
	public $entry;


	/**
	 * @param string $entry_div_id
	 * @return string
	 */
	public function renderEntry($entry_div_id = '') {
		unset($entry_div_id);
		$this->tpl->addCss('./Customizing/global/plugins/Services/UIComponent/UserInterfaceHook/CtrlMainMenu/templates/css/statusbox.css');

		$this->html = $this->pl->getVersionTemplate('tpl.menu_statusbox.html', false, true);
		$this->html->setVariable('ICON', ilUtil::getImagePath('icon_mail_s.png'));
		$this->html->setVariable('CSS_ID', 'ctrl_mm_e_' . $this->entry->getId());
		$this->html->setVariable('LINK', $this->entry->getLink());
		$this->html->setVariable('CSS_PREFIX', ctrlmmMenu::getCssPrefix());
		$this->html->setVariable('NEWMAIL', $this->entry->getNewMailCount());
		$this->html->setVariable('TARGET', $this->entry->getTarget());
		$this->html->setVariable('STATE', ($this->entry->isActive() ? ilCtrlMainMenuConfig::getConfigValue(ilCtrlMainMenuConfig::F_CSS_ACTIVE) : ilCtrlMainMenuConfig::getConfigValue(ilCtrlMainMenuConfig::F_CSS_INACTIVE)));

		return $this->html->get();
	}
}


