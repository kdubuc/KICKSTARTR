<?php
	/*
		Helper pour créer un bouton à partir d'un lien
	*/
	class My_View_Helper_Button extends Zend_View_Helper_HtmlElement {
	
		public $view;

		public function setView(Zend_View_Interface $view) {
		
			$this->view = $view;
		}
	
		public function button($name, $icon = null, $url = null, $attribs = false) {
		
			// Attributs en plus
			if ($attribs) {
			
				$attribs = $this->_htmlAttribs($attribs);
			}
			else {
			
				$attribs = '';
			}
		
			// Construction de l'url
			if( is_array($url) ) {
			
				$url = $this->view->url( $url );
			}
			
			// Si il y a une icone de spécifiée, on la formalise
			if($icon != null) {
			
				$icon = '<i class="button-icon button-icon-'.$icon.'" ></i>';
			}
			else {
			
				$icon = "";
			}
			
			return '<a href="'.$url.'" '.$attribs.'  role="button" >'.$icon.'<span>'.$name.'</span></a>';

		}
	}
