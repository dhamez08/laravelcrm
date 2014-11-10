<?php
namespace CustomField;
class CustomFieldEntity extends \Eloquent {

    //use SoftDeletingTrait;
    protected $table = 'users_custom_fields';
    protected static $instance = null;

    /**
     *
     */
    public function __construct()
    {
    }

    /**
     * Return an instance of this class.
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
     * @return mixed
     */
    public function getFieldsByLoggedUser()
    {
        $fields = $this->where('user_id', '=', \Auth::id())
            ->whereNull('deleted_at');
        return $fields->get();
    }

    /**
     * @param $customer_id
     * @return mixed
     */
    public function fieldDataByCustomer($customer_id)
    {
        return $this->hasMany('\CustomFieldData\CustomFieldData', 'field_id', 'id')
            ->where('customer_id', $customer_id)
            ->get();
    }

    /**
     * @param $data
     */
    public function saveField($data)
    {
        if(isset($data['field_id']))
            $field = $this->find($data['field_id']);
        else
            $field = new $this;
        $field->name = $data['name'];
        $field->label = $data['label'];
        $field->placeholder = $data['placeholder'];
        $field->user_id = \Auth::id();
        $field->save();
    }
}
