<?php
require_once INCLUDE_ROOT."Model/RunUnit.php";

class External extends RunUnit {
	public $errors = array();
	public $id = null;
	public $session = null;
	public $unit = null;
	private $address = null;
	private $api_end = 0;
	public $icon = "fa-external-link-square";
	public $type = "External";
	
	
	public function __construct($fdb, $session = null, $unit = null) 
	{
		parent::__construct($fdb,$session,$unit);

		if($this->id):
			$data = $this->dbh->prepare("SELECT id,address,api_end FROM `survey_externals` WHERE id = :id LIMIT 1");
			$data->bindParam(":id",$this->id);
			$data->execute() or die(print_r($data->errorInfo(), true));
			$vars = $data->fetch(PDO::FETCH_ASSOC);
			
			if($vars):
				$this->address = $vars['address'];
				$this->api_end = $vars['api_end'] ? 1 :0;
				$this->valid = true;
			endif;
		endif;
		
	}
	public function create($options)
	{
		$this->dbh->beginTransaction();
		if(!$this->id)
			$this->id = parent::create('External');
		else
			$this->modify($this->id);
		
		if(isset($options['address']))
		{
			$this->address = $options['address'];
			$this->api_end = $options['api_end'] ? 1 : 0;
		}
		
		$create = $this->dbh->prepare("INSERT INTO `survey_externals` (`id`, `address`,`api_end`)
			VALUES (:id, :address,:api_end)
		ON DUPLICATE KEY UPDATE
			`address` = :address2, 
			`api_end` = :api_end2 
		;");
		$create->bindParam(':id',$this->id);
		$create->bindParam(':address',$this->address);
		$create->bindParam(':api_end',$this->api_end);
		$create->bindParam(':address2',$this->address);
		$create->bindParam(':api_end2',$this->api_end);
		$create->execute() or die(print_r($create->errorInfo(), true));
		$this->dbh->commit();
		$this->valid = true;
		
		return true;
	}
	public function displayForRun($prepend = '')
	{
		$dialog = '<p><label>Address: <br>
			<textarea style="width:388px;"  data-editor="r" class="form-control full_width" rows="2" type="text" name="address">'.$this->address.'</textarea></label></p>
		<p><input type="hidden" name="api_end" value="0"><label><input type="checkbox" name="api_end" value="1"'.($this->api_end ?' checked ':'').'> end using <abbr class="initialism" title="Application programming interface. Better not check this if you don\'t know what it means">API</abbr></label></p>
		<p>Enter a URL like <code>http://example.org?code={{login_code}}</code> and the user will be sent to that URL, replacing <code>{{login_code}}</code> with that user\'s code. Enter R-code to e.g. send more data along: <code>paste0(\'http:example.org?code={{login_link}}&<br>age=\', demographics$sex)</code>.</p>
		';
		
		$dialog .= '<p class="btn-group"><a class="btn btn-default unit_save" href="ajax_save_run_unit?type=External">Save.</a>
		<a class="btn btn-default unit_test" href="ajax_test_unit?type=External">Preview.</a></p>';
		

		$dialog = $prepend . $dialog;
		
		return parent::runDialog($dialog,'fa-external-link-square');
	}
	public function removeFromRun()
	{
		return $this->delete();		
	}
	private function isR()
	{
		if(substr($this->address,0,4)=="http") return false;
		return true;
	}
	private function makeAddress($address)
	{
		$login_link = WEBROOT."{$this->run_name}?code={$this->session}";
		$address = str_replace("{{login_link}}", $login_link , $address );
		$address = str_replace("{{login_code}}", $this->session, $address);
		return $address;
	}
	public function test()
	{
		if($this->isR())
		{
			if($results = $this->getSampleSessions())
			{
				$openCPU = $this->makeOpenCPU();
				$this->run_session_id = current($results)['id'];

				$openCPU->addUserData($this->getUserDataInRun(
					$this->dataNeeded($this->dbh,$this->address)
				));
				$output = $openCPU->evaluateAdmin($this->address);
			}
			else $output = '';
		}
		else $output = $this->address;
		
		$this->session = "TESTCODE";
		echo $this->makeAddress($output);
	}
	public function exec()
	{
		if($this->called_by_cron)
			return true; // never show to the cronjob
		
		if(!$this->api_end) 
			$this->end();
		
		if($this->isR())
		{
			$openCPU = $this->makeOpenCPU();

			$openCPU->addUserData($this->getUserDataInRun(
				$this->dataNeeded($this->dbh,$this->address)
			));
			$this->address = $openCPU->evaluate($this->address);
		}
		
		$this->address = $this->makeAddress($this->address);
		
		redirect_to($this->address);
		return false;
	}
}