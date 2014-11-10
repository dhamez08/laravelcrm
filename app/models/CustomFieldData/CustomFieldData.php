<?php
namespace CustomFieldData;
class CustomFieldData extends \Eloquent {

    protected $table = 'users_custom_fields_data';

    public function field()
    {
        return $this->belongsTo('\CustomField\CustomField', 'field_id', 'id')->whereNull('deleted_at');
    }

    public function client()
    {
        return $this->belongsTo('\Clients\Clients', 'customer_id', 'id')->whereNull('deleted_at');
    }

    public function scopeOfClient($query, $clientId) {
        return $query->where('customer_id', '=', $clientId)->get();
    }
}
