<?php 

class DataPenggajian extends CI_Controller{

	public function index()
	{
		$data['title'] = "Data Gaji Pegawai";

		if((isset($_GET['bulan']) && $_GET['bulan']!='') && (isset($_GET['tahun']) && $_GET['tahun']!='')){
			$bulan = $_GET['bulan'];
			$tahun = $_GET['tahun'];
			$bulantahun = $bulan.$tahun;
		}else{
			$bulan = date('m');
			$tahun = date('Y');
			$bulantahun = $bulan.$tahun;
		}

		$data['potongan'] = $this->penggajianModel->get_data('potongan_gaji')->result();

		$data['gaji'] = $this->db->query("SELECT data_pegawai.id_pegawai, data_pegawai.nik, data_pegawai.nama_pegawai, data_pegawai.jenis_kelamin, data_pegawai.gaji_pokok_personal, data_jabatan.nama_jabatan, data_jabatan.gaji_pokok, data_jabatan.tj_transport, data_jabatan.uang_makan, data_kehadiran.*
			FROM data_pegawai
			INNER JOIN data_kehadiran ON data_kehadiran.nik=data_pegawai.nik
			INNER JOIN data_jabatan ON data_jabatan.nama_jabatan=data_pegawai.jabatan
			WHERE data_kehadiran.bulan='$bulantahun'
			ORDER BY data_pegawai.nama_pegawai ASC")->result();
		// var_dump($data['gaji']);
		$this->load->view('templates_admin/header', $data);
		$this->load->view('templates_admin/sidebar');
		$this->load->view('admin/dataGaji', $data);
		$this->load->view('templates_admin/footer');
	}

	public function cetakGaji()
	{
		$data['title'] = "Cetak Gaji Pegawai";

		if((isset($_GET['bulan']) && $_GET['bulan']!='') && (isset($_GET['tahun']) && $_GET['tahun']!='')){
			$bulan = $_GET['bulan'];
			$tahun = $_GET['tahun'];
			$bulantahun = $bulan.$tahun;
		}else{
			$bulan = date('m');
			$tahun = date('Y');
			$bulantahun = $bulan.$tahun;
		}

		$data['potongan'] = $this->penggajianModel->get_data('potongan_gaji')->result();

		$data['cetakGaji'] = $this->db->query("SELECT data_pegawai.nik, data_pegawai.nama_pegawai, data_pegawai.jenis_kelamin, data_pegawai.gaji_pokok_personal, data_jabatan.nama_jabatan, data_jabatan.gaji_pokok, data_jabatan.tj_transport, data_jabatan.uang_makan, data_kehadiran.*
			FROM data_pegawai
			INNER JOIN data_kehadiran ON data_kehadiran.nik=data_pegawai.nik
			INNER JOIN data_jabatan ON data_jabatan.nama_jabatan=data_pegawai.jabatan
			WHERE data_kehadiran.bulan='$bulantahun'
			ORDER BY data_pegawai.nama_pegawai ASC")->result();
		$this->load->view('templates_admin/header', $data);
		$this->load->view('admin/cetakDataGaji', $data);
	}

	public function cetakGajiPegawai()
	{
		$data['title'] = "Cetak Gaji Pegawai";
		$pegawaiId = $_GET['id'];

		if((isset($_GET['bulan']) && $_GET['bulan']!='') && (isset($_GET['tahun']) && $_GET['tahun']!='')){
			$bulan = $_GET['bulan'];
			$tahun = $_GET['tahun'];
			$bulantahun = $bulan.$tahun;
		}else{
			$bulan = date('m');
			$tahun = date('Y');
			$bulantahun = $bulan.$tahun;
		}

		$data['potongan'] = $this->penggajianModel->get_data('potongan_gaji')->result()[0]->jml_potongan;

		$data['gaji'] = $this->db->query("SELECT data_pegawai.nik, data_pegawai.nama_pegawai, data_pegawai.jenis_kelamin, data_pegawai.gaji_pokok_personal, data_jabatan.nama_jabatan, data_jabatan.gaji_pokok, data_jabatan.tj_transport, data_jabatan.uang_makan, data_kehadiran.*
			FROM data_pegawai
			INNER JOIN data_kehadiran ON data_kehadiran.nik=data_pegawai.nik
			INNER JOIN data_jabatan ON data_jabatan.nama_jabatan=data_pegawai.jabatan
			WHERE data_kehadiran.bulan='$bulantahun'
			AND data_pegawai.id_pegawai='$pegawaiId'
			ORDER BY data_pegawai.nama_pegawai ASC")->result()[0];
		
		// var_dump($data['potongan']);

		$this->load->view('templates_admin/header', $data);
		$this->load->view('admin/cetakDataGajiPegawai', $data);
	}
}

 ?>