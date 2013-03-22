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
 * @copyright  Janosch Skuplik :: Web- und Mediendesign0
 * @author     Janosch Skuplik <http://www.janosch-skuplik.de>
 * @package    UseJQuery
 * @license    LGPL
 * @filesource
 */
define('JQUERY','1.5');
 
class UseJQuery extends PageRegular {
  public function check_jQuery($objPage, $objLayout, $objPageRegular) 
  {
    //Kompatibilitaet mit aelterer Version
    if (!defined('TL_PLUGINS_URL'))
    {
    	define('TL_PLUGINS_URL','');
    }

    if ($objLayout->mooSource == 'moo_jq_local' || $objLayout->mooSource == 'moo_jq_google')
    {
      $objLayout->usejquery = true;
      if ($objLayout->mooSource == 'moo_jq_local')
      {
        $objLayout->jquerySource = 'jquery_local';
      }
      else
      {
        $objLayout->jquerySource = 'jquery_googleapis';
      }
    }
    
    if ($objLayout->usejquery)
    {
      $strScriptType = ($objPage->outputFormat == 'xhtml' || version_compare(VERSION.'.'.BUILD, '2.10.0', '<')) ? ' type="text/javascript"' : '';
      $strSrc = (($objLayout->jquerySource=='jquery_local') ? TL_PLUGINS_URL : '') . $GLOBALS['TL_JQUERY_VERSION'][$objLayout->jqueryVersion][$objLayout->jquerySource];
      $strSrc = $strSrc ? $strSrc : (TL_PLUGINS_URL . 'plugins/jquery/js/jquery-1.6.2.min.js');
      $this->jQueryScripts = '<script' . $strScriptType . ' src="' . $strSrc . '"></script>' . "\n";

      if ($objLayout->jqueryNoConflict)
      {
        $objPageRegular->Template->mooScripts .= $this->jQueryScripts;
      }
      else
      {
        $objPageRegular->Template->mooScripts = $this->jQueryScripts;
      }
    }
  }  
}
?>