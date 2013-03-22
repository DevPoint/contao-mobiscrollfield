<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2010 Leo Feyer
 *
 * Formerly known as TYPOlight Open Source CMS.
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 3 of the License, or (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 * 
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at <http://www.gnu.org/licenses/>.
 *
 * PHP version 5
 * @copyright  Janosch Skuplik :: Web- und Mediendesign0
 * @author     Janosch Skuplik <http://www.janosch-skuplik.de>
 * @package    UseJQuery
 * @license    LGPL
 * @filesource
 */


/**
 * Table tl_layout
 */
$GLOBALS['TL_DCA']['tl_layout']['palettes']['__selector__'][] = 'usejquery';

$GLOBALS['TL_DCA']['tl_layout']['palettes']['default'] = str_replace('mooSource,','mooSource,usejquery,',$GLOBALS['TL_DCA']['tl_layout']['palettes']['default']);

$GLOBALS['TL_DCA']['tl_layout']['subpalettes']['usejquery'] = 'jquerySource,jqueryVersion,jqueryNoConflict';

$GLOBALS['TL_DCA']['tl_layout']['fields']['usejquery'] = array(
  'label'                   => &$GLOBALS['TL_LANG']['tl_layout']['usejquery'],
	'exclude'                 => true,
	'inputType'               => 'checkbox',
	'eval'                    => array('submitOnChange'=>true,'tl_class'=>'w50 m12')
);

$GLOBALS['TL_DCA']['tl_layout']['fields']['jquerySource'] = array(
  'label'                   => &$GLOBALS['TL_LANG']['tl_layout']['jquerySource'],
	'default'                 => 'jquery_local',
	'exclude'                 => true,
	'inputType'               => 'select',
	'options'                 => array('jquery_local', 'jquery_googleapis', 'jquery_microsoft', 'jquery_jquery'),
	'reference'               => &$GLOBALS['TL_LANG']['tl_layout'],
	'eval'                    => array('tl_class'=>'w50')
);

$GLOBALS['TL_DCA']['tl_layout']['fields']['jqueryVersion'] = array(
  'label'                   => &$GLOBALS['TL_LANG']['tl_layout']['jqueryVersion'],
	'default'                 => '1.6.1',
	'exclude'                 => true,
	'inputType'               => 'select',
	'options_callback'        => array('tl_layout_jquery', 'getVersions'),
	'eval'                    => array('tl_class'=>'w50')
);

$GLOBALS['TL_DCA']['tl_layout']['fields']['jqueryNoConflict'] = array(
  'label'                   => &$GLOBALS['TL_LANG']['tl_layout']['jqueryNoConflict'],
	'exclude'                 => true,
	'inputType'               => 'checkbox',
	'eval'                    => array('tl_class'=>'w50 m12')
);



/**
 * Class tl_layout_jquery
 *
 * Provide miscellaneous methods that are used by the data configuration array.
 * @copyright  Janosch Skuplik :: Web- und Mediendesign0
 * @author     Janosch Skuplik <http://www.janosch-skuplik.de>
 * @package    UseJQuery
 */
class tl_layout_jquery extends Backend
{

	/**
	 * Return all versions of implemented jQuery-versions as array
	 * @return array
	 */
	public function getVersions()
	{
		$versions = array();

		foreach ($GLOBALS['TL_JQUERY_VERSION'] as $k=>$v)
		{
      $versions[] = $k;
		}

		return $versions;
	}
}

?>