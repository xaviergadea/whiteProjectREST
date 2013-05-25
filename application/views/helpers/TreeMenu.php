<?php

class Zend_View_Helper_TreeMenu
{

    public $view = null;
	
    /*
     * $filter: values= images(jpg, gif, png), all, mime(doc,docx,exl,ppt)
     */
    public function treeMenu($destination, $filter, $name)
    {
		$this->showDir($destination, $filter, $name);
		$html='<style type="text/css">
<!--
.rollover a { display:block; width:32px; background-color: #FFFFFF}
.rollover a:hover { background-color: #990000}
-->
</style>
<ul class="arbo with-title">
					<li>
						<span class="title-search">'.$name.'</span>
						<ul>';
		$html.=$this->showDir($destination, $filter);
		$html.='</ul>
				</li>
			</ul>';
		return $html;
	}
	
	public function showDir($destination, $filter)
    {
    	$html='';
    	if($destination)
		{
			$dir = new DirectoryIterator($destination);
			foreach($dir as $fileInfo) {
				if($fileInfo->isDot()) 
				{
				// do nothing
				} 
				elseif ($fileInfo->isDir()) 
				{
					$html.='<li class="closed"><span class="toggle"></span>';
					$html.='<span class="folder">'.$fileInfo->__toString().'</span>';
					$html.='<ul>';
					$html.=$this->showDir($fileInfo->getPathname(),$filter);
					$html.='</ul></li>';
				}
			 	else {
			 		$html.=$this->showFile($fileInfo, $filter);
			 		
					
				}
			}
		}
		return $html;	
    }
    
    public function showFile($fileInfo, $filter)
    {
    	$html='';
    	$path = pathinfo($fileInfo->getPathname());
    	$modal=preg_replace('/[^0-9a-zа-яіїё\`\~\!\@\#\$\%\^\*\(\)\; \,\'\_\-]/i', '_',$fileInfo->getPathname()); 
//    	Zend_Debug::dump($modal);
    	$arr=getimagesize($fileInfo->getPathname());
    	$image_info=getimagesize($fileInfo->getPathname());
    	list($width, $height, $type, $attribs) = getimagesize($fileInfo->getPathname());
    	
    	
    	$dir=substr($path['dirname'], strpos($path['dirname'],'/assets/'));
 		if(in_array($path['extension'], array('jpg', 'gif', 'png')))
 					$doctype='document-image';
 				else
 					$doctype='document-web';
 		switch($filter)
 		{
 			case 'images':
 				if(in_array($path['extension'], array('jpg', 'gif', 'png'))){
// 				echo $fileInfo->getPathname();
// 				$thumb = getimagesize($fileInfo->getPathname());
//    	Zend_Debug::dump($thumb);
//    	$image = exif_thumbnail($fileInfo->getPathname());
//    	echo "<img   src='data:image/gif;base64,".base64_encode($image)."'>";
//    	echo "<img   src='data:image/gif;base64,".base64_encode($fileInfo->getPathname())."'>";
//    	Zend_Debug::dump($fileInfo->getOwner());
//    	die;
 				$html.='<li>
		 					<span class="'.$doctype.'">'.$fileInfo->__toString().'
		 						<strong>'.$path['extension'].'</strong>: 
	 							<span class="empty">
	 								'.ceil($fileInfo->getSize()/(1024)).' Kb 
	 								<a href="#'.$modal.'-modal" rel="modal" title="s">view</a>
	 								
										<a href="#"><img src="'.$dir.'/'.$fileInfo->__toString().'"	height="32" border="0"></a>
									
	 								<div id="'.$modal.'-modal" style="display: none"> 
										<h3>'.$fileInfo->__toString().'</h3> 
										<p>
											<strong>'.ceil($fileInfo->getSize()/(1024)).' Kb,  '.date('dS M Y', $fileInfo->getMTime()).' </strong> by '.$fileInfo->getOwner('name').'<br />
											<div style="border:2px solid #C0C0C0; background-color:#ccc" >
												<img border="2" src="'.$dir.'/'.$fileInfo->__toString().'" width="370"  border="0">
											</div>	
											'.$fileInfo->getPathname().'<br/>
											width: '.$width.'px; height: '.$height.'px; mime: '.$image_info['mime'].'<br/>
												
										</p> 
										<p>
											<strong>Options:</strong><br />
											<ul>
												<li>
													<a href="#" class="remove-link" title="Remove message">Autorename</a>
													<small>lowercase, no space, no punctuation, no simbols.</small>
												</li>
												<li>
													<a href="#" class="remove-link" title="Remove message">Remove</a>
													<small>delete from disk, not from db.</small>
												</li>
											</ul>		
										</p>	
									</div> <!-- End #messages -->
	 								
	 							</span>
		 					</span>
 						</li>';		
 				}
 			break;
 			case 'all':			 				
 				$html.='<li>
		 					<span class="'.$doctype.'">'.$fileInfo->__toString().'
		 						<strong>'.$path['extension'].'</strong>: 
	 							<span class="empty">
	 								'.ceil($fileInfo->getSize()/(1024)).' Kb <a href="content/structure/special.html">view</a>
	 								
	 							</span>
		 					</span>
 						</li>';		
 			break;
 			case 'mime':
 				
 			break;
 		}
 		return $html;
    }

}
