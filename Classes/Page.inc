<?php
//////////////////////// Dit structuur is aan de hand van het PHP boek Programmeren 3//////////////////////////////////////////////
class Pagina
{

	var $Content1;
	var $Content2;
	var $Content3;
	var $CompanyLogo = "1";
	var $CompanyUrl = "Home.php";
    var $Slogon ="Slogon";
    var $title = "Allstore";
	var $ProductCategory;
    var $Links = '';
	var $Topitems = array('Car' => 'Honda', 'Scooter' => 'Fox');
    var $keywords ="All in one Store";
	var $Events ="";
	var $PageStyle = "Classic";
	
function SetPageStyle($NewStyle)
{
	$this->PageStyle =$NewStyle;
}	
function SetScreen($NewEvents)
{
	$this->Events =$NewEvents;
}	
function SetHeaderLinks($newLinks)
{
	$this->Links ="<ul>$newLinks</ul>";
}	
function SetLogo($newLogo,$logoUrl)
{
	$this->CompanyLogo =$newLogo;
	$this->CompanyUrl =$logoUrl;
}
function SetProductCategory($NewProductCategory)
{
	$this->ProductCategory =$NewProductCategory;
}
function SetSlogon($newSlogon)
{
	$this->Slogon =$newSlogon;
}
function Setcontent1($newcontent1)
{
	$this->Content1 =$newcontent1;
}
function Setcontent2($newcontent2)
{
	$this->Content2 =$newcontent2;
}
function Setcontent3($newcontent3)
{
	$this->Content3 =$newcontent3;
}
function SetTitle($newtitle)
{
	$this->title =$newtitle;
}
function SetKeywords($newkeywords)
{
	$this->keywords =$newkeywords;
}

function DisplayTitle()
{
	echo "<title> $this->title</title>";
	
}

function DisplayKeyWords()
{
	echo "<META name=\"keywords\" content=\" $this->keywords\">";

}

function DisplayStyles()
{
	Echo '<link href="Styles/AppThemes/'.$this->PageStyle.'.css" rel="stylesheet" type="text/css" media="screen" />';
  
  Echo ' <link rel="stylesheet" href="Styles/themes/default/default.css" type="text/css" media="screen" />';
  Echo '  <link rel="stylesheet" href="Styles/themes/pascal/pascal.css" type="text/css" media="screen" />';
   Echo ' <link rel="stylesheet" href="Styles/themes/orman/orman.css" type="text/css" media="screen" />';
  Echo '  <link rel="stylesheet" href="Styles/nivo-slider.css" type="text/css" media="screen" />';
  Echo '  <script type="text/javascript" src="js/jquery.js"></script>';
 Echo ' <script type="text/javascript" src="js/slider.js"></script>';
  Echo '<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>';
    Echo '<script type="text/javascript" src="js/jquery.nivo.slider.pack.js"></script>';
    Echo '<script type="text/javascript">';
    Echo '$(window).load(function() {';
     Echo '   $("#slider").nivoSlider();';
  Echo '  });';
     Echo '</script>';
	}			
function DisplayHeader()
{   
//<a href="#">PRODUCTS</a>

	echo '<div id="Header"><center><div id="HeaderWrap"><div id="Logo"><a href="'.$this->CompanyUrl.'"><img src="Images/Companies/'. $this->CompanyLogo .'.png" alt="" width="180" height="132" /></a></div><div id="Slogon">'. $this->Slogon . '</div><div id="menuheader">'. $this->Links .'</div><div id="Search"><form>Search <input type="text" name ="SEARCH" id="SearchText"></form></div>	</div></center></div>';
}			
function DisplayScreen()
{
	echo '
	<center>
	
 <div id="Wrapper">
 
	  <div class="slider-wrapper theme-default">
            <div class="ribbon"></div>
            <div id="slider" class="nivoSlider">
            '.$this->Events.'
            
            </div>
            <div id="htmlcaption" class="nivo-html-caption">
                <strong>This</strong> is an example of a <em>HTML</em> caption with <a href="#">a link</a>.
            </div>
        </div>
 
';
}	
function DisplayMenu()
{
	echo '<div id ="menuCategory">'. $this -> ProductCategory .' </div>'; 
}
function DisplaytoptenItems($Saleitems)
{
	echo '<div id = "Screen">Screen</div>';
}
function DisplayContent()
{
	echo '<div id="body">';
  
	echo '<div id="Column1">';
		echo $this->DisplayMenu();
	echo '</div>';
		echo '<div id="Column2">';
		echo $this->Content1;
			
		echo '</div>';
		echo '<div id="textwrap">';
		echo '<div id="Column3">';
			
		echo $this->Content2;
		echo '</div>';
		echo '</div>';	
	echo '<div id="Column4">';
			
		echo $this->Content3;
		echo '</div>';		
		echo '</div>';
			echo '</div></center>';

}	
function DisplayFooter()
{  
	echo '<center><div id="footer"><div id="Wrapperfooter">Copy right 2012 ~ Programmeren 3 PTC Suriname</div></div></center>';
}	
function Display()
{
	echo "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN' 'http://www.w3.org/TR/html4/loose.dtd'>\n<html>\n<head>\n";
     echo  $this->DisplayTitle();
    echo  $this->DisplayKeyWords();
	echo $this->DisplayStyles();
	echo "</head>\n<body>\n";
		echo $this->DisplayHeader();
				echo $this->DisplayScreen();
	echo $this->DisplayContent();
	echo  $this->DisplayFooter();
	 echo"</body>\n</html>";
}		
	
}


?>