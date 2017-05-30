<?php
class Developer {

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

    // Load Framework
	public function framework($framework = 'ci') {
	    require_once DIR_ROOT_PATH . 'framework' . DS . $framework . DS . 'define.php';
	    require_once DIR_ROOT_PATH . 'framework' . DS . $framework . DS . $framework . '.php';
        $new = new Ci($this->registry);
        $this->__set($framework, $new);
	}

	// Load Autohelper
	private $data = array();

	public function get($key, $framework = '') {
	    return (isset($this->data[$key]) ? $this->data[$key] : null);
	}

	public function set($key, $value) {
	    $this->data[$key] = $value;
	}

	public function has($key, $framework = '') {
	    return isset($this->data[$key]);
	}

	public function autoload($filename) { // load cấu hình file autoload config
	    $filename = $filename . '_autoload';
	    $file = DIR_DEVELOPER_PATH . $filename . '.php';

	    if (file_exists($file)) {
	        $_ = array();

	        require($file);

	        $this->data = array_merge($this->data, $_);
	    } else {
	        trigger_error('Error: Could not load config ' . $filename . '!');
	        exit();
	    }
	}

	// helper
	public function helper($helpers, $folder = 'ci') {
	   if(is_string($helpers)) {
	       $helpers = strtolower($helpers);
	       $helper  = preg_replace('/[^a-zA-Z0-9_\/]/', '', $helpers);
	       $fileName = DIR_DEVELOPER_PATH . $helpers .'_helper.php';
	       if(file_exists($fileName)) require_once $fileName;
	   }
	   elseif(is_array($helpers)) {
	       $helpers = array_flip($helpers);
	       $helpers = array_change_key_case($helpers, CASE_LOWER);
	       $helpers = array_flip($helpers);
	       foreach ($helpers as $helper) {
	          $fileName = DIR_DEVELOPER_PATH . $helpers .'_helper.php';
	          if(file_exists($fileName)) require_once $fileName;
	       }
	   }
	}

	// library
	public function library($libraries) {
	    if(is_string($libraries)) {
	        $libraries   = ucfirst($libraries); // tên file
	        $fileName    =  DIR_DEVELOPER_PATH . 'libraries' . DS . $libraries . '.php';
	        if(file_exists($fileName)) require_once $fileName;
	        $this->initLibrary($libraries);
	    }
	    elseif(is_array($libraries)) {
	        if(!empty($libraries)) {
	            foreach($libraries as $library) {
	                $library   = ucfirst($library); // tên file
	                $fileName  = DIR_DEVELOPER_PATH .  'libraries' . DS . $library . '.php';
	                if(file_exists($fileName)) require_once $fileName;
	                $this->initLibrary($library);
	            }
	        }
	    }
	}


	public function initLibrary($library, $object = null) {
	    $init             = strtolower($library);
	    $classLibrary     = ucfirst($library); // tên class lirbrary
	    if($object != null) {
	        $init         = $object;
	    }

	    $class    = new $classLibrary($this->registry);
	    $this->__set($init, $class);
	}

	public function autoloadFramework($filename, $framework = 'ci') { // load cấu hình file config cho framework
	    $filename = $framework . '_' . $filename . '_autoload';
	    $file = DIR_FRAMEWORK_PATH . $framework . DS . $filename . '.php';

	    if (file_exists($file)) {
	        $_ = array();

	        require($file);

	        $this->data = array_merge($this->data, $_);
	    } else {
	        trigger_error('Error: Could not load config ' . $filename . '!');
	        exit();
	    }
	}

	// helper
	public function helperFramework($helpers, $folder = 'ci') {
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
	public function libraryFramework($libraries, $folder = 'ci') {
	    if(is_string($libraries)) {
	        $libraries   = ucfirst($libraries); // tên file
	        $fileName    =  DIR_FRAMEWORK_PATH . $folder . DS . 'libraries' . DS . $libraries . '.php';
	        if(file_exists($fileName)) require_once $fileName;
	        $this->initLibraryFramework($libraries);
	    }
	    elseif(is_array($libraries)) {
	        if(!empty($libraries)) {
	            foreach($libraries as $library) {
	                $library   = ucfirst($library); // tên file
	                $fileName  = DIR_FRAMEWORK_PATH . $folder . DS  . 'libraries' . DS . $library . '.php';
	                if(file_exists($fileName)) require_once $fileName;
	                $this->initLibraryFramework($library);
	            }
	        }
	    }
	}

	public function initLibraryFramework($library, $object = null) {
	    $init             = strtolower($library);
	    $classLibrary     = 'CI_' . ucfirst($library); // tên class lirbrary
	    if($object != null) {
	        $init         = $object;
	    }

	    $class    = new $classLibrary($this->registry);
	    $this->__set($init, $class);
	}

    public function database($filename = 'sqli') {
        $database = $filename;
        echo $fileName = DIR_DEVELOPER_PATH . 'db' . DS . $filename . 'php';
        if(file_exists($fileName)) {
            require_once $fileName;

        }

        $new = new sqli($this->registry);
        $this->__set($database, $new);
    }

}