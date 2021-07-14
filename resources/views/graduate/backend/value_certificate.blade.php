@extends('graduate.layouts.master', ['title' => 'Penilaian'])
@section('js')
    <script src="{{asset('assets/js/plugins/datatables/datatables.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/selects/select2.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/styling/uniform.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/notifications/pnotify.min.js')}}"></script>
@endsection
@section('jspage')
    <script src="{{asset('assets/apps/graduate/backend/js/value_certificate.js')}}"></script>
@endsection
@section('breadcrumb')
    <span class="breadcrumb-item">Penilaian</span>
    <span class="breadcrumb-item active">Nilai Ijazah</span>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-white header-elements-inline">
                    <h5 class="card-title">NILAI IJAZAH</h5>
                </div>
                <table class="table table-sm table-bordered datatable-ijazah">
                    <thead>
                    <tr class="text-center">
                        <td>NAMA SISWA</td>
                        @foreach(\App\Models\Master\Subject::OrderBy('subject_number')->get() as $subject)
                            <td>{{$subject->subject_code}}_KD3</td>
                            <td>{{$subject->subject_code}}_KD4</td>
                        @endforeach
                    </tr>
                    </thead>
                    <tbody class="text-center">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
