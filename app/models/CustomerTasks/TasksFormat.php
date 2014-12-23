<?php
namespace CustomerTasks;
/**
 * Class for binding data clients
 * */
use Illuminate\Support\Facades\Facade;
use Carbon\Carbon;

class TasksFormat extends Facade{

	protected $task_data;
	protected $due_today;
	protected $due_total;
	protected $due_next_seven_days;
	protected $due_future;

	public function __construct(){
		$this->due_today = 0;
		$this->due_next_seven_days = 0;
		$this->due_future = 0;
		$this->due_total = 0;
	}

	/**
	 * Bind a Property taken from API to this object
	 */
	public function bind( $taskData )
	{
		foreach( get_object_vars( $taskData )  as $k => $v ){
			$this->$k = $v;
		}
		return $this;
	}

	public function displayName(){
		return $this->name;
	}

	public function displayAction(){
		return $this->label->action_name;
	}

	public function displayIcon(){
		return $this->label->icons;
	}

	public function displayColor(){
		return $this->label->color;
	}

	public function displayHtmlLabelIcon($show_icon = true){
		$html  = '<span class="label label-sm" style="padding:3px;background-color:'.$this->displayColor().'">';
			$html .= $this->displayAction();
			if($show_icon) $html .= '<i class="fa '.$this->displayIcon().'"></i>';
		$html .= '</span>';
		return $html;
	}

	public function displayTaskFullName(){
		if( isset($this->client) ){
			if( $this->client->type == 2 ){
				return $this->client->company_name;
			}else{
				return $this->client->title . ' ' . $this->client->first_name . ' ' .$this->client->last_name;
			}
		}
	}

	public function displayHtmlTaskDue(){
		$html = '';
		$days = '';
		if($this->date < \Carbon\Carbon::now()){
			$html = '<span class="label label-danger">';
			$html .= $this->displayDueDate();
			$html .= '</span>';
		}else{
			$html = '<span class="label label-success">';
			$html .= $this->displayNumberOfLeftDays();
			$html .= $this->displayDueDate();
			$html .= '</span>';
		}
		return $html;
	}

	public function displayOverDueLabel(){
		return $this->displayNumberDayDue();
	}

	public function displayOverDueTodayLabel(){
		return $this->due_today;
	}

	public function displayOverDueNextSevenDaysLabel(){
		return $this->due_next_seven_days;
	}

	public function displayOverDueNextFutureLabel(){
		return $this->due_future;
	}

	public function setOverDueTodayLabel(){
		$i = 0;
		if( $this->displayNumberDayDue() == 0 ){
			$this->due_today += 1;
		}
	}

	public function setOverDueNextSevenDaysLabel(){
		$i = 0;
		if( $this->carbonDueDate()->diffInWeeks() == 1 && $this->date > \Carbon\Carbon::now()){
			$this->due_next_seven_days += 1;
		}
	}

	public function setOverDueNextFutureLabel(){
		$i = 0;
		if( $this->carbonDueDate()->diffInDays() > 14 && $this->date > \Carbon\Carbon::now()){
			$this->due_future += 1;
		}
	}

	public function displayNumberOfLeftDays(){
		if( $this->displayNumberDayDue() > 7 ){
			$strLabel = '';
			$day = ($this->displayNumberDayDue() % 7);
			if( $day == 0 ){
				$strLabel = '';
			}else{
				$strLabel = ($day > 1) ? $day . ' Days and ': $day . ' Day and ';
			}
			return $strLabel;
		}
	}

	public function carbonDueDate(){
		return \Carbon\Carbon::parse($this->date);
	}

	public function displayNumberDayDue(){
		return \Carbon\Carbon::parse($this->date)->diffInDays();
	}

	public function displayDueDate(){
		return \Carbon\Carbon::parse($this->date)->diffForHumans();
	}

	public function isReminded(){
		if($this->remind_mins > 0 && \Carbon\Carbon::parse($this->remind) <= \Carbon\Carbon::now()){
			return TRUE;
		}
		
		if(\Carbon\Carbon::parse($this->date) <= \Carbon\Carbon::now()){
			return TRUE;
		}
		
		return FALSE;
	} 
}
