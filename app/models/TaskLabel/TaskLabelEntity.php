<?php
namespace TaskLabel;
class TaskLabelEntity extends \Eloquent{
	protected $table = 'task_label';

	protected static $instance = null;

	/**
	 * Return an instance of this class.
	 *
	 * @return    object    A single instance of this class.
	 */
	public static function get_instance() {

		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	/**
	 * Use to get icons from @var array_icons
	 * @return array_icons
	 * */
	public function getIcons(){
		return \Config::get('crm.task_icons');
	}

	/**
	 * Use to get color for label see @var array_color_label
	 * @return array_color_label
	 * */
	public function getColorLabel(){
		return \Config::get('crm.task_color');
	}

	public function getMyActionLabel($userId = null){
		if( is_null($userId) ){
			$userId = \Auth::id();
		}
		return \TaskLabel\TaskLabel::userID($userId)->orderBy('created_at','desc');
	}

	//public function getHour

	/**
	 * Get all task label by user id
	 * @param		int		$by_user		Default is null
	 * 										If null then use $this->session->userdata('user_id')
	 * @return		object
	 * */
	public function getAllTaskLabel($by_user = null, $all = false){
		/*if( !$by_user ){
			$by_user = \Auth::id();
		}
		$query = $this->getTaskSettingBy(
			array('user_id' => $by_user),
			$all
		);
		return $query;*/
	}

		/**
	 * get task setting by name
	 *
	 * @param	string	$action_name	name of the action in the table column of task_setting
	 *
	 * @return object
	 * */
	public function getTaskSettingByName($action_name){
		/*$query = $this->getTaskSettingBy(
			array('action_name' => $action_name)
		);
		return $query;*/
	}

	/**
	 * get task setting by Id
	 *
	 * @param	int	$id	id of the action in the table column of task_setting
	 *
	 * @return object
	 * */
	public function getTaskSettingById($id){
		/*$query = $this->getTaskSettingBy(
			array('id' => $id),
			false
		);
		return $query;*/
	}

	public function getTaskSettingForUse($id){
		/*$query = $this->getTaskSettingBy(
			array('id' => $id),
			false
		);
		return $query;*/
	}

	/**
	 * Get task by where parameters
	 *
	 * @param		associative array		$array_where		the key pair values are associative array
	 * 															base on the table column task_setting
	 * 															it should not be empty
	 * @param		boolean	$all		if true then display all even the 0 or the static action
	 * 									else display only by user, this is used for editing task setting
	 * 									by individual user
	 * @return object
	 * */
	public function getTaskSettingBy($array_where, $all){
		if( !empty($array_where) ){
			$user = \Auth::id();
			/*$this->db->select('*');
			$this->db->from($this->getTable());
			$this->db->where( $array_where );
			if( $all ){
				$this->db->or_where(array('user_id' => 0));
			}
			$this->db->limit($limit,$offset);

			$query = $this->db->get();
			return $query;*/
		}
	}

	public function createOrUpdate($id = null){
		if( is_null($id) ){
			$taskLabel	=	new \TaskLabel\TaskLabel;
			$taskLabel->user_id = \Input::get('user_id');
		}else{
			$taskLabel	=	\TaskLabel\TaskLabel::find($id);
		}
		$taskLabel->action_name = \Input::get('action_name');
		$taskLabel->icons = \Input::get('icons');
		$taskLabel->color = \Input::get('color');
		$taskLabel->save();
		return $taskLabel;
	}

}
