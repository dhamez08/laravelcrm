<?php
namespace CustomField;
class CustomField extends \Eloquent {

    protected $table = 'users_custom_fields';

    public function user()
    {
        return $this->belongsTo('\User\User', 'user_id', 'id')->whereNull('deleted_at');
    }

    public function fieldData()
    {
        return $this->hasMany('\CustomFieldData\CustomFieldData', 'field_id', 'id')->get();
    }

    public function fieldDataByCustomerAndField($customer_id, $field_id) {
        return $this->hasMany('\CustomFieldData\CustomFieldData', 'field_id', 'id')
            ->where('customer_id', $customer_id)
            ->where('field_id', $field_id)
            ->first();
    }
}
