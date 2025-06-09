<?php

/**
 * Core Framework - WidgetsModel
 *
 * @license    MIT (https://mit-license.org/)
 * @author     Louis Ouellet <louis@laswitchtech.com>
 */

// Import additionnal class into the global namespace
use \LaswitchTech\Core\Abstracts\Model;

class WidgetsModel extends Model {

    // Core Properties
    private $Auth;
    private $Config;
    private $Locale;
    private $Builder;
    private $Request;

    // Properties
    private $Path;

    public function __construct()
    {
        // Call Parent Constructor
        parent::__construct();

        // Import Global Variables
        global $AUTH, $BUILDER, $CONFIG, $LOCALE, $REQUEST;

        // Set Properties
        $this->Auth = $AUTH;
        $this->Config = $CONFIG;
        $this->Locale = $LOCALE;
        $this->Builder = $BUILDER;
        $this->Request = $REQUEST;
        $this->Path = $this->Config->root() . DIRECTORY_SEPARATOR . "lib" . DIRECTORY_SEPARATOR . "plugins";
    }

    /**
     * Load Widgets
     *
     * @return void
     */
    private function load(): void
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
