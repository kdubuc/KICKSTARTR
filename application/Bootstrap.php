<?php

	class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
	{
	
		public function run()
		{
			$this->loadNavigation();																									// On appel le navigation.xml
			Zend_Controller_Front::getInstance()->registerPlugin(new My_Controller_Plugin_Global);		// Chargement du plugin Global
			
			parent::run();
		}
		
		private function loadNavigation()
		{
		
			// On récupère la vue
			$view = $this->bootstrap('view')->getResource('view');
			
			// On assigne le navigation.xml à l'application
			$config = new Zend_Config_Xml(APPLICATION_PATH . '/configs/navigation.xml', 'nav');
			$view->navigation( new Zend_Navigation($config->toArray()) );
		}
		
		/*
		protected function _initModuleControllerDirectories()
		{
			$this->bootstrap('FrontController');

			$front =  $this->getResource('FrontController');
			
			$front->addControllerDirectory( APPLICATION_PATH . DIRECTORY_SEPARATOR . 'modules' . DIRECTORY_SEPARATOR . 'module' . DIRECTORY_SEPARATOR . 'controllers', 'module');
		}
		*/

	}