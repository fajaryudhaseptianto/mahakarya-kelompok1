<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Feedback_model extends CI_Model
{
	public function insert($data)
	{
		return $this->db->insert('feedback', $data);
	}

	public function latest($limit = 5)
	{
		return $this->db->order_by('created_at', 'DESC')
			->limit($limit)
			->get('feedback')
			->result();
	}
}

