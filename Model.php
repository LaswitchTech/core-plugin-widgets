<?php

// Import additionnal class into the global namespace
use \LaswitchTech\Core\Abstracts\Model;

class WidgetsModel extends Model {

    // Core Properties
    protected $Request;
    protected $Builder;
    protected $Locale;
    protected $Config;
    protected $Auth;

    // Properties
    protected $Path;

    /**
     * Constructor
     */
    public function __construct()
    {
        // Call Parent Constructor
        parent::__construct();

        // Import Global Variables
        global $REQUEST, $BUILDER, $LOCALE, $CONFIG, $AUTH;

        // Set Core Properties
        $this->Request = $REQUEST;
        $this->Builder = $BUILDER;
        $this->Locale = $LOCALE;
        $this->Config = $CONFIG;
        $this->Auth = $AUTH;

        // Set Properties
        $this->Path = $this->Config->root() . DIRECTORY_SEPARATOR . "lib" . DIRECTORY_SEPARATOR . "plugins";
    }

    /**
     * Load Widgets
     *
     * @return void
     */
    protected function load(): void
    {
        // Check if the Plugin directory exists
        if(is_dir($this->Path)){

            // Loop through all the files in the directory
            foreach(array_diff(scandir($this->Path), array('..', '.')) as $plugin){

                // Set the path to the plugin's Widget.php file
                $path = $this->Path . DIRECTORY_SEPARATOR . $plugin . DIRECTORY_SEPARATOR . "Widget.php";

                // Check if the file exists
                if(file_exists($path)){

                    // Include the file
                    require_once $path;
                }
            }
        }
    }

    /**
     * Insert Widgets
     *
     * @return void
     */
    public function insert(): void
    {
        // Check if the Plugin directory exists
        if(is_dir($this->Path)){

            // Check if the file exists
            if(file_exists($this->Path . DIRECTORY_SEPARATOR . "widgets" . DIRECTORY_SEPARATOR . "Widgets.php")){

                // Include the file
                require_once $this->Path . DIRECTORY_SEPARATOR . "widgets" . DIRECTORY_SEPARATOR . "Widgets.php";
            }
        }
    }
}
