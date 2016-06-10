<?php
	class FormOne  extends Controller {
		function __construct ( $params ) {
			parent::__construct();
			$this -> view -> controller = "FormOne";			
			$this -> view -> Render();
			
			//$model = new Model ();			
			//$model -> ShowArray ( $params );
			//echo '<br /> witaj Kontrolerze Usera <br />';
		}
	}
?>