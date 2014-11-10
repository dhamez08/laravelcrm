<?php
namespace CustomField;
class CustomField extends \Eloquent {

    protected $table = 'users_custom_fields';

    /**
     * @return mixed
     */
    public function user()
    {
        return $this->belongsTo('\User\User', 'user_id', 'id')->whereNull('deleted_at');
    }

    /**
     * @return mixed
     */
    public function client()
    {
        return $this->belongsTo('\Client\Client', 'customer_id', 'id')->whereNull('deleted_at');
    }

    /**
     * @return mixed
     */
    public function fieldData()
    {
        return $this->hasMany('\CustomFieldData\CustomFieldData', 'field_id', 'id')->get();
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
     * @param $customer_id
     * @param $field_id
     * @return mixed
     */
    public function fieldDataByCustomerAndField($customer_id, $field_id)
    {
        return $this->hasMany('\CustomFieldData\CustomFieldData', 'field_id', 'id')
            ->where('customer_id', $customer_id)
            ->where('field_id', $field_id)
            ->first();
    }
}
