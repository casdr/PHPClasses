<?php
/**
 * Howto
 * 
 * Script:
 * <?php
 * require('language.php');
 * $lang = new lang('file_with_language_data.php');
 * $lang->get('welcome.hello', array('name'=>'Cas'));
 * 
 * file_with_language_data.php:
 * <?php
 * return array(
 * 	'welcome' => array(
 * 		'hello' => 'Hello :name, how are you today?'
 * 	)
 * );
**/
class lang {

	public static $file = '';
	public static $data = array();

	public function __construct($file) {
		if(is_file($file)) {
			$this->file = $file;
			$this->data = require($file);
			return true;
		} else {
			return false;
		}
	}
	public function get($string='', $args=array()) {
		$layers = explode('.', $string);
		$key = '$this->data';
		foreach($layers as $sub) {
			$key .= '["'.$sub.'"]';
		}
		$string = eval('return '.$key.';');
		$return = $this->replace($string, $args);
		return $return;
	}
	public function replace($string='', $args=array()) {
    if(strpos($string, ':') !== false)
    {
      $expl = explode(':', $string);
      for($i = 0; $i < count($expl); $i++)
      {
        if(array_key_exists($expl[$i], $args))
        {
          $expl[$i] = $args[$expl[$i]];
        }
        elseif($i % 2 != 0)
          $expl[$i] .= ':';
      }
      return implode('', $expl);
    }
    else
      return $string;
	}
}
