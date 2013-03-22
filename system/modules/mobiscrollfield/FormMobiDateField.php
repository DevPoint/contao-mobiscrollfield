<?php if (!defined('TL_ROOT')) die('You cannot access this file directly!');

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2011 Leo Feyer
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
 * This module is based on the module <calendarfield> created
 * by Andreas Schempp <andreas@schempp.ch>
 *
 * PHP version 5
 * @copyright  Wilfried Reiter 2012
 * @author     Wilfried Reiter <wilfried@creativity4me.com>
 * @license    http://opensource.org/licenses/lgpl-3.0.html
 * @version    $Id: FormMobiDateField.php 001 2012-04-24 09:00:00V wreiter $
 */


class FormMobiDateField extends FormTextField
{
	public function __construct($arrAttributes=false)
	{
		parent::__construct($arrAttributes);
		
		if ($this->rgxp != 'datim' && $this->rgxp != 'time')
			$this->rgxp = 'date';
	}
    
	public function generate()
	{
		$dateFormat = strlen($this->dateFormat) ? $this->dateFormat : $GLOBALS['TL_CONFIG'][$this->rgxp . 'Format'];
		$dateDirection = strlen($this->dateDirection) ? $this->dateDirection : '0';
		$jsEvent = $this->jsevent ? $this->jsevent : 'domready';
		
		if ($this->dateParseValue && $this->varValue != '')
		{
			$this->varValue = $this->parseDate($dateFormat, strtotime($this->varValue));
		}
		
        $dateFormatMs = $this->formatToMobiscroll($dateFormat);
		$strBuffer = parent::generate();
		
		if ($this->readonly || $this->disabled)
			return $strBuffer;
		
		$GLOBALS['TL_CSS'][] = 'plugins/mobiscroll/mobiscroll-1.6.min.css';
		$GLOBALS['TL_JAVASCRIPT'][] = 'plugins/mobiscroll/mobiscroll-1.6.min.js';

		switch ($this->rgxp)
		{
			case 'datim':
				break;

			case 'time':
				break;

			default:
				break;
		}
		
        $currentYear = intval(date('Y'));
        $startYear = 1900;
        $endYear = $currentYear + 10;
		switch ($dateDirection)
		{
			case '+1':
                $startYear = $currentYear;
				break;

			case '-1':
                $endYear = $currentYear;
				break;
		}
        $startYearStr = "\n        startYear:" . $startYear . ",";
        $endYearStr = "\n        endYear:" . $endYear . ",";

		$strBuffer .= 
  '<script>
	$("#ctrl_'. $this->strId . '").scroller({
        dateFormat:\'' . $dateFormatMs . '\',
        dateOrder:\'ddMyy\',' . $startYearStr . $endYearStr . '
        setText:\'' . $GLOBALS['TL_LANG']['mobiscrollfield']['setText'] . '\',
        cancelText:\'' . $GLOBALS['TL_LANG']['mobiscrollfield']['cancelText'] . '\',
        dayText:\'' . $GLOBALS['TL_LANG']['mobiscrollfield']['dayText'] . '\',
        monthText:\'' . $GLOBALS['TL_LANG']['mobiscrollfield']['monthText'] . '\',
        yearText:\'' . $GLOBALS['TL_LANG']['mobiscrollfield']['yearText'] . '\',
        monthNamesShort:[\''. implode("','", $this->createMonthShortNames()) . '\'],
        showValue:false,
        theme:\'android\',
        height:32,
        rows:5
     })
   </script>';
		return $strBuffer;
	}
	
	public function validator($varInput)
	{
		if (strlen($this->dateFormat))
		{
			// Disable regular date validation
			$this->rgxp = '';
			
			if (strlen($varInput) && !preg_match('/'. $this->getRegexp($this->dateFormat) .'/i', $varInput))
			{
				$objDate = new Date();
				$this->addError(sprintf($GLOBALS['TL_LANG']['ERR']['date'], $objDate->getInputFormat($this->dateFormat)));
			}
		}
		
		return parent::validator($varInput);
	}
	
	/**
	 * Return array of month name short versions
	 * @param  string
	 * @return string
	 */
    private function createMonthShortNames()
    {
        $monthShortNames = array();
        $monthShortLength = $GLOBALS['TL_LANG']['MSC']['monthShortLength'];
        foreach( $GLOBALS['TL_LANG']['MONTHS'] as $monthName)
        {
            $monthShortNames[] = mb_substr($monthName, 0, $monthShortLength, 'UTF-8');
        }
        return $monthShortNames;
    }
    
	/**
	 * Return date format suitable for mobiscroll plugin
	 * @param  string
	 * @return string
	 */
    private function formatToMobiscroll($format)
    {
        // convert year format
        $outputFormat = $format;
        $yearProcessed = strpos($outputFormat, 'Y');
        if (false !== $yearProcessed)
        {
            $outputFormat = str_replace('Y', 'yy', $outputFormat);
        }

        // convert month format
        $monthProcessed = strpos($outputFormat, 'm');
        if (false !== $monthProcessed)
        {
            $outputFormat = str_replace('m', 'mm', $outputFormat);
        }
        else
        {
            $monthProcessed = strpos($outputFormat, 'n');
            if (false !== $monthProcessed)
            {
                $outputFormat = str_replace('n', 'm', $outputFormat);
            }
            else
            {
                $monthProcessed = strpos($outputFormat, 'F');
                if (false !== $monthProcessed)
                {
                    $outputFormat = str_replace('F', 'MM', $outputFormat);
                }
            }        
        }        

        // convert day format
        $dayProcessed = strpos($outputFormat, 'd');
        if (false !== $dayProcessed)
        {
            $outputFormat = str_replace('d', 'dd', $outputFormat);
        }
        else
        {
            $dayProcessed = strpos($outputFormat, 'j');
            if (false !== $dayProcessed)
            {
                $outputFormat = str_replace('j', 'd', $outputFormat);
            }
        }    
        
        return $outputFormat;
    }
		
	/**
	 * Return a regular expression that matches a particular date format
	 * @param  string
	 * @param  string
	 * @return string
	 */
	private function getRegexp($strFormat=false, $strRegexpSyntax='perl')
	{
		if (!$strFormat)
		{
			$strFormat = $GLOBALS['TL_CONFIG']['dateFormat'];
		}

		if (preg_match('/[BbCcDEeFfIJKkLlMNOoPpQqRrSTtUuVvWwXxZz]+/', $strFormat))
		{
			throw new Exception(sprintf('Invalid date format "%s"', $strFormat));
		}

		$arrRegexp = array();
		$arrCharacters = str_split($strFormat);

		foreach ($arrCharacters as $strCharacter)
		{
			switch ($strCharacter)
			{
				// Patch day: allow 01 - 31
				case 'd':
					$arrRegexp[$strFormat]['perl']  .= '(0[1-9]|[12][0-9]|3[01])';
					$arrRegexp[$strFormat]['posix'] .= '(0[1-9]|[12][0-9]|3[01])';
					break;
				
				// Patch month: allow 01 - 12
				case 'm':
					$arrRegexp[$strFormat]['perl']  .= '(0[1-9]|1[012])';
					$arrRegexp[$strFormat]['posix'] .= '(0[1-9]|1[012])';
					break;
				
				// Patch year: allow 1900 - 2199
				case 'Y':
					$arrRegexp[$strFormat]['perl']  .= '(19|20|21)[0-9]{2,2}';
					$arrRegexp[$strFormat]['posix'] .= '(19|20|21)[[:digit:]]{2}';
					break;
					
				case 'a':
				case 'A':
					$arrRegexp[$strFormat]['perl']  .= '[apmAPM]{2,2}';
					$arrRegexp[$strFormat]['posix'] .= '[apmAPM]{2}';
					break;

				case 'y':
				case 'h':
				case 'H':
				case 'i':
				case 's':
					$arrRegexp[$strFormat]['perl']  .= '[0-9]{2,2}';
					$arrRegexp[$strFormat]['posix'] .= '[[:digit:]]{2}';
					break;

				case 'j':
				case 'n':
				case 'g':
				case 'G':
					$arrRegexp[$strFormat]['perl']  .= '[0-9]{1,2}';
					$arrRegexp[$strFormat]['posix'] .= '[[:digit:]]{1,2}';
					break;

				default:
					$arrRegexp[$strFormat]['perl']  .= preg_quote($strCharacter, '/');
					$arrRegexp[$strFormat]['posix'] .= preg_quote($strCharacter, '/');
					break;
			}
		}

		return $arrRegexp[$strFormat][$strRegexpSyntax];
	}
}

