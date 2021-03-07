<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Master\Civic;
use App\Models\Master\Distance;
use App\Models\Master\Earning;
use App\Models\Master\Gender;
use App\Models\Master\Home;
use App\Models\Master\Job;
use App\Models\Master\Religion;
use App\Models\Master\Study;
use App\Models\Master\Territory;
use App\Models\Master\Transport;
use App\Models\Master\Travel;
use Illuminate\Http\Request;

class MasterController extends Controller
{
    public function index(Request $request)
    {
        switch ($request->_data){
            case 'gender':
                $msg = $this->gender($request);
                break;
            case 'religion':
                $msg = $this->religion($request);
                break;
            case 'civic' :
                $msg = $this->civic($request);
                break;
            case 'province' :
                $msg = $this->province($request);
                break;
            case 'distric' :
                $msg = $this->distric($request);
                break;
            case 'subdistric' :
                $msg = $this->subdistric($request);
                break;
            case 'village' :
                $msg = $this->village($request);
                break;
            case 'distance' :
                $msg = $this->distance($request);
                break;
            case 'transport' :
                $msg = $this->transport($request);
                break;
            case 'travel' :
                $msg = $this->travel($request);
                break;
            case 'study' :
                $msg = $this->study($request);
                break;
            case 'job' :
                $msg = $this->job($request);
                break;
            case 'earning' :
                $msg = $this->earning($request);
                break;
            case 'home' :
                $msg = $this->home($request);
                break;
            default :
                $msg = null;
                break;
        }

        return $msg;
    }

    public function gender(Request $request)
    {
        if ($request->_type == 'select'){
            $genders = Gender::all();
            foreach ($genders as $gender){
                $msg[] = ['id' => $gender->gender_id, 'text' => $gender->gender_id .' - '. $gender->gender_name];
            }
        }
        return $msg;
    }

    public function religion(Request $request)
    {
        if ($request->_type == 'select'){
            $religions = Religion::all();
            foreach ($religions as $religion){
                $msg[] = ['id' => $religion->religion_id, 'text' => $religion->religion_id .' - '. $religion->religion_name];
            }
        }
        return $msg;
    }

    public function civic(Request $request)
    {
        if ($request->_type == 'select'){
            $civics = Civic::all();
            foreach ($civics as $civic){
                $msg[] = ['id' => $civic->civic_id, 'text' => $civic->civic_id .' - '. $civic->civic_name];
            }
        }
        return $msg;
    }

    public function province(Request $request)
    {
        if ($request->_type == 'select'){
            $provinces = Territory::select(['code_province', 'name_province'])->distinct()->orderBy('name_province')->get();
            foreach ($provinces as $province){
                $msg[] = ['id' => $province->code_province, 'text' => $province->code_province .' - '. $province->name_province];
            }
        }
        return $msg;
    }

    public function distric(Request $request)
    {
        if ($request->_type == 'select'){
            $districs = Territory::select(['code_distric', 'name_distric'])->distinct()->where('code_province', $request->province)->orderBy('name_distric')->get();
            foreach ($districs as $distric){
                $msg[] = ['id' => $distric->code_distric, 'text' => $distric->code_distric .' - '. $distric->name_distric];
            }
        }
        return $msg;
    }

    public function subdistric(Request $request)
    {
        if ($request->_type == 'select'){
            $subdistrics = Territory::select(['code_subdistric', 'name_subdistric'])->distinct()->where('code_distric', $request->distric)->orderBy('name_subdistric')->get();
            foreach ($subdistrics as $subdistric){
                $msg[] = ['id' => $subdistric->code_subdistric, 'text' => $subdistric->code_subdistric .' - '. $subdistric->name_subdistric];
            }
        }
        return $msg;
    }

    public function village(Request $request)
    {
        if ($request->_type == 'select'){
            $villages = Territory::select(['code_village', 'name_village'])->distinct()->where('code_subdistric', $request->subdistric)->orderBy('name_village')->get();
            foreach ($villages as $village){
                $msg[] = ['id' => $village->code_village, 'text' => $village->code_village .' - '. $village->name_village];
            }
        }
        return $msg;
    }

    public function distance(Request $request)
    {
        if ($request->_type == 'select'){
            $distances = Distance::all();
            foreach ($distances as $distance){
                $msg[] = ['id' => $distance->distance_id, 'text' => $distance->distance_id .' - '. $distance->distance_name];
            }
        }
        return $msg;
    }

    public function transport(Request $request)
    {
        if ($request->_type == 'select'){
            $transports = Transport::all();
            foreach ($transports as $transport){
                $msg[] = ['id' => $transport->transport_id, 'text' => $transport->transport_id .' - '. $transport->transport_name];
            }
        }
        return $msg;
    }

    public function travel(Request $request)
    {
        if ($request->_type == 'select'){
            $travels = Travel::all();
            foreach ($travels as $travel){
                $msg[] = ['id' => $travel->travel_id, 'text' => $travel->travel_id .' - '. $travel->travel_name];
            }
        }
        return $msg;
    }

    public function study(Request $request)
    {
        if ($request->_type == 'select'){
            $studies = Study::all();
            foreach ($studies as $study){
                $msg[] = ['id' => $study->study_id, 'text' => $study->study_id .' - '. $study->study_name];
            }
        }
        return $msg;
    }

    public function job(Request $request)
    {
        if ($request->_type == 'select'){
            $jobs = Job::all();
            foreach ($jobs as $job){
                $msg[] = ['id' => $job->job_id, 'text' => $job->job_id .' - '. $job->job_name];
            }
        }
        return $msg;
    }
    public function earning(Request $request)
    {
        if ($request->_type == 'select'){
            $earnings = Earning::all();
            foreach ($earnings as $earning){
                $msg[] = ['id' => $earning->earning_id, 'text' => $earning->earning_id .' - '. $earning->earning_name];
            }
        }
        return $msg;
    }

    public function home(Request $request)
    {
        if ($request->_type == 'select'){
            $homes = Home::all();
            foreach ($homes as $home){
                $msg[] = ['id' => $home->home_id, 'text' => $home->home_id .' - '. $home->home_name];
            }
        }
        return $msg;
    }
}
