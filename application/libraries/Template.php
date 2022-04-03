<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Template
{
	protected $_ci;
	function __construct()
	{
		$this->_ci = &get_instance(); //Untuk Memanggil function load, dll dari CI. ex: $this->load, $this->model, dll
	}

	function views($template = NULL, $data = NULL, $additional = null)
	{
		if ($template != NULL) {
			// head
			$data['_meta'] 			    = $this->_ci->load->view('_layout/_meta', $data, TRUE);
			$data['_css'] 			    = $this->_ci->load->view('_layout/_css', $data, TRUE);

			// Header
			$data['_nav'] 				= $this->_ci->load->view('_layout/_nav', $data, TRUE);
			// $data['_header'] 		    = $this->_ci->load->view('_layout/_header', $data, TRUE);

			//Sidebar
			$data['_sidebar'] 		    = $this->_ci->load->view('_layout/_sidebar', $data, TRUE);

			//Content
			$data['_headerContent'] 	= $this->_ci->load->view('_layout/_headerContent', $data, TRUE);
			$data['_mainContent'] 		= $this->_ci->load->view($template, $data, TRUE);
			$data['_content'] 		    = $this->_ci->load->view('_layout/_content', $data, TRUE);

			//Footer
			$data['_footer'] 		    = $this->_ci->load->view('_layout/_footer', $data, TRUE);

			//JS
			$data['_js'] 			    = $this->_ci->load->view('_layout/_js', $data, TRUE);

			if ($additional != null) {
				$data['_additional_js'] = $additional;
			}
			echo $data['_template']     = $this->_ci->load->view('_layout/_template', $data, TRUE);
		}
	}

	var $template_data = array();

	function set($name, $value)
	{
		$this->template_data[$name] = $value;
	}

	function load($template = '', $view = '', $view_data = array(), $return = FALSE)
	{
		$this->CI = &get_instance();
		$this->set('contents', $this->CI->load->view($view, $view_data, TRUE));
		return $this->CI->load->view($template, $this->template_data, $return);
	}
}

/* End of file Template.php */
/* Location: ./system/application/libraries/Template.php */
