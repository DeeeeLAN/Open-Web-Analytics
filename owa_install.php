<?

//
// Open Web Analytics - An Open Source Web Analytics Framework
//
// Copyright 2006 Peter Adams. All rights reserved.
//
// Licensed under GPL v2.0 http://www.gnu.org/copyleft/gpl.html
//
// Unless required by applicable law or agreed to in writing, software
// distributed under the License is distributed on an "AS IS" BASIS,
// WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
// See the License for the specific language governing permissions and
// limitations under the License.
//
// $Id$
//

require_once (OWA_BASE_DIR.'/owa_settings_class.php');
require_once (OWA_BASE_DIR.'/owa_db.php');

/**
 * Installs core database schema
 * 
 * @author      Peter Adams <peter@openwebanalytics.com>
 * @copyright   Copyright &copy; 2006 Peter Adams <peter@openwebanalytics.com>
 * @license     http://www.gnu.org/copyleft/gpl.html GPL v2.0
 * @category    owa
 * @package     owa
 * @version		$Revision$	      
 * @since		owa 1.0.0
 */
class owa_install {
	
	/**
	 * Configuration
	 *
	 * @var array
	 */
	var $config = array();
	
	/**
	 * Data access object
	 *
	 * @var object
	 */
	var $db;
	
	/**
	 * Version of string
	 *
	 * @var string
	 */
	var $version = 1.0;
	
	/**
	 * Error Handler
	 *
	 * @var object
	 */
	var $e;
	
	/**
	 * Constructor
	 *
	 * @return owa_install
	 */

	function owa_install() {
		
		$this->config = &owa_settings::get_settings();
		$this->db = &owa_db::get_instance();
		$this->e = &owa_error::get_instance();
		
		return;
	}
	
	function &get_instance($type) {
		
		$this->config = &owa_settings::get_settings();
		
        //$classfile = $class_path . $plugin . '.php';
		$classfile = $this->config['install_plugin_dir'].'owa_install_'.$type. '.php';
        $class = 'owa_install_'.$type;
        
        /*
         * Attempt to include our version of the named class, but don't treat
         * a failure as fatal.  The caller may have already included their own
         * version of the named class.
         */
        if (!class_exists($class)) {
            include_once $classfile;
        }

        /* If the class exists, return a new instance of it. */
        if (class_exists($class)) {
            $obj = new $class;
            return $obj;
        }

        return null;
		
	}
	
}

?>