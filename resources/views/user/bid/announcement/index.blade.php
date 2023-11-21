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

        @if ($status == 0)

            <div class="d-flex align-items-center">
                <div class="ms-auto">
                    <a href="{{ route('user.announcement.create') }}" class="btn btn-primary px-3"><i class="bx bx-plus"></i>E'lon yaratish</a>
                </div>
            </div>
        @endif


        <hr>


        <div class="card radius-10">
            <div class="card-body">
                {{-- <div class="alert alert-light"  role="alert">
                  Qator--Bu hali ko'rilmagan e'lonlar rangi!
                  </div>
                  <div class="alert alert-success" role="alert">
                    Qator--Ruxsat berilgan e'lonlar rangi!
                  </div>
                  <div class="alert alert-warning" role="alert">
                    Qator--Bajarilmagan e'lonlar rangi!
                  </div>
                  <div class="alert alert-danger" role="alert">
                    Qator--rad etilgan e'lonlar rangi!
                  </div> --}}
                  <table class="table table-bordered align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                        
                        </tr>
                    </thead>
                    <tbody>

                        <tr class="">
                <td>
                    Qator--Bu hali ko'rilmagan e'lonlar rangi!
                </td>
               </tr>
               <tr class="table-success">
                <td>
                    Qator--Ruxsat berilgan e'lonlar rangi!
                </td>
               </tr>
               <tr class="table-warning">
                <td>
                    Qator--Bajarilmagan e'lonlar rangi!
                </td>
               </tr>
               <tr class="table-danger">
                <td>
                    Qator--Rad etilgan e'lonlar  rangi!
                </td>
               </tr>
                    </tbody>
                </table>
         
            </div>
                 <div class="card-body">

                    <div class="">
                        <table class="table table-bordered align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="fixed_header2 align-middle">#</th>
                                    <th class="fixed_header2 align-middle">E'lon berilgan sana</th>
                                    <th class="fixed_header2 align-middle">Tadbir sanasi</th>
                                    <th class="fixed_header2 align-middle">Tadbir soati</th>
                                    <th class="fixed_header2 align-middle">Para</th>
                                    <th class="fixed_header2 align-middle">Мavzu</th>
                                    <th class="fixed_header2 align-middle">Guruh </th>
                                    <th class="fixed_header2 align-middle">Manzil </th>
                                    <th class="fixed_header2 align-middle">Izoh</th>
                                </tr>
                            </thead>
                            <tbody>
{{-- @dd($announcements) --}}
                                @foreach ($announcements as $i => $bid)
                                 @php
                                   $class="";
                                 if ($bid->unfulfilled==0 && $bid->status==0 ) {
                                    $class="";
                                 }
                                 elseif ($bid->unfulfilled==0 && $bid->status==1) {
                                    $class="table-success";
                                 }
                                 elseif ($bid->unfulfilled==1 && $bid->status==1) {
                                    $class="table-warning";
                                 }
                                 elseif ($bid->unfulfilled==0 && $bid->status==2) {
                                    $class="table-danger";
                                 }
                                  
                                 @endphp
                                      
                                            <tr class="{{ $class }}">
                                               
                                                    <td> 
                                                        {{ ++$i }}
                                                      </td>
                                             
                                                <td>
                                                    {{ $bid->date_create() }}
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
                                                <td>
                                                    {{ $bid->location }}
                                                </td>
                                                <td>
                                                    {{ $bid->description }}
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
