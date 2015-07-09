<?php
namespace DocumentLibrary;
class DocumentLibrary extends \Eloquent{
    use \SoftDeletingTrait;
    protected $dates = ['deleted_at'];
	protected $table = 'document_library_own';
}
