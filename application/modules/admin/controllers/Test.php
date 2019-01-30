<?php
defined('BASEPATH') || exit('No direct script access allowed');

class Test extends Admin_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_builder');
	}

	public function one()
	{
		$this->mViewData['input']	= @$this->input->post('input');
		if($this->mViewData['input'] != ""){
			$array 	= array();
			$input	= str_split($this->mViewData['input']);
			$this->mViewData['output'] = false;
			foreach ($input as $k_inp => $inp) {
				if(!isset($array[$inp])){
					$array[$inp] = 0;
				}else{
					$array[$inp]++;
					if($array[$inp] > 0 && $this->mViewData['output'] == false){
						$this->mViewData['output'] = $inp;
					}
				}
			}
		}
		$this->render('test/one');
	}

	function bubble_sort($arr){
		$size = count($arr);
		for($pass_num = $size - 1; $pass_num >= 0; $pass_num--){
			for($i = 0; $i < $pass_num; $i++){
				if($arr[$i] > $arr[$i + 1]){
					$arr = $this->swap($arr, $i, $i+1);   
				}
			}
		}
		return $arr;
	}

	function swap($arr, $a, $b){
		$arr[$a]	= $arr[$a]+$arr[$b];
		$arr[$b] 	= $arr[$a]-$arr[$b];
		$arr[$a] 	= $arr[$a]-$arr[$b];
		return $arr;
	}

	public function two()
	{
		$this->mViewData['input']	= @$this->input->post('input');
		if($this->mViewData['input'] != ""){
			$array 	= array();
			$input	= str_split($this->mViewData['input']);
			$this->mViewData['output'] = implode("", $this->bubble_sort($input));
		}
		$this->render('test/two');
	}

	public function three_topup()
	{
		$this->load->model('Bank_log_model', 'bank_log');
		$this->load->library('Conv_number');
		$form 	= $this->form_builder->create_form();
		$data 	= $this->input->post();
		$alias	= array('bl_trxid'	=> '',
										'bl_bank'		=> 'inputBank',	'bl_norek'	=> 'inputAccNo',
										'bl_desc'		=> 'inputDesc',
										'bl_credit'	=> 'inputAmount');

		if(count($data)){
			foreach ($data as $k_d => $d) {
				if($d == ''){
					$this->system_message->set_error("Some field is empty.");
				}
				foreach ($alias as $k_ali => $ali) {
					if($k_d == $ali){
						$alias[$k_ali] = $d;
					}
				}
			}
			$alias['bl_debit']	= 0;
			$alias['bl_date']		= date('Y-m-d H:i:s');
			$logToday						= $this->bank_log->get_many_by(array("DATE(bl_date)=" => date('Y-m-d')));
			$idLogToday 				= count($logToday)+1;
			$alias['bl_trxid']	= substr($alias['bl_norek'], -4).date('ymd').$this->conv_number->getCharNumber($idLogToday, 4);
			if($this->bank_log->insert($alias)){
				$this->system_message->set_success("Topup Success.");
			}else{
				$this->system_message->set_error("Topup Failed.");
			}
			refresh();
		}
		
		$this->mViewData['form']	= $form;
		$this->render('test/three/topup');
	}

	public function three_withdraw()
	{
		$this->load->model('Bank_log_model', 'bank_log');
		$this->load->library('Conv_number');
		$form 	= $this->form_builder->create_form();
		$data 	= $this->input->post();
		$alias	= array('bl_trxid'	=> '',
										'bl_bank'		=> 'inputBank',	'bl_norek'	=> 'inputAccNo',
										'bl_desc'		=> 'inputDesc',
										'bl_debit'	=> 'inputAmount');

		if(count($data)){
			foreach ($data as $k_d => $d) {
				if($d == ''){
					$this->system_message->set_error("Some field is empty.");
				}
				foreach ($alias as $k_ali => $ali) {
					if($k_d == $ali){
						$alias[$k_ali] = $d;
					}
				}
			}
			$alias['bl_credit']	= 0;
			$alias['bl_date']		= date('Y-m-d H:i:s');
			$logToday						= $this->bank_log->get_many_by(array("DATE(bl_date)=" => date('Y-m-d')));
			$idLogToday 				= count($logToday)+1;
			$alias['bl_trxid']	= substr($alias['bl_norek'], -4).date('ymd').$this->conv_number->getCharNumber($idLogToday, 4);
			if($this->bank_log->insert($alias)){
				$this->system_message->set_success("Withdraw Success.");
			}else{
				$this->system_message->set_error("Withdraw Failed.");
			}
			refresh();
		}
		
		$this->mViewData['form']	= $form;
		$this->render('test/three/topup');
	}

	public function three_transfer()
	{
		$this->load->model('Bank_log_model', 'bank_log');
		$this->load->library('Conv_number');
		$form 				= $this->form_builder->create_form();
		$data 				= $this->input->post();
		$aliasSource	= array('bl_trxid'	=> '',
													'bl_bank'		=> 'inputBankSr',	'bl_norek'	=> 'inputAccNoSr',
													'bl_desc'		=> 'inputDesc',
													'bl_debit'	=> 'inputAmount');

		$aliasDest		= array('bl_trxid'	=> '',
													'bl_bank'		=> 'inputBankDs',	'bl_norek'	=> 'inputAccNoDs',
													'bl_desc'		=> 'inputDesc',
													'bl_credit'	=> 'inputAmount');

		if(count($data)){
			foreach ($data as $k_d => $d) {
				if($d == ''){
					$this->system_message->set_error("Some field is empty.");
				}
				foreach ($aliasSource as $k_ali => $ali) {
					if($k_d == $ali){
						$aliasSource[$k_ali] = $d;
					}
				}

				foreach ($aliasDest as $k_ali => $ali) {
					if($k_d == $ali){
						$aliasDest[$k_ali] = $d;
					}
				}
			}

			/*source*/
			$aliasSource['bl_credit']	= 0;
			$aliasSource['bl_date']		= date('Y-m-d H:i:s');
			$logToday						= $this->bank_log->get_many_by(array("DATE(bl_date)=" => date('Y-m-d')));
			$idLogToday 				= count($logToday)+1;
			$aliasSource['bl_trxid']	= substr($aliasSource['bl_norek'], -4).date('ymd').$this->conv_number->getCharNumber($idLogToday, 4);

			/*destination*/
			$aliasDest['bl_debit']	= 0;
			$aliasDest['bl_date']		= date('Y-m-d H:i:s');
			$logToday						= $this->bank_log->get_many_by(array("DATE(bl_date)=" => date('Y-m-d')));
			$idLogToday 				= count($logToday)+1;
			$aliasDest['bl_trxid']	= substr($aliasDest['bl_norek'], -4).date('ymd').$this->conv_number->getCharNumber($idLogToday, 4);

			if($this->bank_log->insert($aliasSource) && $this->bank_log->insert($aliasDest)){
				$this->system_message->set_success("Transfer Success.");
			}else{
				$this->system_message->set_error("Transfer Failed.");
			}
			refresh();
		}
		
		$this->mViewData['form']	= $form;
		$this->render('test/three/transfer');
	}

	public function three_history()
	{	
		$crud = $this->generate_crud('bank_logs');
		$crud->columns('bl_trxid','bl_bank','bl_norek','bl_date','bl_desc','bl_debit','bl_credit');
		$crud->display_as('bl_trxid','Trans ID');
		$crud->display_as('bl_bank','Bank Name');
		$crud->display_as('bl_norek','No Account');
		$crud->display_as('bl_date','Date');
		$crud->display_as('bl_desc','Description');
		$crud->display_as('bl_debit','Debit');
		$crud->display_as('bl_credit','Credit');
		$crud->unset_add();
		$crud->unset_delete();
		$crud->unset_edit();
		$this->mPageTitle = 'Admin Modules';
		$this->render_crud();
	}
}
