<?php
/**
 * mm_hideSections
 * @version 1.1 (2012-11-13)
 * 
 * @desc A widget for ManagerManager plugin that allows one or a few default sections to be hidden on the document edit page.
 * 
 * @uses ManagerManager plugin 0.4.
 * 
 * @param $sections {'content'; 'tvs'} - The name(s) of the sections this should apply to. @required
 * @param $roles {comma separated string} - The roles that the widget is applied to (when this parameter is empty then widget is applied to the all roles). Default: ''.
 * @param $templates {comma separated string} - Id of the templates to which this widget is applied (when this parameter is empty then widget is applied to the all templates). Default: ''.
 * 
 * @link http://code.divandesign.biz/modx/mm_hidesections/1.1
 * 
 * @copyright 2012
 */

function mm_hideSections($sections, $roles = '', $templates = ''){
	global $modx;
	$e = &$modx->Event;
	
	// if we've been supplied with a string, convert it into an array
	$sections = makeArray($sections);
	
	// if the current page is being edited by someone in the list of roles, and uses a template in the list of templates
	if (useThisRule($roles, $templates)){
		$output = "//  -------------- mm_hideSections :: Begin ------------- \n";
		
		foreach($sections as $section){
			switch ($section){
				case 'content':
					$output .= '
					$j("#content_header").hide();
					$j("#content_body").hide();
					';
				break;
				
				case 'tvs':
					$output .= '
					$j("#tv_header").hide();
					$j("#tv_body").hide();
					';
				break;
				
				case 'access': // These have moved to tabs in 1.0.1
					$output .= '
					$j("#sectionAccessHeader").hide();
					$j("#sectionAccessBody").hide();';
				break;
			}
			
			$output .= "//  -------------- mm_hideSections :: End ------------- \n";
			
			$e->output($output . "\n");
		}
	}
}
?>