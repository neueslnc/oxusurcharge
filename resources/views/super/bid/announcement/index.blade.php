@extends('template')


@section('body')

<div class="page-wrapper">
    <div class="page-content">
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Ariza</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">E'lon</li>

                    </ol>
                </nav>
            </div>
        </div>

        <div class="d-flex align-items-center">
            <h6 class="mb-0 text-uppercase">Barcha e'lon</h6>
        </div>

       

        <div class="card radius-10">
                 <div class="card-body">
                    @if ($status == 1 && $unfulfilled==0)
                    <hr>
                    <div class="row">
                        <a class="btn btn-success col-md-12" href="{{ route('superadmin.announcement_get_static')  }}">
                            EXPORT XLSX
                        </a>
                    </div>
                    <br>
                    <div class="col-md-3">
                        <label for="number" class="form-label ">Oylar</label>
                        <select id="month_filter" name="month_filter" class="form-select form-select-lg mb-3" >
                            <option value="1">Yanvar</option>
                            <option value="2" >Fevral</option>
                            <option value="3">Mart</option>
                            <option value="4" >Aprel</option>
                            <option value="5">May</option>
                            <option value="6" >Iyun</option>
                            <option value="7">Iyul</option>
                            <option value="8" >Avgust</option>
                            <option value="9">Sentyabr</option>
                            <option value="10" >Oktyabr</option>
                            <option value="11">Noyabr</option>
                            <option value="12" >Dekabr</option>
                        </select>
                    </div>
                    @endif
                    <div class="">
                        <table class="table table-bordered align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="fixed_header2 align-middle">#</th>
                                    <th class="fixed_header2 align-middle">E'lon beruvchi</th>
                                    <th class="fixed_header2 align-middle">E'lon berilgan sana</th>
                                    <th class="fixed_header2 align-middle">Manzil</th>
                                    <th class="fixed_header2 align-middle">Tadbir sanasi</th>
                                    <th class="fixed_header2 align-middle">Tadbir soati</th>
                                    <th class="fixed_header2 align-middle">Para</th>
                                    <th class="fixed_header2 align-middle">Мavzu</th>
                                    <th class="fixed_header2 align-middle">Guruh</th>
                                    <th class="col-1 fixed_header2 align-middle" >Izoh</th>
                                    <th class="fixed_header2 align-middle" style="width: 18%">Harakatlar</th>
                                </tr>
                            </thead>
                            <tbody id="list_data">

                                @foreach ($announcements as $i => $bid)
                                    <tr >
                                        <td>
                                            {{ ++$i }}
                                        </td>
                                        <td>
                                            {{ $bid->teacher->full_name }}
                                        </td>
                                        <td>
                                            {{ $bid->date_create() }}
                                        </td>
                                        <td>
                                            {{ $bid->location }}
                                        </td>
                                        <td>
                                            {{ $bid->date_format() }}
                                        </td>
                                        <td>
                                             {{ $bid->time }}
                                        </td>
                                        <td>
                                            {{ $bid->pair }}
                                        </td>
                                        <td>
                                            {{ $bid->theme }}
                                        </td>
                                        <td>
                                            {{ $bid->group }} - {{ $bid->group_name }}
                                        </td>
                                        <td class="col-1" >
                                            {{ $bid->description }}
                                        </td>
                                        <td>
                                            <div class="row">
                                                    @if ($status == 0)
                                                        <form class="col-md-6" action="{{ route("update_announcement_status", ['id' => $bid->id]) }}" method="post">
                                                            @csrf
                                                            <input type="hidden" name="status" value="1">
                                                            <button type="submit" class="btn btn-success btn-sm"><i class="bx bx-add-to-queue mr-1"></i>Qabul qilish</button>
                                                        </form>

                                                        <form class="col-md-6" action="{{ route("update_announcement_status", ['id' => $bid->id]) }}" method="post">
                                                            @csrf
                                                            <input type="hidden" name="status" value="2">
                                                            <button type="submit" class="btn btn-danger btn-sm"><i class="bx bx-trash mr-1"></i>Rad etish</button>
                                                        </form>
                                                    @endif

                                                @if ($status == 1 && $unfulfilled==0)
                                                    <form class="col-md-6" action="{{ route('update_announcement_unfulfilled', ['id' => $bid->id,'unfulfilled'=>1]) }}" method="post">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="btn btn-danger btn-sm"><i class="bx bx-trash mr-1"></i>E'lon bajarilmadi!</button>
                                                    </form>
                                                @endif
                                                    <form class="col-md-4">
                                                        <a class="btn btn-primary btn-sm" href="{{ route('superadmin.announcement.show', ['announcement' => $bid->id]) }}" target="_blank"><i class="bx bx-trash mr-1"></i>Просмотр</a>
                                                    </form>
                                            </div>
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
@push('scripte_include_end_body')
<script>

    function filter_group() {

        $.ajax('{{ route('superadmin.annoucment_month_filter') }}', {
            type : "GET",
            data : {

                'month_filter':$('#month_filter').val(),
                'status':'1',
                'unfulfilled':'0'
            },
            success : function (data, status){
                console.log(data);

                $('#list_data').html('')

                let html_row = '';
                let i=0;
                for (const iterator of data.messages) {
                    // var teacher=iterator.teacher;
                    var create = new Date(iterator.created_at);
                    var data = new Date(iterator.created_at);

                    // console.log(date);
                    i=i+1;
                    html_row += `

                    <tr>
                        <td>
                            ${ i }
                        </td>
                        <td>
                            ${ iterator.teacher.full_name}
                        </td>
                        <td>
                            ${iterator.date_create}
                        </td>
                        <td>
                            ${ iterator.location }
                        </td>
                        <td>
                            ${iterator.date_format}
                        </td>
                        <td>
                            ${ iterator.time }
                        </td>

                        <td>
                            ${ iterator.pair }
                        </td>
                        <td>
                            ${ iterator.theme }
                        </td>
                        <td>
                            ${ iterator.group }-${ iterator.group_name }
                        </td>
                        <td class="col-1">
                            ${ iterator.description }
                        </td>
                        <td>
                            <div class="row">
                                    <form class="col-md-4">
                                                        <a class="btn btn-primary btn-sm" href="announcement/${iterator.id}" target="_blank"><i class="bx bx-trash mr-1"></i>Просмотр</a>
                                                    </form>
                                </div>
                        </td>
                    </tr>
                    `
                }

                $('#list_data').html(html_row)
            }
        })
    };


    $('#month_filter').change( function () {
        filter_group();

        let a = document.createElement('a');
        a.href = `{{ route('superadmin.announcement_get_static') }}?month=${$("#month_filter option:selected").val()}`;
        document.body.append(a);
        a.click();
        a.remove();
    });
</script>






@endpush
