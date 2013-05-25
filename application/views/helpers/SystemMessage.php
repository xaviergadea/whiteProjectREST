<?php

class Zend_View_Helper_SystemMessage extends Zend_View_Helper_Abstract 
{

    public function systemMessage($options)
    {
    	$html="<div class=\"section\">					
						<ul class=\"system_messages\">";
			if(@$options['neutral'])$html.="<li class=\"white\"><span class=\"ico\"></span><strong class=\"system_title\">".$options['neutral']."</strong></li>";
			if(@$options['error'])$html.="<li class=\"red\"><span class=\"ico\"></span><strong class=\"system_title\">".$options['error']."</strong></li>";
			if(@$options['tip'])$html.="<li class=\"blue\"><span class=\"ico\"></span><strong class=\"system_title\">".$options['tip']."</strong></li>";
			if(@$options['ok'])$html.="<li class=\"green\"><span class=\"ico\"></span><strong class=\"system_title\">".$options['ok']."</strong></li>";
			if(@$options['warning'])$html.="<li class=\"yellow\"><span class=\"ico\"></span><strong class=\"system_title\">".$options['warning']."</strong></li>";
			$html.="</ul>
					</div>";
		return $html;
    }  
}