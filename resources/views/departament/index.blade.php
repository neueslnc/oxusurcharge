@extends('template')

@section('body')

<div class="page-wrapper">
    <div class="page-content">
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Kafedralar</div>
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
            <h6 class="mb-0 text-uppercase">Barcha kafedralar</h6>
        </div>

        <div class="d-flex align-items-center">
            <div class="ms-auto">
                <a href="{{ route('departament.create') }}" class="btn btn-primary px-3"><i class="bx bx-plus"></i>Yangi qo`shish</a>
            </div>
        </div>


        <hr>


        <div class="card radius-10">
                 <div class="card-body">

                    <div class="">
                        <table class="table table-bordered align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="fixed_header2 align-middle">#</th>
                                    <th class="fixed_header2 align-middle">Nomlanishi</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($all as $i => $item)
                                    <tr>
                                        <td>
                                            {{ ++$i }}
                                        </td>
                                        <td>
                                            {{ $item->name }}
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
