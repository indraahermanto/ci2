<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Admin Panel management, includes: 
 * 	- Admin Users CRUD
 * 	- Admin User Groups CRUD
 * 	- Admin User Reset Password
 * 	- Account Settings (for login user)
 */
class Module extends Admin_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_builder');
	}

	// Admin User Modules CRUD
	public function crud()
	{
		$crud = $this->generate_crud('admin_modules');
		$crud->columns('id', 'url', 'name', 'class', 'description', 'relation', 'stat_v', 'status');
		$crud->fields('id', 'url', 'name', 'class', 'description', 'relation', 'stat_v', 'col_order', 'required', 'status');
		$crud->display_as('stat_v','Visibility');
		$crud->display_as('relation','Relation ID');
		$crud->display_as('col_order','Sort Order');
		$this->mPageTitle = 'Admin Modules';
		$this->render_crud();
	}

	// Admin User Modules CRUD
	public function builder($group_id)
	{
		$this->load->model('Admin_group_model', 'group');
		$this->load->model('Admin_module_model', 'module');
		$this->load->helper(array('Sorting'));

		$this->mViewData['group'] 	= $this->group->get($group_id);
		if($this->mViewData['group']->id == 1) $this->mViewData['group']->dis = "disabled";
		else $this->mViewData['group']->dis = "";

		$modules	= $this->module->get_many_by("status= 1 AND id = relation");
		usort($modules, build_sorter('col_order'));
		$this->mViewData['modules'] = $this->childMenu($modules);

		$form 		= $this->form_builder->create_form();

		echo 'asa';
		if ($form->validate()){
			echo 'ss';
			$groupID  = @$this->input->post('inputGroupID');
    	$modules  = @$this->input->post('inputModules');
    	if(count($modules) == 0){
    		$a = "Daftar akses harus diisi.";
    		echo $a;
	    	$this->system_message->set_error($a);
	    }else{
	    	$this->system_message->set_success('sukses');
	      // ready for update
	      // update group tables
	      /*$update = $this->db->update($this->tables['groups'], $array['input'], array('id' => $data['group']->id));
	      if($update){
	        $del = $this->db->delete($this->tables['groups_modules'], array('group_id' => $data['group']->id));
	        if($del){
	          foreach ($data['modules'] as $k_module => $module) {
	            $this->db->insert($this->tables['groups_modules'], array('group_id' => $data['group']->id, 'module_id' => $module));
	          }
	          $this->session->set_flashdata('tMess', '0');
	          $this->session->set_flashdata('message', "Informasi grup berhasil disimpan.");
	          $this->session->unset_userdata($array);
	        }else{
	          $this->session->set_flashdata('tMess', '1');
	          $this->session->set_flashdata('message', "Terdapat kesalahan, silahkan hubungi adminsitrator.");
	        }
	      }else{
	        $this->session->set_flashdata('tMess', '1');
	        $this->session->set_flashdata('message', "Terdapat kesalahan, silahkan hubungi adminsitrator.");
	      }*/
	    }
		}else{
			echo 'asa';
		}
		// refresh();

		/*foreach ($modules as $k_module => $module):
			$id       = $module->id;
			$where  	= "status = 1 AND relation = ".$id." AND id != ".$id." ";
			$children = $this->module->get_many_by($where);
			if($this->ion_auth->in_module($module->url, '', $this->mViewData['group']->id)) $module->active = 1;
			if(isset($children) && count($children) > 0):
				usort($children, build_sorter('col_order'));
				$modules[$k_module]->children = $children;
				foreach ($children as $k_subModuleA => $subModuleA):
					$id       = $subModuleA->id;
					$where  	= "status = 1 AND relation = ".$id." AND id != ".$id." ";
					$children = $this->module->get_many_by($where);
					if($this->ion_auth->in_module($subModuleA->url, '', $this->mViewData['group']->id)) $subModuleA->active = 1;
					if(isset($children) && count($children) > 0):
						usort($children, build_sorter('col_order'));
						$modules[$k_module]->children[$k_subModuleA]->children = $children;
						foreach ($children as $k_subModuleB => $subModuleB):
							$id       = $subModuleB->id;
							$where  	= "status = 1 AND relation = ".$id." AND id != ".$id." ";
							$children = $this->module->get_many_by($where);
							if($this->ion_auth->in_module($subModuleB->url, '', $this->mViewData['group']->id)) $subModuleB->active = 1;
							if(isset($children) && count($children) > 0):
								usort($children, build_sorter('col_order'));
								$modules[$k_module]->children[$k_subModuleA]->children[$k_subModuleB]->children = $children;
								if(isset($children)) unset($children);
							endif;
						endforeach;
						if(isset($children)) unset($children);
					endif;
				endforeach;
				if(isset($children)) unset($children);
			endif;
		endforeach;*/
		/*$modules = $this->childMenu($modules);
		print_r($modules);*/

		$this->mViewData['form']	= $form;
		$this->render('panel/group_builder');
	}

	public function builder_update()
	{
		/*$groupID  = @$this->input->post('inputGroupID');
    $modules  = @$this->input->post('inputModules');
    $form 		= $this->form_builder->create_form();
    if(count($data['modules']) == 0){
    	$this->system_message->set_success($messages);
      $this->session->set_flashdata('tMess', '1');
      $this->session->set_flashdata('message', "Daftar akses harus diisi.");
    }else{
      // ready for update
      // update group tables
      $update = $this->db->update($this->tables['groups'], $array['input'], array('id' => $data['group']->id));
      if($update){
        $del = $this->db->delete($this->tables['groups_modules'], array('group_id' => $data['group']->id));
        if($del){
          foreach ($data['modules'] as $k_module => $module) {
            $this->db->insert($this->tables['groups_modules'], array('group_id' => $data['group']->id, 'module_id' => $module));
          }
          $this->session->set_flashdata('tMess', '0');
          $this->session->set_flashdata('message', "Informasi grup berhasil disimpan.");
          $this->session->unset_userdata($array);
        }else{
          $this->session->set_flashdata('tMess', '1');
          $this->session->set_flashdata('message', "Terdapat kesalahan, silahkan hubungi adminsitrator.");
        }
      }else{
        $this->session->set_flashdata('tMess', '1');
        $this->session->set_flashdata('message', "Terdapat kesalahan, silahkan hubungi adminsitrator.");
      }
    }*/
	}

	function childMenu($parents){
		foreach ($parents as $k_parent => $parent):
			$menu 		= $parent;
			$id       = $menu->id;
			$where  	= "status = 1 AND relation = ".$id." AND id != ".$id." ";
			$children = $this->module->get_many_by($where);
			$menu->active 	= $this->ion_auth->in_module($menu->url, '', $this->mViewData['group']->id);
			if(isset($children) && count($children) > 0):
				usort($children, build_sorter('col_order'));
				$menu->children = $children;
				$this->childMenu($children); // level 3 (setting/users/add)
				$this->childMenu($children); // level 4 (setting/panel/users/add)
				if(isset($children)) unset($children);
			endif;
		endforeach;
		return $parents;
	}
	// usort($array, build_sorter('key_b'));
}