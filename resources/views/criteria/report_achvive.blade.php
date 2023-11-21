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

@php
    
    $users = [];

@endphp

<div class="page-wrapper">
    <div class="page-content">
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Xodimlar</div>
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
            <h6 class="mb-0 text-uppercase">Xodimlar bazasi</h6>
        </div>
        <hr>

        <div class="card radius-10">
                 <div class="card-body">
                    <select class="form-select mb-3" aria-label="Default select example" id="type_output">
                        <option value="0">Barchasi</option>
                        <option value="1">Kafedra - 1</option>
                        <option value="2">Kafedra - 2</option>
                    </select>

                    <div class="">
                        <table id="mytable" class="table table-bordered align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="fixed_header2 align-middle">#</th>
                                    <th class="fixed_header2 align-middle">F.I.O </th>
                                    <th id="sort_status" class="fixed_header2 align-middle">Status <div id="icon_s"> <i class="lni lni-arrow-up"></i> </div></th>
                                    @foreach ($criterias as $item)
                                        <th scope="col" class="align-middle fixed_header2"  style=" width: 100px; word-wrap: break-word !important;">{{ $item->name }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody id="data_list">
                                @foreach ($teachers as $teacher)

                                    <tr id="teacher_{{ $teacher->id }}" class="departament_{{ $teacher->departament_id }}" style="display: ;">
                                        <td>
                                            {{ $teacher->id }}
                                        </td>
                                        <th style="background-color: white;">
                                            <a href="{{ route("superadmin.employees.show", ["employee" => $teacher->id ]) }}">{{ $teacher->full_name }}</a> <div id="precent_{{ $teacher->id }}"></div>
                                        </th>
                                        
                                        <td>
                                            <div class="progress" style="height: 15px;">
                                                <div id="person_{{ $teacher->id }}" data-value="{{ $teacher->get_percent_archive() }}" class="progress-bar bg-gradient-quepal" role="progressbar" style="width: {{ $teacher->get_percent_archive() }}%"></div>
                                            </div>
                                            {{ $teacher->get_percent_archive() }} %
                                        </td>

                                        @foreach ($criterias as $num => $item)

                                            <td>
                                                <div class="progress" style="height: 15px;">
                                                    <div id="person_{{ $teacher->id }}" data-value="{{ $teacher->get_percent_archive_criteria($item->id) }}" class="progress-bar  {{ $item->increase == 'positive' ? "bg-gradient-quepal" : "bg-gradient-bloody" }}" role="progressbar" style="width: {{ $teacher->get_percent_archive_criteria($item->id) }}%"></div>
                                                </div>
                                                {{ $teacher->get_percent_archive_criteria($item->id) }} %
                                            </td>

                                        @endforeach
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
<input type="hidden" id="sort_status_flag" value="asc">
<script>

    let users = {{ Js::from($teachers) }};

    let user_sort = true;

    $("#type_output").on("change", function (e) {

        let type_output = $("#type_output").val();

        if(type_output == 1){

            $(`.departament_1`).css("display", "");
            $(`.departament_2`).css("display", "none");
        }else if(type_output == 2){

            $(`.departament_1`).css("display", "none");
            $(`.departament_2`).css("display", "");
        }else{

            $(`.departament_1`).css("display", "");
            $(`.departament_2`).css("display", "");
        }

    });

    $("#sort_status").on("click", function () {
       
        if (user_sort) {
            
            users.sort((a, b) => a.percent < b.percent ? 1 : -1);

            $('#icon_s').html('<i class="lni lni-arrow-down"></i>');
        }else{
            users.sort((a, b) => a.percent > b.percent ? 1 : -1);
            
            $('#icon_s').html('<i class="lni lni-arrow-up"></i>');
        }
        
        user_sort = !user_sort;

        let html = '';

        let type_output = $("#type_output").val();

        for (const iterator of users) {
            
            if (type_output != 0) {
                if (iterator.departament_id == type_output) {
                    
                    html += `<tr id='teacher_${ iterator.id }' class='departament_${ iterator.departament_id }'> ${$(`#teacher_${ iterator.id }`).detach().html()} </tr>`;
                }else{
                    html += `<tr id='teacher_${ iterator.id }' class='departament_${ iterator.departament_id }' style="display: none;"> ${$(`#teacher_${ iterator.id }`).detach().html()} </tr>`;

                }
            }else{

                html += `<tr id='teacher_${ iterator.id }' class='departament_${ iterator.departament_id }'> ${$(`#teacher_${ iterator.id }`).detach().html()} </tr>`;
            }
            
        }

        $("#data_list").html(html);
    });

</script>

@endsection
