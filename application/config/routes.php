<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] 				= 'admin/home';
$route['404_override'] 							= 'errors/page_missing';
$route['errors/page_missing'] 			= 'admin/errors/page_missing';
$route['translate_uri_dashes'] 			= FALSE;

/*
| -------------------------------------------------------------------------
| Added by CI Bootstrap 3
| Multilingual routing (use 2 characters (e.g. en, zh, cn, es) for switching languages)
| -------------------------------------------------------------------------
*/

$route['main'] 											= 'admin/home';
$route['login']											= "admin/login";
$route['logout']										= "admin/panel/logout";

/*$route['users']											= "admin/user";
$route['users/index']								= "admin/user";
$route['users/success/(:num)']			= "admin/user";
$route['users/create']							= "admin/user/create";
$route['users/ajax_list_info']						= "admin/user/index/ajax_list_info";
$route['users/ajax_list']									= "admin/user/index/ajax_list";
$route['users/read/(:num)']								= "admin/user/index/read/$1";
$route['users/edit/(:num)']								= "admin/user/index/edit/$1";
$route['users/update/(:num)']							= "admin/user/index/update/$1";
$route['users/update_validation/(:num)']	= "admin/user/index/update_validation/$1";

$route['users/groups']										= "admin/user/group";
$route['users/groups/index']							= "admin/user/group";
$route['users/groups/success/(:num)']			= "admin/user/group";
$route['users/groups/add']								= "admin/user/group/add";
$route['users/groups/insert']							= "admin/user/group/insert";
$route['users/groups/insert_validation']	= "admin/user/group/insert";
$route['users/groups/ajax_list_info']							= "admin/user/group/index/ajax_list_info";
$route['users/groups/ajax_list']									= "admin/user/group/index/ajax_list";
$route['users/groups/read/(:num)']								= "admin/user/group/index/read/$1";
$route['users/groups/edit/(:num)']								= "admin/user/group/index/edit/$1";
$route['users/groups/update/(:num)']							= "admin/user/group/index/update/$1";
$route['users/groups/update_validation/(:num)']		= "admin/user/group/index/update_validation/$1";
$route['users/groups/delete/(:num)']							= "admin/user/group/index/delete/$1";

$route['cover_photo']								= "admin/cover_photo";*/
$route['panel/admin/users/export']	= "admin/panel/admin_user/export";
$route['panel/admin/users/print']		= "admin/panel/admin_user/print";
$route['panel/admin/users']		= "admin/panel/admin_user";
$route['panel/admin/users/index']		= "admin/panel/admin_user";
$route['panel/admin/users/create']	= "admin/panel/admin_user_create";
$route['panel/admin/users/success/(:num)']						= "admin/panel/admin_user";
$route['panel/admin/users/ajax_list']									= "admin/panel/admin_user/index/ajax_list";
$route['panel/admin/users/ajax_list_info']						= "admin/panel/admin_user/index/ajax_list_info";
$route['panel/admin/users/read/(:num)']								= "admin/panel/admin_user/index/read/$1";
$route['panel/admin/users/edit/(:num)']								= "admin/panel/admin_user/index/edit/$1";
$route['panel/admin/users/update/(:num)']							= "admin/panel/admin_user/index/update/$1";
$route['panel/admin/users/update_validation/(:num)']	= "admin/panel/admin_user/index/update_validation/$1";
$route['panel/admin/users/reset_password/(:num)']			= "admin/panel/admin_user_reset_password/$1";

$route['panel/admin/users/groups']				= "admin/panel/admin_user_group";
$route['panel/admin/users/groups/index']	= "admin/panel/admin_user_group";
$route['panel/admin/users/groups/add']		= "admin/panel/admin_user_group/add";
$route['panel/admin/users/groups/export']	= "admin/panel/admin_user_group/export";
$route['panel/admin/users/groups/print']	= "admin/panel/admin_user_group/print";
$route['panel/admin/users/groups/success/(:num)']			= "admin/panel/admin_user_group";
$route['panel/admin/users/groups/ajax_list']					= "admin/panel/admin_user_group/index/ajax_list";
$route['panel/admin/users/groups/ajax_list_info']			= "admin/panel/admin_user_group/index/ajax_list_info";
$route['panel/admin/users/groups/insert']							= "admin/panel/admin_user_group/insert";
$route['panel/admin/users/groups/insert_validation']	= "admin/panel/admin_user_group/insert";
$route['panel/admin/users/groups/read/(:num)']				= "admin/panel/admin_user_group/index/read/$1";
$route['panel/admin/users/groups/edit/(:num)']				= "admin/panel/admin_user_group/index/edit/$1";
$route['panel/admin/users/groups/delete/(:num)']			= "admin/panel/admin_user_group/index/delete/$1";
$route['panel/admin/users/groups/update/(:num)']			= "admin/panel/admin_user_group/index/update/$1";
$route['panel/admin/users/groups/update_validation/(:num)']	= "admin/panel/admin_user_group/index/update_validation/$1";

$route['profile/me']								= "admin/panel/account";
$route['util']											= "admin/util";
$route['util/databases/list']				= "admin/util/list_db";
$route['util/databases/backup']			= "admin/util/backup_db";
$route['util/databases/restore/(:any)']		= "admin/util/restore_db/$1";
$route['util/databases/remove/(:any)']		= "admin/util/remove_db/$1";

$route['^(\w{2})/(.*)$'] 						= '$2';
$route['^(\w{2})$'] 								= $route['default_controller'];

/*
| -------------------------------------------------------------------------
| Added by CI Bootstrap 3
| Additional routes on top of codeigniter-restserver
| -------------------------------------------------------------------------
| Examples from rule: "api/(:any)/(:num)"
|	- [GET]		/api/users/1 ==> Users Controller's id_get($id)
|	- [POST]	/api/users/1 ==> Users Controller's id_post($id)
|	- [PUT]		/api/users/1 ==> Users Controller's id_put($id)
|	- [DELETE]	/api/users/1 ==> Users Controller's id_delete($id)
| 
| Examples from rule: "api/(:any)/(:num)/(:any)"
|	- [GET]		/api/users/1/subitem ==> Users Controller's subitem_get($parent_id)
|	- [POST]	/api/users/1/subitem ==> Users Controller's subitem_post($parent_id)
|	- [PUT]		/api/users/1/subitem ==> Users Controller's subitem_put($parent_id)
|	- [DELETE]	/api/users/1/subitem ==> Users Controller's subitem_delete($parent_id)
*/
$route['api']												= 'api/home';
$route['api/(:any)/(:num)']					= 'api/$1/id/$2';
$route['api/(:any)/(:num)/(:any)']	= 'api/$1/$3/$2';

/*
| -------------------------------------------------------------------------
| Added by CI Bootstrap 3
| Uncomment these if require API versioning (by module name like api_v1)
| -------------------------------------------------------------------------
*/
/*
$route['api/v1']						= "api_v1";
$route['api/v1/(:any)']					= "api_v1/$1";
$route['api/v1/(:any)/(:num)']			= "api_v1/$1/id/$2";
$route['api/v1/(:any)/(:num)/(:any)']	= "api_v1/$1/$3/$2";
$route['api/v1/(:any)/(:any)']			= "api_v1/$1/$2";
*/