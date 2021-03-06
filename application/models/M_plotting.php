<?php
defined('BASEPATH') or exit('No direct script access allowed');
class M_plotting extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function get($nim, $idagenda)
	{
		$query = $this->db->select("NAMA_LENGKAP, TB_DAFTAR.NIM, FAKULTAS, TB_DAFTAR.STATUS, TB_PILIHAN.TB_PILIHAN, TB_AGENDA, (select TB_PILIHAN($idagenda)) as PILIHAN")
						  ->from('TB_DAFTAR')
						  ->join('TB_BIODATA', 'TB_DAFTAR.NIM = TB_BIODATA.NIM')
						  ->join('TB_PILIHAN', 'TB_PILIHAN.ID_PILIHAN = TB_DAFTAR.ID_PILIHAN_DITERIMA')
						  ->join('TB_AGENDA', 'TB_DAFTAR.ID_AGENDA = TB_AGENDA.ID_AGENDA')
						  ->where(array('TB_DAFTAR.NIM' => $nim, 'TB_DAFTAR.ID_AGENDA' => $idagenda))
						  ->get()->result_array();
		return $query;
	}
}
