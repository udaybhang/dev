<?php
/**
 * 
 */
class Blog_m extends CI_Model
{
	
	public function getBlog()
	{
$query=$this->db->get('tbl_blogs');
if($query->num_rows()>0)
{
return $query->result();
	}
	else{
		return false;
	}
}
public function submit()
{
	$field=array(
'title'=>$this->input->post('txt_title'),
'description'=>$this->input->post('txt_description'),
'created_at'=>date('y-m-d H:i:s')
	);
	$this->db->insert('tbl_blogs', $field);
	if($this->db->affected_rows()>0)
	{
return true;
	}
	else
	{
		return false;
	}
}
public function getBlogById($id)
{
$this->db->where('id', $id);
$query=$this->db->get('tbl_blogs');
if($query->num_rows()>0)
{
	return $query->row();
}
else{
	return false;
}
}
	public function update($id)
	{

		$field=array(
'title'=>$this->input->post('txt_title'),
'description'=>$this->input->post('txt_description'),
'created_at'=>date('y-m-d H:i:s')
	);
		$this->db->where('id', $id);
		$this->db->update('tbl_blogs', $field );

		if($this->db->affected_rows()>0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	public function delete($id)
	{
$this->db->where('id', $id);
$this->db->delete('tbl_blogs');
if($this->db->affected_rows()>0)
{
	return true;
	}
	else{
		return false;
	}
}
}

 ?>