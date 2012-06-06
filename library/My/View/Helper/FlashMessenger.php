<?php

	class My_View_Helper_FlashMessenger extends Zend_View_Helper_Abstract {

		protected $_fm;

		public function flashMessenger() {
			
			return $this;
		}
	 
		public function __construct() {

			$this->_fm = Zend_Controller_Action_HelperBroker::getStaticHelper('FlashMessenger');
		}
		
		public function clearMessages() {
		
			$this->_fm->clearMessages();
		}
	 
		public function output($my_key = null, $template = '<li class="%s" >%s</li>') {

			// On récupère les messages
			$array_messages = $this->getMessages();

			// On initialise la chaine de sortie
			$output = '';

			// On stocke les messages
			foreach ($array_messages as $row_message) {

				if (is_array($row_message)) {

					list($key, $row_message) = each($row_message);
				}

				if($my_key == null || $key == $my_key ) {

					$output .= sprintf($template, $key, $row_message);
				}
			}

			return $output;
		}

		public function getMessages() {
		
			// Messages
			$array_messages = $this->_fm->getMessages();
			
			// Messages en cours
			$array_currentMessages = $this->_fm->getCurrentMessages();

			return array_merge($array_currentMessages, $array_messages);
		}

		public function hasMessages() {

			return count($this->_fm) + count($this->_fm->getCurrentMessages());
		}
	 
		public function getIterator() {

			return $this->_fm->getIterator();
		}
	 
		public function count() {
			return $this->_fm->count();
		}
	}
