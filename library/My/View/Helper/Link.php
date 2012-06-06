<?php
	
	class My_View_Helper_Link extends Zend_View_Helper_Url {
		
		//public function link($controllerName = null, $actionName = null, $moduleName = null, $params = '', $name= 'default', $reset = true) {
		public function link($string_label, array $urlOptions = array(), $reset = false) {
			
			$name= 'default'; // ?
			
			$object_frontController = Zend_Controller_Front::getInstance();
			
			$controllerName = array_key_exists('controller', $urlOptions) ? $urlOptions['controller'] : null;
			$actionName = array_key_exists('action', $urlOptions) ? $urlOptions['action'] : null;
			$moduleName = array_key_exists('module', $urlOptions) ? $urlOptions['module'] : null;
			$params = array_key_exists('params', $urlOptions) ? $urlOptions['params'] : '';
			
			if($controllerName === null) {
				$controllerName = $object_frontController->getRequest()->getParam('controller');
			}
			
			if($actionName === null) {
				$actionName = $object_frontController->getRequest()->getParam('action');
			}
			
			if($moduleName === null) {
				$moduleName = $object_frontController->getRequest()->getParam('module');
			}
			
			if(is_array($params)) {
				$params = '?'.http_build_query($params);
			}
			
			$url = parent::url(array('controller' => $controllerName, 'action' => $actionName, 'module' => $moduleName), $name, $reset) . $params;
			
			return "<a href=\"$url\">$string_label</a>";
		}
	}