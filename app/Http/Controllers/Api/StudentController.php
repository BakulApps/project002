<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student\Hobby;
use App\Models\Student\ParentStatus;
use App\Models\Student\Program;
use App\Models\Student\Purpose;
use App\Models\Student\Residence;
use App\Models\Student\SchoolFrom;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        switch ($request->_data){
            case 'hobby':
                $msg = $this->hobby($request);
                break;
            case 'purpose':
                $msg = $this->purpose($request);
                break;
            case 'residence' :
                $msg = $this->residence($request);
                break;
            case 'program' :
                $msg = $this->program($request);
                break;
            case 'parent_status' :
                $msg = $this->parent_status($request);
                break;
            case 'school_from' :
                $msg = $this->school_from($request);
                break;
            default :
                $msg = null;
                break;
        }

        return response()->json($msg);
    }
    public function hobby(Request $request)
    {
        if ($request->_type == 'select'){
            $hobbies = Hobby::all();
            foreach ($hobbies as $hobby){
                $msg[] = ['id' => $hobby->hobby_id, 'text' => $hobby->hobby_id .' - '. $hobby->hobby_name];
            }
        }
        return $msg;
    }

    public function purpose(Request $request)
    {
        if ($request->_type == 'select'){
            $purposes = Purpose::all();
            foreach ($purposes as $purpose){
                $msg[] = ['id' => $purpose->purpose_id, 'text' => $purpose->purpose_id .' - '. $purpose->purpose_name];
            }
        }
        return $msg;
    }

    public function residence(Request $request)
    {
        if ($request->_type == 'select'){
            $residences = Residence::all();
            foreach ($residences as $residence){
                $msg[] = ['id' => $residence->residence_id, 'text' => $residence->residence_id .' - '. $residence->residence_name];
            }
        }
        return $msg;
    }

    public function program(Request $request)
    {
        if ($request->_type == 'select'){
            $programs = Program::all();
            foreach ($programs as $program){
                $msg[] = ['id' => $program->program_id, 'text' => $program->program_id .' - '. $program->program_name];
            }
        }
        return $msg;
    }

    public function parent_status(Request $request)
    {
        if ($request->_type == 'select'){
            $statuses = ParentStatus::all();
            foreach ($statuses as $status){
                $msg[] = ['id' => $status->status_id, 'text' => $status->status_id .' - '. $status->status_name];
            }
        }
        return $msg;
    }

    public function school_from(Request $request)
    {
        if ($request->_type == 'select'){
            $froms = SchoolFrom::where('from_category', $request->_ladder)->get();
            foreach ($froms as $from){
                $msg[] = ['id' => $from->from_id, 'text' => $from->from_id .' - '. $from->from_name];
            }
        }
        return $msg;
    }
}
