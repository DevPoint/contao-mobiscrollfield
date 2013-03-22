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
 
// InsertTag
$GLOBALS['TL_HOOKS']['generatePage'][] = array('UseJQuery', 'check_jQuery');

//Array of versions and paths
$GLOBALS['TL_JQUERY_VERSION'] = array(
  '1.7.1' => array(
    'jquery_local' => 'plugins/jquery/js/jquery-1.7.1.min.js',
    'jquery_jquery' => 'http://code.jquery.com/jquery-1.7.1.min.js',
    'jquery_googleapis' => 'https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js',
    'jquery_microsoft' => 'http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.7.1.min.js'
  ),
  '1.7' => array(
    'jquery_local' => 'plugins/jquery/js/jquery-1.7.min.js',
    'jquery_jquery' => 'http://code.jquery.com/jquery-1.7.min.js',
    'jquery_googleapis' => 'https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js',
    'jquery_microsoft' => 'http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.7.min.js'
  ),
  '1.6.4' => array(
    'jquery_local' => 'plugins/jquery/js/jquery-1.6.4.min.js',
    'jquery_jquery' => 'http://code.jquery.com/jquery-1.6.4.min.js',
    'jquery_googleapis' => 'https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js',
    'jquery_microsoft' => 'http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.6.4.min.js'
  ),
  '1.6.3' => array(
    'jquery_local' => 'plugins/jquery/js/jquery-1.6.3.min.js',
    'jquery_jquery' => 'http://code.jquery.com/jquery-1.6.3.min.js',
    'jquery_googleapis' => 'https://ajax.googleapis.com/ajax/libs/jquery/1.6.3/jquery.min.js',
    'jquery_microsoft' => 'http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.6.3.min.js'
  ),
  '1.6.2' => array(
    'jquery_local' => 'plugins/jquery/js/jquery-1.6.2.min.js',
    'jquery_jquery' => 'http://code.jquery.com/jquery-1.6.2.min.js',
    'jquery_googleapis' => 'https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js',
    'jquery_microsoft' => 'http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.6.2.min.js'
  ),
  '1.6.1' => array(
    'jquery_local' => 'plugins/jquery/js/jquery-1.6.1.min.js',
    'jquery_jquery' => 'http://code.jquery.com/jquery-1.6.1.min.js',
    'jquery_googleapis' => 'https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js',
    'jquery_microsoft' => 'http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.6.1.min.js'
  ),
  '1.6' => array(
    'jquery_local' => 'plugins/jquery/js/jquery-1.6.min.js',
    'jquery_jquery' => 'http://code.jquery.com/jquery-1.6.min.js',
    'jquery_googleapis' => 'https://ajax.googleapis.com/ajax/libs/jquery/1.6.0/jquery.min.js',
    'jquery_microsoft' => 'http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.6.min.js'
  ),
  '1.5.2' => array(
    'jquery_local' => 'plugins/jquery/js/jquery-1.5.2.min.js',
    'jquery_jquery' => 'http://code.jquery.com/jquery-1.5.2.min.js',
    'jquery_googleapis' => 'https://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js',
    'jquery_microsoft' => 'http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.5.2.min.js'
  ),
  '1.5.1' => array(
    'jquery_local' => 'plugins/jquery/js/jquery-1.5.1.min.js',
    'jquery_jquery' => 'http://code.jquery.com/jquery-1.5.1.min.js',
    'jquery_googleapis' => 'https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js',
    'jquery_microsoft' => 'http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.5.1.min.js'
  ),
  '1.5' => array(
    'jquery_local' => 'plugins/jquery/js/jquery-1.5.min.js',
    'jquery_jquery' => 'http://code.jquery.com/jquery-1.5.min.js',
    'jquery_googleapis' => 'https://ajax.googleapis.com/ajax/libs/jquery/1.5.0/jquery.min.js',
    'jquery_microsoft' => 'http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.5.min.js'
  )
);

?>