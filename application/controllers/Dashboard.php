<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	public $load;
	public $m_dashboard;
	public $input;
	// public $domain;
	public $db;
	function __construct()
	{
		parent::__construct();
		$this->load->model('m_dashboard');
		$this->load->helper('domain_helper'); // Load the helper
	}

	function index()
	{
		$company_info = get_company_info($this->db); // Call the helper function

		if ($company_info !== null) {
			$id_company = $company_info['id_company'];
			$data['_description'] = $company_info['description'];
			$data['base_url'] = $company_info['base_url'];
			$data['map_company'] = $company_info['map_company'];
		} else {
			$id_company = null;
			$data['_description'] = 'Invalid domain or no description available.';
		}
		$num_subsidi = $this->m_dashboard->m_data_perum_kategori($id_company);
		if ($num_subsidi['num_rows'] > '0') {
			$data['show_header'] = 'show';
		} else {
			$data['show_header'] = 'hide';
		}
		// $data['_title'] = 'Cari Rumah Murah, Bagus, Terpercaya, Terbukti ? Klik, Disini. | Kanpa.co.id';
		// $data['_metafoto'] = 'logo-pt-kanpa-2.png';
		// $data['_url'] = base_url();
		// $data['_description'] = 'PT Kanpa bergerak di bidang properti sejak tahun 2002. saat ini tersedia di ungaran, semarang, sukoharjo, klaten, kabupaten madiun. Hub 0823-3350-7931';
		$data['_script'] = 'dashboard/index_js';
		$data['_view'] = 'dashboard/index';
		$data['data_outher_header'] = $this->m_dashboard->m_data_outher_header();
		$data['data_foto_slide_subsidi'] = $this->m_dashboard->m_data_fotoslide_subsidi($id_company);
		$data['data_foto_slide_perumahan'] = $this->m_dashboard->m_data_fotoslide_perumahan($id_company);
		$data['data_foto_slide_promo'] = $this->m_dashboard->m_data_fotoslide_promo();
		$data['data_tipe_desc'] = $this->m_dashboard->m_data_tipe_desc();
		$data['data_perum'] = $this->m_dashboard->m_data_perum($id_company);
		$data['data_tipe'] = $this->m_dashboard->m_data_tipe();
		$data['data_berita'] = $this->m_dashboard->m_data_berita();
		$data['detail_marketing'] = $this->m_dashboard->m_detail_marketing();
		$this->load->view('layout/index', $data);
	}
}
