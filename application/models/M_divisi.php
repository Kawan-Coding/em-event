<?php
defined('BASEPATH') or exit('No direct script access allowed');
class M_divisi extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function get($divisi, $idagenda)
	{
		$query = $this->db->query("SELECT NAMA_LENGKAP, TB_DAFTAR.NIM, TB_DAFTAR.STATUS, FAKULTAS, TB_DAFTAR.ID_AGENDA, TB_JADWAL.JADWAL FROM TB_DAFTAR JOIN TB_BIODATA ON TB_DAFTAR.NIM = TB_BIODATA.NIM JOIN TB_JADWAL ON TB_DAFTAR.ID_C_JADWAL = TB_JADWAL.ID_C_JADWAL WHERE TB_DAFTAR.ID_PILIHAN_DITERIMA = $divisi AND TB_DAFTAR.ID_AGENDA = $idagenda AND TB_DAFTAR.STATUS='DITERIMA' UNION SELECT NAMA_LENGKAP, TB_DAFTAR.NIM, TB_DAFTAR.STATUS, FAKULTAS, TB_DAFTAR.ID_AGENDA, TB_JADWAL.JADWAL FROM TB_DAFTAR JOIN TB_BIODATA ON TB_DAFTAR.NIM = TB_BIODATA.NIM JOIN TB_JADWAL ON TB_DAFTAR.ID_C_JADWAL = TB_JADWAL.ID_C_JADWAL WHERE TB_DAFTAR.ID_PILIHAN = $divisi AND TB_DAFTAR.ID_AGENDA = $idagenda AND TB_DAFTAR.STATUS!='DITERIMA'")->result_array();
		return $query;
	}
}
