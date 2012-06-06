<?php
	
	class Application_Plugin_Global extends Zend_Controller_Plugin_Abstract {
	
		public function preDispatch(Zend_Controller_Request_Abstract $request)	{

			// On récupère la vue
			$view = Zend_Controller_Front::getInstance()->getParam('bootstrap')->getResource('view');
			
			// On définit le titre de l'application
			$view->headTitle("KICKSTARTR")
				->setSeparator(" | ")
				->append(strip_tags( $view->navigation()->breadcrumbs()->setMinDepth(0)->setSeparator(" > ") ));
				
			// On lie les feuilles de style
			$view->headLink()
				->appendStylesheet("/css/core/core.css")
				->appendStylesheet("/css/style.css");
				
			// Balises META de l'application
			$view->headMeta()
				->appendName('viewport', 'width=device-width,initial-scale=1')
				->appendName('description', 'KICKSTATR - Description de l\'app')
				->appendName('author', 'Kévin DUBUC')
				->appendName('keywords', 'KICKSTATR, tags')
				->appendHttpEquiv('X-UA-Compatible', 'IE=edge,chrome=1');
				
			// Scripts éxecutés en fin de page
			$view->inlineScript()
			->appendFile("//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js")
			->appendFile("/js/libs/twitter.bootstrap.js")
			->appendFile("/js/script.js")
			->appendFile("/js/plugins.js");
				
			// Icône du site
			$view->headLink()
				->headLink(array("rel" => "shortcut icon", "href" => "/images/favicon.ico"));
		}
	}