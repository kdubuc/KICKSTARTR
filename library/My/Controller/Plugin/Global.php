<?php
	
	class My_Controller_Plugin_Global extends Zend_Controller_Plugin_Abstract {
	
		private $request;
		
		// On enregistre le plugin Global du module actuel
		public function routeShutdown(Zend_Controller_Request_Abstract $request) {
		
			$className = $request->getModuleName() != 'default' ? ucfirst(strtolower(trim($request->getModuleName()))) . '_Plugin_Global' : 'Application_Plugin_Global';
			
			if(!class_exists($className))
			{
				throw new Zend_Exception("Le plugin global n'a pas été trouvé.", 500);
			}
			
			Zend_Controller_Front::getInstance()->registerPlugin(new $className);
		}

		public function preDispatch(Zend_Controller_Request_Abstract $request)	{

			$this->request = $request;
			
			// On charge les ressources du module
			//$this->loadResources();

			// Désactive le layout quand une requete ajax est envoyée
			$this->disableLayoutAjax();
				
			// Chargement des aides d'actions en fonction du module
			$this->loadActionHelpers();
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
		private function loadResources() {
		
			$module = $this->request->getModuleName();
			
			if($module == 'default')
			{
				$module = 'Application';
			}
		
			$resourceLoader = new Zend_Loader_Autoloader_Resource(  
				array(
					'namespace' => ucfirst(strtolower(trim($module))),  
					'basePath' => $this->getModulePath()
				)
			);
			
			$resourceLoader->addResourceType('plugin', 'plugins/', 'Plugin');
			$resourceLoader->addResourceType('form', 'forms/', 'Form');
		}
		
		// Désactive le layout quand une requete ajax est envoyée
		private function disableLayoutAjax() {
		
			if( $this->request->isXmlHttpRequest() )
				Zend_Layout::getMvcInstance()->disableLayout();
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
		
		/*
		private function loadGlobalModulePlugin() {
		
			$module = $this->request->getModuleName();

			$className = ucfirst(strtolower(trim($module))) . '_Plugin_Global';
			
			$className = 'Application_Plugin_Global';
			
			$resourceLoader = new Zend_Loader_Autoloader_Resource(  
				array(
					'namespace' => 'Application',  
					'basePath' => APPLICATION_PATH
				)
			);
			
			$resourceLoader->addResourceType('plugin', 'plugins/', 'Plugin');

			
		}
		*/
		
	}