<?php
// This code is Written by :
// PAPPU BISWAS 
// Suropriyo Eterprise
// Howrah

defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */

	public function index()
	{
		$this->load->view('headerView');
		$this->load->view('homepageView');
		$this->load->view('footerView');
	}

	public function Home(){
		$this->load->view('headerView');
		$this->load->view('homepageView');
		$this->load->view('footerView');
	}

	public function AboutUs(){
		$this->load->model('ProductsModel');

		$products = $this->ProductsModel->get_all_products();
		$data =  array(
			'products'  => $products
		);

		$this->load->view('headerView');
		$this->load->view('aboutusView', $data);
		$this->load->view('footerView');

	}

	public function Services(){

		$this->load->model('ServicesModel');
        $all_srv = $this->ServicesModel->get_first_six_services();
        $data = array(
            'allserv' => $all_srv
        );

		$this->load->view('headerView');
		$this->load->view('servicesView', $data);
		$this->load->view('footerView');

	}

	public function Careers(){
		$this->load->view('headerView');
		$this->load->view('careerView');
		$this->load->view('footerView');
	}

	public function ContactUs(){
		$this->load->view('headerView');

		$this->load->model('TestimonialsModel');
		$tsm_data = $this->TestimonialsModel->get_testimonials();

		$con_tsm_data = array(
			'tsm_d' => $tsm_data
		);

		$this->load->view('contactusView',$con_tsm_data);
		$this->load->view('footerView');
	}

	public function Jobs(){
		$this->load->model('JobsModel');

        $search_query = $this->input->post();
        $ques = '';
        if(isset($search_query['search'])){
            $ques = $search_query['search'];
        };

        $query = $this->JobsModel->get_search_in_anyfield_query($ques); 
        $result = $this->JobsModel->get_jobmodel_query_result($query);

        $viewData = array('res' => $result);
       
        $this->load->view('jobsView', $viewData);
		$this->load->view('footerView');
	}

}
