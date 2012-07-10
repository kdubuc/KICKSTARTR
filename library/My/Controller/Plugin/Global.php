<?php
	
	class My_Controller_Plugin_Global extends Zend_Controller_Plugin_Abstract {
	
		private $request;
		
		public function routeShutdown(Zend_Controller_Request_Abstract $request) {
		
			// On charge les ressources du module autre que defaut
			$this->loadModuleResources($request->getModuleName());
		
			// On enregistre le plugin Global du module actuel
			$className = $request->getModuleName() != 'default' ? ucfirst(strtolower(trim($request->getModuleName()))) . '_Plugin_Global' : 'Application_Plugin_Global';

			if(!class_exists($className))
			{
				throw new Zend_Exception('Le plugin global n\'a pas été trouvé.', 500);
			}
			
			Zend_Controller_Front::getInstance()->registerPlugin(new $className);
		}

		public function preDispatch(Zend_Controller_Request_Abstract $request)	{

			$this->request = $request;

			// Désactive le layout quand une requete ajax est envoyée
			if( $this->request->isXmlHttpRequest() )
				Zend_Layout::getMvcInstance()->disableLayout();
				
			// Chargement de la navigation XML (+ fusion avec le XML de navigation du module courant)
			$view = Zend_Controller_Front::getInstance()->getParam('bootstrap')->getResource('view');
			$config = new Zend_Config_Xml(APPLICATION_PATH . '/configs/navigation.xml', 'nav');
			$view->navigation( new Zend_Navigation($config->toArray()) );
				
			// Chargement des aides d'actions en fonction du module
			// $this->loadActionHelpers();
		}
		
		// Récupère le lien vers la racine du module
		private function getModulePath() {
		
			$module = $this->request->getModuleName();
			
			if($module == 'default') {
			
				return APPLICATION_PATH;
			}
			else {
			
				return APPLICATION_PATH . DIRECTORY_SEPARATOR . 'modules' . DIRECTORY_SEPARATOR . $module;
			}
		}
		
		// On charge les ressources du module
		private function loadModuleResources($module) {
			
			if($module != 'default')
			{
				$resourceLoader = new Zend_Loader_Autoloader_Resource(  
					array(
						'namespace' => ucfirst(strtolower(trim($module))),  
						'basePath' => APPLICATION_PATH . DIRECTORY_SEPARATOR . 'modules' . DIRECTORY_SEPARATOR . $module
					)
				);
				
				$resourceLoader->addResourceType('plugin', 'plugins/', 'Plugin');
				// $resourceLoader->addResourceType('form', 'forms/', 'Form');
			}
		}
		
		// Chargement des aides d'actions en fonction du module
		private function loadActionHelpers() {
		
			// Get the controller directory by module
		
			/*
			$module = $this->request->getModuleName();
			$controller = $this->request->getControllerName();
			
			$path = Zend_Controller_Front::getInstance()->getControllerDirectory($module) . DIRECTORY_SEPARATOR . 'helpers';
			$namespace = ucfirst(strtolower(trim($module))) . '_Controller_Helper_';
			
			Zend_Controller_Action_HelperBroker::addPath($path, $namespace);
			*/
		}
		
	}