<?php

	class My_Layout_Controller_Plugin_Layout extends Zend_Layout_Controller_Plugin_Layout {
	
		// Modular layout
		public function postDispatch(Zend_Controller_Request_Abstract $request) {
		
			$layout = $this->getLayout();
			
			if(null != ($path = file_exists(APPLICATION_PATH . '/modules/' . $request->getModuleName() . '/layouts/scripts'))) {
			
				$module = $request->getModuleName();
			}
			else {
			
				$module = 'default';
			}
			
			$layout->setLayoutPath(APPLICATION_PATH . '/modules/' . $module . '/layouts/scripts');
			
		
			parent::postDispatch($request);
		}
	}