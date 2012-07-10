<?php

	class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
	{
		public function run()
		{
			// Chargement du plugin Global
			Zend_Controller_Front::getInstance()->registerPlugin(new My_Controller_Plugin_Global);		
			
			parent::run();
		}
		
		protected function _initAutoload()
		{
			$moduleLoader = new Zend_Application_Module_Autoloader(array(
				'namespace' => 'Application',
				'basePath' => APPLICATION_PATH));

			return $moduleLoader;
		}
		
		protected function _initModuleControllerDirectories()
		{
			$this->bootstrap('FrontController');
			$front =  $this->getResource('FrontController');
			
			// Liste des modules (noms)
			$modules = array();
			
			foreach($modules as $module)
			{
				$front->addControllerDirectory( APPLICATION_PATH . DIRECTORY_SEPARATOR . 'modules' . DIRECTORY_SEPARATOR . $module . DIRECTORY_SEPARATOR . 'controllers', $module);
			}
		}
	}