<?php
namespace Invoice;

use User\User;
use View;
use Input;
use Validator;
use Hash;
use Redirect;

class UserController extends \BaseController {

	protected $layout = 'index';
	
	
	/* === VIEW === */
	public function index()
	{
		$data = array(
			'users'	=> User::where('role_id', 2)->get()
		);
		
		$this->layout->content = View::make('users.index', $data);	
	}

	public function create()
	{
		$this->layout->content = View::make('users.create');
	}

	public function show($id)
	{
		$data = array(
			'user' => User::find($id)
		);
		
		$this->layout->content = View::make('users.show', $data);
	}	
	
	public function edit($id)
	{
		$data = array(
			'user' => User::find($id)
		);
		
		$this->layout->content = View::make('users.edit', $data);
	}
	/* === END VIEW === */
	
	
	/* === C.R.U.D. === */
	public function update($id)
	{
		$update = User::find($id);
		
		if ( Input::get('action') == 'email' )
		{
			$rules = array(
				'email'     	=> 'required|email',
				'repeat-email'	=> 'required|same:email',
			);	
			
			$validator = Validator::make(Input::all(), $rules);	
			
			if ($validator->passes())
			{
				$update->email	= Input::get('email');
			}
			else
			{
				return Redirect::to('setting')->with('message', trans('invoice.emails_not_match'))->withErrors($validator);
			}
		}
		
		if ( Input::get('action') == 'password' )
		{
			$rules = array(
				'old-password'	=> 'required|min:6',
				'new-password'	=> 'required|min:6',
			);	
			
			$validator = Validator::make(Input::all(), $rules);	
			
			if ($validator->passes())
			{
				if ( Hash::check(Input::get('old-password'), $update->password) )
				{
					$update->password = Hash::make(Input::get('new-password'));
				}
				else
				{
					return Redirect::to('setting')->with('message', trans('invoice.old_password_not_match'));	
				}
			}
			else
			{	
				return Redirect::to('setting')->with('message', trans('invoice.validation_error_messages'))->withErrors($validator);
			}
		}
		
		if ( Input::get('action') == 'role' )
		{
			$update->role_id	= Input::get('role');
		}		
		
		$update->save();
			
		return Redirect::to('setting')->with('message', trans('invoice.data_was_updated'));
	}

	public function destroy($id)
	{
		$delete = User::find($id);
		$delete->delete();
		
		return Redirect::to('admin')->with('message', trans('invoice.data_was_deleted'));		
	}
	/* === END C.R.U.D. === */

}