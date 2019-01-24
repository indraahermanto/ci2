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

		/*$sub_q_a  = "SELECT id, url, name, description, relation, stat_v, status "
								."FROM d_modules "
								."WHERE status= 1 ";
		$sub_q_c  = "ORDER BY col_order, id";
		$query    = "SELECT id, url, name, description, relation, stat_v, status "
								."FROM d_modules "
						."WHERE status= 1 AND id = relation "
						."ORDER BY col_order, id";*/
		$this->mViewData['group'] 	= $this->group->get($group_id);
		if($this->mViewData['group']->id == 1) $this->mViewData['group']->dis = "disabled";
		else $this->mViewData['group']->dis = "";

		$modules	= $this->module->get_many_by("status= 1 AND id = relation");
		usort($modules, build_sorter('col_order'));
		$this->mViewData['modules'] = $this->childMenu($modules);

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
		$this->render('panel/group_builder');
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