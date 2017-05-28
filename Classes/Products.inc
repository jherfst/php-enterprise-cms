<?php

require 'Page.inc';

class Products extends Pagina
{
var $Content3;
function DisplayContent()
{
	echo '<div id="body">';
  
	echo '<div id="Column1">';
		echo $this->DisplayMenu();
	echo '</div>';
	
	
	echo '<div id="Column4">';
			
		echo $this->Content3;
		echo '</div>';		
		echo '</div>';
			echo '</div></center>';

}		
	
}


?>