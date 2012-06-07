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
	 
		public function output($my_key = null, $template = '<li class="alert alert-%s" ><button data-dismiss="alert" class="close">&times;</button><h4 class="alert-%s">%s</h4>%s</li>') {

			// On récupère les messages
			$array_messages = $this->getMessages();

			// On initialise la chaine de sortie
			$output = '';

			// On stocke les messages
			foreach ($array_messages as $row_message) {

				$key = $row_message["context"];

				if($my_key == null || $key == $my_key ) {

					$output .= sprintf($template, $key, $key, $row_message["title"], $row_message["message"]);
				}
			}

			return $output;
		}

		public function getMessages() {
		
			// Messages
			//$array_messages = $this->_fm->getMessages();
			
			// Messages en cours
			$array_currentMessages = $this->_fm->getCurrentMessages();

			// return array_merge($array_currentMessages, $array_messages);
			return $array_currentMessages;
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
