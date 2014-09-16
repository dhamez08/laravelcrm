<?php

namespace OpportunityTags;

class OpportunityTagsController extends \BaseController {

	/**
	 * Instance of this class.
	 *
	 * @var      object
	 */
	protected static $instance = null;

	protected $clientTagEntity;
	protected $opportunityTagEntity;

	/**
	 * hold the view essentials like
	 * - title
	 * - view path
	 * @return array | associative
	 * */
	protected $data_view;

	/**
	 * auto setup initialize object
	 * */
	public function __construct(){
		parent::__construct();		
		$this->data_view = parent::setupThemes();		
		$this->data_view['master_view'] 	= $this->data_view['view_path'] . '.dashboard.index';
		$this->clientTagEntity = new \ClientTag\ClientTagEntity;
		$this->opportunityTagEntity = new \OpportunityTag\OpportunityTagEntity;
	}

	/**
	 * Return an instance of this class.
	 *
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
	 * get themes
	 * @return	array
	 * */
	public function getSetupThemes(){
		return \Dashboard\DashboardController::get_instance()->getSetupThemes();
	}

	/**
	 * Index of settings
	 * @return View
	 * */
	public function getIndex(){
		$data 						= $this->data_view;
		$data['pageTitle'] 			= 'Tags';
		$data['tabActive'] 			= 'opportunities';
		$data['opportunity_tags']	= $this->opportunityTagEntity->getTagsByLoggedUser();
		$data['client_tags']		= $this->clientTagEntity->getTagsByLoggedUser();
		$data 						= array_merge($data,$this->getSetupThemes());

		return \View::make( $data['view_path'] . '.settings.tags', $data );
	}

	public function postIndex() {

		$rules = array(
			'tag' => 'required|min:3'
		);

		$messages = array(
			'tag.required' => 'Tag name is required.',
			'tag.min'=>'Tag name must have atleast 3 characters'
		);

		$validator = \Validator::make(\Input::all(), $rules, $messages);
		if ( $validator->passes() ) {
			
			$this->opportunityTagEntity->saveTag(\Input::all());

			\Session::flash('message', 'The Tag was successfully created');
			return \Redirect::to('settings/tags/opportunities');
		}else{
			\Input::flash();
			return \Redirect::to('settings/tags/opportunities')
			->withErrors($validator)
			->withInput();
		}
	}

	public function getDelete($id) {
		$tag = $this->opportunityTagEntity->find($id);
		if($tag) {
			$tag->delete();
			\Session::flash('message', 'The Tag was successfully deleted');
			return \Redirect::to('settings/tags/opportunities');
		}
	}

	public function postUpdate() {
	    $tagId = \Input::get('pk');
	    $newTagname = \Input::get('value');
	    $tag = $this->opportunityTagEntity->find($tagId);
	    $tag->tag = $newTagname;
	    if($tag->save()) 
	        return \Response::json(array('status'=>1));
	    else 
	        return \Response::json(array('status'=>0));
	}

}
