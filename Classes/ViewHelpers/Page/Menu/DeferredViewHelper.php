<?php
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2013 Claus Due <claus@wildside.dk>, Wildside A/S
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 * ************************************************************* */

/**
 * ### Page: Deferred menu rendering ViewHelper
 *
 * Place this ViewHelper inside any other ViewHelper which
 * has been configured with the `deferred` attribute set to
 * TRUE - this will cause the output of the parent to only
 * contain the content of this ViewHelper.
 *
 * @author Claus Due <claus@wildside.dk>, Wildside A/S
 * @package Vhs
 * @subpackage ViewHelpers\Page
 */
class Tx_Vhs_ViewHelpers_Page_Menu_DeferredViewHelper extends Tx_Vhs_ViewHelpers_Page_Menu_AbstractMenuViewHelper {

	/**
	 * @param string $as
	 * @return string
	 * @throws Exception
	 */
	public function render($as = NULL) {
		if (FALSE === $this->viewHelperVariableContainer->exists('Tx_Vhs_ViewHelpers_Page_Menu_AbstractMenuViewHelper', 'deferredArray')) {
			throw new Exception('A deferred menu was attempted rendered without a deferring parent having inserted a page array. ' .
				'Did you remember to set "deferred" on the parent menu of v:page.menu.deferred? If your parent menu VH is custom, ' .
				'did you respect the same rules as the built-in menu ViewHelpers', 1370096135);
		}
		if (FALSE === $this->viewHelperVariableContainer->exists('Tx_Vhs_ViewHelpers_Page_Menu_AbstractMenuViewHelper', 'deferredString')) {
			throw new Exception('A deferred menu was attempted rendered without a deferring parent having inserted a pre-rendered menu ' .
				'as string. Did you remember to set "deferred" on the parent menu of v:page.menu.deferred? If your parent menu VH is custom, ' .
				'did you respect the same rules as the built-in menu ViewHelpers', 1370096155);
		}
		if (NULL === $as) {
			return $this->viewHelperVariableContainer->get('Tx_Vhs_ViewHelpers_Page_Menu_AbstractMenuViewHelper', 'deferredString');
		} elseif (TRUE === empty($as)) {
			throw new Exception('An "as" attribute was used but was empty - use a proper string value', 1370096373);
		}
		if ($this->templateVariableContainer->exists($as)) {
			$backupVariable = $this->templateVariableContainer->get($as);
			$this->templateVariableContainer->remove($as);
		}
		$this->templateVariableContainer->add($as, $this->viewHelperVariableContainer->get('Tx_Vhs_ViewHelpers_Page_Menu_AbstractMenuViewHelper', 'deferredArray'));
		$content = $this->renderChildren();
		$this->templateVariableContainer->remove($as);
		if (TRUE === isset($backupVariable)) {
			$this->templateVariableContainer->add($as, $backupVariable);
		}
		return $content;
	}

}
