<?php
	/*
		Helper pour un placeholder d'un module
	*/
	class My_View_Helper_PlaceholderModule {

		private $_name;
		private $_path;
	
		public function placeholderModule($name) {
		
			$this->_name = $name;
			$this->_path = APPLICATION_PATH.'/modules/'.Zend_Controller_Front::getInstance()->getRequest()->getModuleName().'/layouts/scripts/placeholders/'.$name.'.phtml';
			return $this;
		}
		
		public function exists() {

			return file_exists($this->_path);
		}
		
		public function output() {

			include($this->_path);
		}
		
	}
