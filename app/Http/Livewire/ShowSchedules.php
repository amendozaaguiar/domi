<?php

namespace App\Http\Livewire;

use App\Models\Schedule;
use App\Models\ScheduleRequest;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ShowSchedules extends Component
{
    public $schedules;
    public $schedule;
    public $schedule_requests;
    public $user_id;
    //public $exists_schedule_request;

    public function mount()
    {
        $this->user_id = Auth::user()->id;
        $this->schedules = $this->get_schedules();
        $this->schedule_requests = $this->get_schedule_requests_by_user($this->user_id);
        //$this->exists_schedule_request = false;
    }


    public function render()
    {
        return view('livewire.show-schedules', compact(['schedules' => $this->schedules, 'schedule_requests' => $this->schedule_requests]));
    }


    public function store_schedule_requests($schedule_id)
    {


        $user_schedule_request = $this->get_schedule_requests_by_schedule_and_by_user($schedule_id, $this->user_id);

        if($user_schedule_request->count()==0)
        {
            $this->schedule = $this->get_schedule($schedule_id);

            if($this->schedule->allocations < $this->schedule->maximum_allocation)
            {
                $schedule_request = new ScheduleRequest;
                    $schedule_request->schedule_id = $schedule_id;
                    $schedule_request->user_id = $this->user_id;
                $schedule_request->save();

                $this->increment_allocation_counter($schedule_id);

                session()->flash('message-success', 'La solicitud de domiciliario, en el horario '.$this->schedule->time.' ha sido registrada');
            }
            else
            {
                session()->flash('message-danger', 'No ha podido se asignar el domiciliario, el limite de '.$this->schedule->maximum_allocation.' ha sido superado.');
            }
        }
        else
        {
            $user_schedule_request->delete();
            $this->decrease_allocation_counter($schedule_id);

            session()->flash('message-success', 'La solicitud de domiciliario, ha sido eliminada');
        }

        $this->schedules = $this->get_schedules();
        $this->schedule_requests = $this->get_schedule_requests_by_user($this->user_id);
    }


    private function get_schedules()
    {
        return Schedule::all();
    }


    private function get_schedule($schedule_id)
    {
        return Schedule::find($schedule_id);
    }


    private function get_schedule_requests_by_schedule_and_by_user($schedule_id, $user_id)
    {
        return ScheduleRequest::where([[
            'schedule_id', '=', $schedule_id
        ],
        [
            'user_id', '=', $user_id
        ]])
        ->limit(1);
    }


    private function increment_allocation_counter($schedule_id)
    {
        $schedule = Schedule::find($schedule_id);
            $schedule->allocations += 1;
        $schedule->save();
    }


    private function decrease_allocation_counter($schedule_id)
    {
        $schedule = Schedule::find($schedule_id);
            $schedule->allocations -= 1;
        $schedule->save();
    }

    public function get_schedule_requests_by_user($user_id)
    {
        return ScheduleRequest::where('user_id', '=', $user_id)->get();
    }
}
