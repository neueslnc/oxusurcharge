@extends('template')

@section('style')

    <style>

        tbody th {
            position: -webkit-sticky; /* for Safari */
            position: sticky;
            left: 0;
            background: #FFF;
            border-right: 1px solid #CCC;
        }

        .fixed_header {
            position: -webkit-sticky; /* for Safari */
            position: sticky;
            left: 0;
            /* background: #8f8d8d; */
            border-right: 1px solid #CCC;
        }

        .fixed_header2 {
            position: -webkit-sticky; /* for Safari */
            position: sticky;
            top: 0;
            /* background: #8f8d8d; */
            border-right: 1px solid #CCC;
        }

        .criteria {
            width : 50px;
        }

    </style>

@endsection

@section('body')

<div class="page-wrapper">
    <div class="page-content">
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Hisobotlar</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="d-flex align-items-center">
            <h6 class="mb-0 text-uppercase">{{ $criteria->name }}</h6>
        </div>
        <hr>

        <div class="card radius-10">
                 <div class="card-body">

                    <div class="row mb-5">
                        <div class="col-md-12">                    
                            <select class="form-select mb-3" aria-label="Default select example" id="type_output">
                                <option value="0">Barchasi</option>
                                @foreach ($departamets as $departamet)
                                    <option value="{{ $departamet->id }}">{{ $departamet->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="row">
                                <div class="col-md-12">
                                    <input id="month" type="month" class="form-control" value="{{ date('Y-m', strtotime("{$date_from}")) }}">
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary col-md-12" id="search">
                            Qidirmoq
                        </button>
                    </div>

                    <div class="">
                        <table id="mytable" class="table table-bordered align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="fixed_header2 align-middle">#</th>
                                    <th class="fixed_header2 align-middle">F.I.O </th>
                                    <th scope="col" class="align-middle fixed_header2"  style=" width: 100px; word-wrap: break-word !important;">{{ $criteria->name }}</th>
                                </tr>
                            </thead>
                            <tbody id="data_list">
                                @foreach ($teachers as $i => $teacher)

                                    <tr id="teacher_{{ $teacher->id }}" class="departaments departament_{{ $teacher->departament_id }}" style="display: ;">
                                        <td>
                                            {{ ++$i }}
                                        </td>
                                        <th style="background-color: white;">
                                            <a href="{{ route("superadmin.employees.show", ["employee" => $teacher->id ]) }}">{{ $teacher->full_name }}</a>
                                        </th>

                                        <td>
                                            @if (date('Y-m') == date_format(date_create($date_from), 'Y-m'))

                                                {{ $teacher->on_criteria_active($criteria->id)->first() ? $teacher->on_criteria_active($criteria->id)->first()->data : "0" }} %
                                            @else
                                            
                                                {{ $teacher->get_percent_archive_criteria($criteria->id, $date_from, $date_to) }} %
                                            @endif

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                 </div>
            </div>
        </div>
   </div>
</div>
@endsection

@section('scripte_include_end_body')

<script>

    $("#type_output").on("change", function (e) {

        let type_output = $("#type_output").val();

        if(type_output == 0){

            $(`.departaments`).css("display", "");
        }else{

            $('.departaments').css("display", "none")
            $(`.departament_${type_output}`).css("display", "");
        }
    });

    $("#search").on("click", function () {

        window.location.href = `{{ route("report_archive_criteria", ['criteria_id' => $criteria->id]) }}/${ $("#month").val() }`
        
    });

</script>
    
@endsection
