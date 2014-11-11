<?php
namespace CustomFieldData;
class CustomFieldDataEntity extends \Eloquent {

    protected $table = 'users_custom_fields_data';
    protected static $instance = null;

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
     * @param $id
     * @return collection
     */
    public function getFieldsDataByCustomer($id)
    {
        $data = $this->where('customer_id', '=', $id);
        return $data->get();
    }

    /**
     * @param $field_id
     * @param $customer_id
     * @return collection
     */
    public function getFieldsDataByCustomerAndField($field_id, $customer_id)
    {
        $data = $this->where('customer_id', '=', $customer_id)
            ->where('field_id', '=', $field_id)
            ->whereNull('deleted_at');
        return $data->get();
    }

    public function saveFieldData($fields, $customerId)
    {
        foreach($fields as $key => $cfield) {
            $fieldData = $this->where('field_id','=',$key)
                    ->where('customer_id','=', $customerId)->first();
            if(!$fieldData) {
                $fieldData = new $this;
            }
            $fieldData->field_id = $key;
            $fieldData->customer_id = $customerId;
            $fieldData->value = $cfield;
            $fieldData->save();
        }
    }
}
