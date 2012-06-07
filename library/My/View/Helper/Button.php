<?php
	/*
		Helper pour créer un bouton à partir d'un lien
	*/
	class My_View_Helper_Button extends Zend_View_Helper_HtmlElement {
	
		public $view;

		public function setView(Zend_View_Interface $view) {
		
			$this->view = $view;
		}
	
		public function button($label, $url = null, $attribs = null, $icon = null) {
		
			// Ajout de la classe btn
			if(isset($attribs["class"]))
			{
				$attribs["class"] .= " btn";
			}
			else
			{
				$attribs["class"] = "btn";
			}
		
			// Gestion des attributs
			$attribs = $this->_htmlAttribs($attribs);

			// Construction de l'url
			if( is_array($url) ) {
			
				$url = $this->view->url( $url );
			}
			
			// Si il y a une icone de spécifiée, on la formalise
			if($icon != null) {
			
				$icon = '<i class="'.$icon.'" ></i>';
			}
			else {
			
				$icon = "";
			}
			
			return '<a href="'.$url.'" '.$attribs.'  >'.$icon. ($icon != null ? ' ' : '') .$label.'</a>';

		}
	}
