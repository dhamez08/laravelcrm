<?php

namespace ClientTags;

class ClientTagsController extends \BaseController {

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
		$this->data_view['settings_index'] 	= $this->data_view['view_path'] . '.settings.index';
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
		$data['tabActive'] 			= 'client';
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

			$this->clientTagEntity->saveTag(\Input::all());

			\Session::flash('message', 'The Tag was successfully created');
			return \Redirect::to('settings/tags/clients');
		}else{
			\Input::flash();
			return \Redirect::to('settings/tags/clients')
			->withErrors($validator)
			->withInput();
		}
	}

	public function getDelete($id) {
		$tag = $this->clientTagEntity->find($id);
		if($tag) {
			$tag->delete();
			\Session::flash('message', 'The Tag was successfully deleted');
			return \Redirect::to('settings/tags/clients');
		}
	}

	public function postUpdate() {
	    $tagId = \Input::get('pk');
	    $newTagname = \Input::get('value');
	    $tag = $this->clientTagEntity->find($tagId);
	    $tag->tag = $newTagname;
	    if($tag->save())
	        return \Response::json(array('status'=>1));
	    else
	        return \Response::json(array('status'=>0));
	}

	public function getClientTag($customer_id){
	}

	public function getClientTagWidget($client_id){
		$data = $this->data_view;
		$data['client_tag_path'] = $data['view_path'] . '.clients.tags.widget';
		$data['tags']			 = \ClientTag\ClientTagEntity::get_instance()->getTagsByLoggedUser();
		$data['client_id']		 = $client_id;
		$data['client_tag']		 = \CustomerTags\CustomerTags::customerId($client_id)->with('tags');
		$data = array_merge($data,$this->getSetupThemes());
		return \View::make( $data['client_tag_path'], $data )->render();
	}

	public function postAddTagToClient($client_id = null){
		if( !is_null($client_id) && \Input::get('tag_id') != 0){
			$data = array(
				'customer_id'=>$client_id,
				'tag_id'=>\Input::get('tag_id')
			);
			$client_tag = \CustomerTags\CustomerTagsEntity::get_instance()->objCreateOrUpdate($data);
			if( $client_tag ){
				\Session::flash('message', 'Successfully Added Tag');
				return \Redirect::action('Clients\ClientsController@getClientSummary',array('clientId'=>$client_id));
			}else{
				return \Redirect::to('clients/client-summary/' . $client_id)->withErrors('Error cannot add tag to the customer.');
			}
		}else{
			return \Redirect::to('clients/client-summary/' . $client_id)->withErrors('Error cannot add tag to the customer.');
		}
	}

	public function getConfirmClientTagDelete($id, $client_id){
		echo $id.'-'.$client_id;
	}

}
