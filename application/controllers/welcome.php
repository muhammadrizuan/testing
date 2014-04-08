<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		
		$this->load->view('login');
	
	}
	
	
	public function mytest()
	{
		$this->load->model('m_cat');
		$data['result'] = $category_list = $this->m_cat->get_category();
		
		$category_id  = $this->uri->segment(3);
		
		$category_bisac = FALSE;
		foreach ($category_list as $category_item)
		{
			if($category_item['category_id'] == $category_id)
			{
				$category_bisac = $category_item['bisac'];
				break;
			}
		
		}
		$data ['category_bisac'] = $category_bisac; 
		
		$data['book'] = $this->m_cat->get_books($category_id);
		
		
		$this->load->library('form_validation');
		
		//$this->form_validation->set_rules('book_id', 'Book id', 'required');
		//$this->form_validation->set_rules('bisac', 'Bisac Code', 'required');
		$this->form_validation->set_rules('category', 'Category', 'required');
		
		$data['update_result'] = FALSE;	
		if ($this->form_validation->run())
		{
			//update to model
			
			//$book_id = $this->input->post('book_id');
			//echo $bisac = $this->input->post('bisac');
			//echo $category = $this->input->post('category');
			
			$bisac = $this->input->post('bisac');
			
			foreach($bisac as $mybook_id=>$mybisac_code)
			{
				$input_data[$mybook_id]['bisac_code'] = $mybisac_code;
			}
			
			$category = $this->input->post('category');
			
			foreach($category as $mybook_id=>$mycategory_id)
			{
				$input_data[$mybook_id]['category_id'] = $mycategory_id;
			}
			
			//echo '<pre>'.print_r($input_data,TRUE).'</pre>';
			
			$data['update_result'] = $this->m_cat->update($input_data);
			
		}
		$this->load->view('test',$data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */