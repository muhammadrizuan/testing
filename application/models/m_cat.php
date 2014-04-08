<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_cat extends CI_Model {

	public function get_category()
	{
	
		$query = $this->db->get('nested_category');
		return $query->result_array();
	}
	
	public function get_books($category_id)
	{
	
		$query = $this->db->get_where('books', array('category_id' => $category_id));
		return $query->result_array();
	}
	
	public function update($input_data)
	{
		foreach($input_data as $book_id => $mydata)
		{	
			foreach($mydata as $key => $value)
			{
				$update_data[$key] = $value;
				//print_r($update_data);
			}
			
			
			$this->db->where('book_id',$book_id);
			$this->db->limit(1);
			$this->db->update('books',$update_data);
			
			echo $this->db->last_query().'<br />';
		}
		
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */