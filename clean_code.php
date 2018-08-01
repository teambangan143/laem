<?php
/*------------------------------------------------------------------------
# aixeena_clean_code.php - Aixeena CLean Code (plugin)
# ------------------------------------------------------------------------
# version		3.5.1
# author    	@ciroartigot for Aixeena.org
# copyright 	Copyright (c) 2013 CiroArtigot. All rights reserved.
# @license 		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites 		http://aixeena.org/
-------------------------------------------------------------------------
*/

// no direct access
/*defined('_JEXEC') or die('Restricted access');

jimport('joomla.plugin.plugin');*/

class plgSystemAixeena_Clean_Code extends JPlugin
{
	function plgSystemAixeena_Clean_Code(& $subject, $params ){
		parent::__construct( $subject, $params );
	}
	
	function onAfterRender(){
	
		global $_PROFILER;
		$app	= JFactory::getApplication();
		$document = JFactory::getDocument();
		if ($app->isAdmin()) return;
		if ($document->getType() != 'html') return;
		$document = JFactory::getDocument();
		$headerstuff = $document->getHeadData(); 
		$buffer = JResponse::getBody();
		
		$ip = $_SERVER['REMOTE_ADDR'];
		//echo $ip;
		
		// remove meta generator
		if($this->params->get('meta_generator',1))	$buffer = preg_replace( '/<meta\s*name="Generator"\s*content=".*\/>/isU','', $buffer);
		
		// remove base href
		if($this->params->get('base_href',1))	$buffer = preg_replace( '/<base.*\/>/isU','', $buffer);
		
		$buffer = preg_replace( '/<!--(.|\s)*?-->/' , '' , $buffer );
		
		// remove unuseful scripts
		preg_match_all('#<script(.*?)<\/script>#is', $buffer, $matches);
		$scriptkeys2 =  explode(',', str_replace("\n", ",", $this->params->get('scriptsarray2', null)));	
		foreach ($matches[0] as $value) {	
			if(plgSystemAixeena_Clean_Code::strpos_array($value, $scriptkeys2) )  $buffer = str_replace($value, '', $buffer);	
		}	
		
		if($this->params->get('clean',1))	 {	
			$buffer = plgSystemAixeena_Clean_Code::clean_html_code($buffer);
			// preserve scripts without linebreaks
			preg_match_all('#<script(.*?)<\/script>#is', $buffer, $matches);
			foreach ($matches[0] as $value) {	
				//if(strrpos($value, "src=")===false) {
				
					//echo 'x';
					$value2 = str_replace("'text/javascript'","\"text/javascript\"",$value);
					$value2 = preg_replace("/[\n\r]/","",$value2);
					$value2 = preg_replace(array('/\s{2,}/', '/[\t\n]/'), ' ', $value2);
					$buffer      = str_replace($value, $value2, $buffer	);
				//}
			}

			// clean empty tags
			preg_match_all('#<span[^>]*(?:/>|>(?:\s|&nbsp;)*</span>)#im', $buffer, $matchesall);
			foreach ($matchesall[0] as $value) {				
				$buffer = str_replace($value, plgSystemAixeena_Clean_Code::get_clean_tag($value),$buffer);			
			}

			preg_match_all('#<div[^>]*(?:/>|>(?:\s|&nbsp;)*</div>)#im', $buffer, $matchesall);
			foreach ($matchesall[0] as $value) {				
				$buffer = str_replace($value, plgSystemAixeena_Clean_Code::get_clean_tag($value),$buffer);			
			}

			preg_match_all('#<script[^>]*(?:/>|>(?:\s|&nbsp;)*</script>)#im', $buffer, $matchesall);
			foreach ($matchesall[0] as $value) {				
				//$buffer = str_replace($value, plgSystemAixeena_Clean_Code::get_clean_tag($value),$buffer);			
			}
		}
		
		JResponse::setBody($buffer);
	}
	
	function get_clean_tag($value) {
		
		$value2 = preg_replace('/\r\n+|\r+|\n+|\t+/i', '', $value);
		$value2 = trim(preg_replace('/\t+/', '', $value2));
		$value2 = preg_replace('/\s+/', ' ', $value2);
		$value2 = str_replace('> </', '></', $value2);	
		return $value2;
	}
	
	
	function fix_newlines_for_clean_html($fixthistext)
	{
		$fixthistext_array = explode("\n", $fixthistext);
		foreach ($fixthistext_array as $unfixedtextkey => $unfixedtextvalue)
		{
			if (!preg_match("/^(\s)*$/", $unfixedtextvalue))
			{
				$fixedtextvalue = preg_replace("/>(\s|\t)*</U", ">\n<", $unfixedtextvalue);
				$fixedtext_array[$unfixedtextkey] = $fixedtextvalue;
			}
		}
		return implode("\n", $fixedtext_array);
	}

	function onBeforeCompileHead() {
	
		$app	= JFactory::getApplication();
		if ($app->isAdmin()) return;
	
		$disablescripts_array =  explode(',', str_replace("\n", ",", $this->params->get('scriptsarray', null)));
		
		if (!empty($disablescripts_array )) {
			foreach ($disablescripts_array  as $script) {
				$this->disableScript(trim($script));
			}
		}
		
		/*
			/media/system/js/caption.js
			/media/jui/js/bootstrap.min.js
			/media/jui/js/jquery-noconflict.js
			/media/jui/js/jquery-migrate.min.js
			/media/system/js/html5fallback.js
			/media/system/js/mootools-core.js
			/media/system/js/core.js
			/media/system/js/mootools-more.js
			/media/system/js/modal.js
			/media/jui/js/chosen.jquery.min.js
			/media/jui/js/ajax-chosen.min.js
		*/
		
		$disablecss_array =  explode(',', str_replace("\n", ",", $this->params->get('cssarray', null)));
		
		if (!empty($disablecss_array )) {
			foreach ($disablecss_array  as $css) {
				$this->disableStylesheet(trim($css));
			}
		}
	
		return true;
	}
	
	
	private function strpos_array($haystack, $needles) {
		
			$resultado = 0;
			foreach ($needles as $str) {
				if($str) {
					$str =  trim($str);	
					$pos = strpos($haystack, $str);	
					if ($pos !== FALSE) $resultado = 1;	
				}
			}
		
			
			return $resultado;
	}

	private function disableScript($script)
	{
		$app	= JFactory::getApplication();
		if ($app->isAdmin()) return;
		
		$script = trim($script);

		if (!empty($script))
		{
			$doc = JFactory::getDocument();
			$uri = JUri::getInstance();

			$relativePath   = trim(str_replace($uri->getPath(), '', JUri::root()), '/');
			$relativeScript = trim(str_replace($uri->getPath(), '', $script), '/');
			$relativeUrl    = str_replace($relativePath, '', $script);

			// Try to disable relative and full URLs
			unset($doc->_scripts[$script]);
			unset($doc->_scripts[$relativeUrl]);
			unset($doc->_scripts[JUri::root(true) . $script]);
			unset($doc->_scripts[$relativeScript]);
		}
	}
	
	private function disableStylesheet($css)
	{
		$app	= JFactory::getApplication();
		if ($app->isAdmin()) return;
		
		$script = trim($css);

		if (!empty($css))
		{
			$doc = JFactory::getDocument();
			$uri = JUri::getInstance();

			$relativePath   = trim(str_replace($uri->getPath(), '', JUri::root()), '/');
			$relativeScript = trim(str_replace($uri->getPath(), '', $css), '/');
			$relativeUrl    = str_replace($relativePath, '', $css);
			
			// Try to disable relative and full URLs
			unset($doc->_styleSheets[$css]);
			unset($doc->_styleSheets[$relativeUrl]);
			unset($doc->_styleSheets[JUri::root(true) . $css]);
			unset($doc->_styleSheets[$relativeScript]);
		}
	}


	function clean_html_code($uncleanhtml)
	{
		$indent = "    ";
		$indent_cty = $this->params->get('indent_width',1);
        $indent = str_repeat (" ", $indent_cty);
		
		$indent = "    ";

		$fixed_uncleanhtml = plgSystemAixeena_Clean_Code::fix_newlines_for_clean_html($uncleanhtml);
		$uncleanhtml_array = explode("\n", $fixed_uncleanhtml);
		
		$indentlevel = 0;
		foreach ($uncleanhtml_array as $uncleanhtml_key => $currentuncleanhtml)
		{
			//Removes all indentation
			$currentuncleanhtml = preg_replace("/\t+/", "", $currentuncleanhtml);
			$currentuncleanhtml = preg_replace("/^\s+/", "", $currentuncleanhtml);
			
			$replaceindent = "";
			
			//Sets the indentation from current indentlevel
			for ($o = 0; $o < $indentlevel; $o++)
			{
				$replaceindent .= $indent;
			}
			
			//If self-closing tag, simply apply indent
			if (preg_match("/<(.+)\/>/", $currentuncleanhtml))
			{ 
				$cleanhtml_array[$uncleanhtml_key] = $replaceindent.$currentuncleanhtml;
			}
			//If doctype declaration, simply apply indent
			else if (preg_match("/<!(.*)>/", $currentuncleanhtml))
			{ 
				$cleanhtml_array[$uncleanhtml_key] = $replaceindent.$currentuncleanhtml;
			}
			//If opening AND closing tag on same line, simply apply indent
			else if (preg_match("/<[^\/](.*)>/", $currentuncleanhtml) && preg_match("/<\/(.*)>/", $currentuncleanhtml))
			{ 
				$cleanhtml_array[$uncleanhtml_key] = $replaceindent.$currentuncleanhtml;
			}
			//If closing HTML tag or closing JavaScript clams, decrease indentation and then apply the new level
			else if (preg_match("/<\/(.*)>/", $currentuncleanhtml) || preg_match("/^(\s|\t)*\}{1}(\s|\t)*$/", $currentuncleanhtml))
			{
				$indentlevel--;
				$replaceindent = "";
				for ($o = 0; $o < $indentlevel; $o++)
				{
					$replaceindent .= $indent;
				}
				
				$cleanhtml_array[$uncleanhtml_key] = $replaceindent.$currentuncleanhtml;
			}
			//If opening HTML tag AND not a stand-alone tag, or opening JavaScript clams, increase indentation and then apply new level
			else if ((preg_match("/<[^\/](.*)>/", $currentuncleanhtml) && !preg_match("/<(link|meta|base|br|img|hr)(.*)>/", $currentuncleanhtml)) || preg_match("/^(\s|\t)*\{{1}(\s|\t)*$/", $currentuncleanhtml))
			{
				$cleanhtml_array[$uncleanhtml_key] = $replaceindent.$currentuncleanhtml;
				
				$indentlevel++;
				$replaceindent = "";
				for ($o = 0; $o < $indentlevel; $o++)
				{
					$replaceindent .= $indent;
				}
			}
			else
			//Else, only apply indentation
			{$cleanhtml_array[$uncleanhtml_key] = $replaceindent.$currentuncleanhtml;}
		}
		//Return single string seperated by newline
		return implode("\n", $cleanhtml_array);	
	}
	
}

	/*
		// Remove JCaption JS calls
		JCaption
		hasTooltip

		$this->disableScript('/media/system/js/caption.js');
		$this->disableScript('/media/jui/js/bootstrap.min.js');
		return true;
		*/

?>