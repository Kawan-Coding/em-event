<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pilihan extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('logged')) {
            redirect('logout');
        }
		$this->load->model('M_pengurus');
		$this->load->model('M_agenda');
		$this->load->model('Master');
		$this->load->helper('text');
		$this->load->helper('Parsing');
	}

	public function set()
	{
		$idagenda = $this->input->post('id_agenda');
		$data = array(
			"ID_PILIHAN" =>  "",
			"ID_AGENDA" => $idagenda,
			"TB_PILIHAN" => r($this->input->POST('pilihan')),
			"HAK" => r($this->input->POST('hak')),
		);
		$check = $this->Master->insert('TB_PILIHAN', $data);
		if ($check) {
			$data = array(
				'error' => false,
				'message' => 'Data berhasil diinput',
				'data' => $data
			);
		} else {
			$data = array(
				'error' => true,
				'message' => 'Data gagal diinputkan',
				'data' => $data
			);
		}
		echo json_encode($data);
	}

	public function get()
	{
		$idagenda = $this->input->post('id_agenda');
		$data = $this->Master->get('TB_PILIHAN', array('ID_AGENDA' => $idagenda));
		if (empty($data)) {
			echo json_encode(
				array(
					'status' => 200,
					'error' => true,
					'message' => 'data tidak berhasil diterima',
					'data' => null
				)
			);
		} else {
			echo json_encode(
				array(
					'status' => 200,
					'error' => false,
					'message' => 'data berhasil diterima',
					'data' => divisi($data)
				)
			);
		}
	}

	public function getID()
	{
		$idpilihan = 16;
		$data = $this->Master->get('TB_PILIHAN', array('ID_PILIHAN' => $idpilihan));
		if (empty($data)) {
			echo json_encode(
				array(
					'status' => 200,
					'error' => true,
					'message' => 'data tidak berhasil diterima',
					'data' => null
				)
			);
		} else {
			echo json_encode(
				array(
					'status' => 200,
					'error' => false,
					'message' => 'data berhasil diterima',
					'data' => $data
				)
			);
		}
	}

	public function update()
	{
		$idlama = r($this->input->POST('id_pilihan'));
		$data = array(
			"TB_PILIHAN" => r($this->input->POST('pilihan')),
			"HAK" => r($this->input->POST('hak')),
		);
		$check = $this->Master->update('TB_PILIHAN', $data, array('ID_PILIHAN' => $idlama));
		if ($check) {
			$data = array(
				'status' => true,
				'message' => 'Data berhasil diupdate',
				'data' => $data
			);
		} else {
			$data = array(
				'status' => false,
				'message' => 'Data gagal diupdate',
				'data' => $data
			);
		}
		echo json_encode($data);
	}

	public function delete()
	{
		$id = r($this->input->POST('id_pilihan'));
		$check = $this->Master->delete('TB_PILIHAN', array('ID_PILIHAN' => $id));
		if ($check) {
			$data = array(
				'status' => true,
				'message' => 'Data berhasil dihapus',
				'data' => $check
			);
		} else {
			$data = array(
				'status' => false,
				'message' => 'Data gagal dihapus',
				'data' => $check
			);
		}
		echo json_encode($data);
	}
}
