<?php
namespace Settings;
/**
 * Email settings controller
 *
 * */
class SMSController extends \BaseController {

    /**
     * Instance of this class.
     *
     * @var      object
     */
    protected static $instance = null;
    //protected $userEntity;
    /**
     * hold the view essentials like
     * - title
     * - view path
     * @return array | associative
     * */
    protected $data_view;

    /**
     * Logged in user object
     *
     */
    protected $user;

    /**
     * auto setup initialize object
     * */
    public function __construct()
    {
        parent::__construct();
        $this->data_view = parent::setupThemes();
        $this->data_view['settings_index'] = $this->data_view['view_path'] . '.settings.index';
        //$this->data_view['master_view'] 	= $this->data_view['view_path'] . '.dashboard.index';
        $this->userEntity = new \User\UserEntity;
    }

    /**
     * Return an instance of this class.
     *
     *
     * @return    object    A single instance of this class.
     */
    public static function get_instance()
    {
        // If the single instance hasn't been set, set it now.
        if(null == self::$instance) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    /**
     * get themes
     * @return    array
     * */
    public function getSetupThemes()
    {
        return \Dashboard\DashboardController::get_instance()->getSetupThemes();
    }

    /**
     * Index of settings
     * @return View
     * */
    public function getIndex()
    {
        $data = $this->data_view;
        $data['portlet_title'] = 'SMS Settings';
        $data['contentClass'] = '';
        
        /* Templates */
        $data['sms_templates'] = \User\User::find(\Auth::id())->smsTemplate;

        /* Initialize view data for modals */
        $dataAddTemplateModal = array();
        $data = array_merge($data, \Dashboard\DashboardController::get_instance()->getSetupThemes());
        
        return \View::make($data['view_path'] . '.settings.sms.sms', $data)
            ->nest('add_template_modal', $data['view_path'] . '.settings.sms.partials.modals.add_template', $dataAddTemplateModal);
    }

    /**
     * @return mixed
     */
    public function postSaveTemplate()
    {
        $smsTemplate = new \SMSTemplate\SMSTemplate;
        $smsTemplate->belongs_to = \Auth::id();
        $smsTemplate->name = \Input::get('template_name', '');        
        $smsTemplate->body = \Input::get('template_body', '');
        $smsTemplate->save();
        if($smsTemplate) {
            \Session::flash('message', 'Successfully Added Template');
        } else {
            \Session::flash('message', 'Something went wrong');
        }
        return \Redirect::to('settings/sms');        
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getUpdateTemplate($id)
    {
        $smsTemplate = \SMSTemplate\SMSTemplate::find($id);
        $data = $this->data_view;
        $data['portlet_title'] = 'Update Template';
        $data['id'] = $smsTemplate->id;
        $data['name'] = $smsTemplate->name;
        $data['body'] = $smsTemplate->body;
        $data = array_merge($data, \Dashboard\DashboardController::get_instance()->getSetupThemes());
        return \View::make($data['view_path'] . '.settings.sms.update_template', $data);        
    }

    /**
     * @param $id
     * @return mixed
     */
    public function postUpdateTemplate($id)
    {
        $smsTemplate = \SMSTemplate\SMSTemplate::find($id);
        $smsTemplate->name = \Input::get('template_name', '');
        $smsTemplate->body = \Input::get('template_body', '');
        $smsTemplate->save();
        if($smsTemplate) {
            \Session::flash('message', 'Successfully Updated Template');
        } else {
            \Session::flash('message', 'Something went wrong');
        }
        return \Redirect::to('settings/sms');        
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getRemoveTemplate($id)
    {
        $smsTemplate = \SMSTemplate\SMSTemplate::find($id);
        if($smsTemplate->belongs_to == \Auth::id()) {
            $smsTemplate->delete();
            \Session::flash('message', 'Successfully Removed Template');
        } else {
            \Session::flash('message', 'Template does not belong to the logged in user.');
        }
        return \Redirect::to('settings/sms');        
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getTemplate($id)
    {
        
        $smsTemplate = \SMSTemplate\SMSTemplate::find($id);
        return \Response::json($smsTemplate);
        
    }
}
