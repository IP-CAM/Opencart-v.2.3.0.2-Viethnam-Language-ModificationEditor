<?php
class Ci {
    public $_init_library;

    private  $registry;

    public function __construct($registry) {
        $this->registry = $registry;
    }

    public function __get($key) {
        return $this->registry->get($key);
    }

    public function __set($key, $value) {
        $this->registry->set($key, $value);
    }

    // helper
	public function helper($helpers, $folder = 'ci') {
	   if(is_string($helpers)) {
	       $helpers = strtolower($helpers);
	       $helper  = preg_replace('/[^a-zA-Z0-9_\/]/', '', $helpers);
	       $fileName = DIR_FRAMEWORK_PATH . $folder . DS . 'helpers' . DS . $helpers .'_helper.php';
	       if(file_exists($fileName)) require_once $fileName;
	   }
	   elseif(is_array($helpers)) {
	       $helpers = array_flip($helpers);
	       $helpers = array_change_key_case($helpers, CASE_LOWER);
	       $helpers = array_flip($helpers);
	       foreach ($helpers as $helper) {
	          $fileName = DIR_FRAMEWORK_PATH . $folder . DS . 'helpers' . DS . $helper .'_helper.php';
	          if(file_exists($fileName)) require_once $fileName;
	       }
	   }
	}

	// library
	public function library($libraries, $folder = 'ci') {
	    if(is_string($libraries)) {
	        $libraries   = ucfirst($libraries); // tên file
	        $fileName    =  DIR_FRAMEWORK_PATH . $folder . DS . 'libraries' . DS . $libraries . '.php';
	        if(file_exists($fileName)) require_once $fileName;
	        $this->initLibrary($libraries);
	    }
	    elseif(is_array($libraries)) {
	        if(!empty($libraries)) {
	            foreach($libraries as $library) {
	                $library   = ucfirst($library); // tên file
	                $fileName  = DIR_FRAMEWORK_PATH . $folder . DS  . 'libraries' . DS . $library . '.php';
	                if(file_exists($fileName)) require_once $fileName;
	                $this->initLibrary($library);
	            }
	        }
	    }
	}

	public function initLibrary($library, $object = null) {
	    $init             = strtolower($library);
	    $classLibrary     = 'CI_' . ucfirst($library); // tên class lirbrary
	    if($object != null) {
	        $init         = $object;
	    }

	    $class    = new $classLibrary($this->registry);
	    $this->__set($init, $class);
	}

	public function myHelper($helpers) {
	    if(is_string($helpers)) {
	        $helpers = strtolower($helpers);
	        $helper  = preg_replace('/[^a-zA-Z0-9_\/]/', '', $helpers);
	        $fileName = 'core' . DS . 'helpers' . DS . 'my_' . $helpers .'_helper.php';
	        require_once $fileName;
	    }
	    elseif(is_array($helpers)) {
	        $helpers = array_flip($helpers);
	        $helpers = array_change_key_case($helpers, CASE_LOWER);
	        $helpers = array_flip($helpers);
	        foreach ($helpers as $helper) {
	            $fileName = 'core' . DS . 'helpers' . DS . 'my_' . $helper .'_helper.php';
	            if(file_exists($fileName)) require_once $fileName;
	        }
	    }
	}



	public function myLibrary($libraries) {
	    if(is_string($libraries)) {
	        $libraries   = ucfirst($libraries); // tên file
	        $fileName    = 'core' . DS . 'libraries' . DS . $libraries . '.php';
	        if(file_exists($fileName)) require_once $fileName;
	        $this->initMyLibrary($libraries);
	    }
	    elseif(is_array($libraries)) {
	        if(!empty($libraries)) {
	            foreach($libraries as $library) {
	                $library   = ucfirst($library); // tên file
	                $fileName    = 'core' . DS . 'libraries' . DS . $library . '.php';
	                if(file_exists($fileName)) require_once $fileName;
	                //$this->initMyLibrary($library);
	            }
	        }
	    }
	}

	public function initMyLibrary($library, $object = null) {
	    $init             = strtolower($library);
	    $classLibrary     = ucfirst($library);
	    if($object != null) {
	        $init         = $object;
	    }
	    $init             = new $classLibrary();
	    return $init;
	}
}