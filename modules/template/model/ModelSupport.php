<?php
/**
 * Code by Nguyen Xuan Truong
 */
if (!defined('BNC_CODE')) {
	exit('Access Denied'); 
}
class ModelSupport extends \Bncv2\Core\ModelBase {
	function __construct() {
		parent::__construct();
		$this->mBlock = new Model($this->lang . '_block');
	}
	/**
	 * [addBlockcustom description]
	 * @author Truong Nguyen
	 * @email  truongnx28111994@gmail.com
	 */
	public function saveBlock($data,$id=null) {
		$data = array(
			'idw'          => $this->idw,
			'title'        => $data['title'],
			'sort'         => 0,
			'position'     => $data['position'],
			'status'       => 1,
			'active_mod'   => ',all,',
			'type'         => 3, //Support
			'data_custome' => $data['data_custome'],
			'idblock'      => $this->countMax(),
			'file'         => 'blockSupport',
			'module_str'   => 'template',
			'module'          => 25,
		);
		if($id!=null){
			
			$this->mBlock->where('id', $id);
			$this->mBlock->where('idw', $this->idw);
			$this->mBlock->update($data);
			$result = array(
				'status'  => true,
				'last_id' => $id,
			);
		}else{
			$last_id = $this->mBlock->insert($data);
			$result  = array(
				'status'  => true,
				'last_id' => $last_id,
			);
		}

		return $result;
	}
	/**
	 * [countMax description]
	 * @author Truong Nguyen
	 * @email  truongnx28111994@gmail.com
	 * @date   2015-08-12
	 * @return [type]                     [description]
	 */
	public function countMax() {
		$data = $this->mBlock->where('idw', $this->idw)->orderBy('idblock', 'DESC')->getOne(null, 'idblock');
		if ($data['idblock'] == '') {
			return 0;
		} else {
			return $data['idblock'] + 1;
		}
	}
	
	/**
	 * [getAll description]
	 * @author Truong Nguyen
	 * @email  truongnx28111994@gmail.com
	 * @date   2015-08-26
	 * @return [type]                     [description]
	 */
	public function getAll()
	{
		$this->mBlock->where('idw',$this->idw);
		$this->mBlock->where('type',3);
		$data=$this->mBlock->get();
		return $data;
		
	}
	
	/**
	 * [getById description]
	 * @author Truong Nguyen
	 * @email  truongnx28111994@gmail.com
	 * @date   2015-08-26
	 * @param  [type]                     $id [description]
	 * @return [type]                         [description]
	 */
	public function getById($id)
	{
		$this->mBlock->where('idw',$this->idw);
		$this->mBlock->where('type',3);
		$this->mBlock->where('id',$id);
		$data=$this->mBlock->getOne();
		return $data;
	}
}