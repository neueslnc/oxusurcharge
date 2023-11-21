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
                        <li class="breadcrumb-item active" aria-current="page">Bildirgi</li>
                        <li class="breadcrumb-item active" aria-current="page">Bildirgi yangi</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-10 mx-auto">
                <h6 class="mb-0 text-uppercase">Yangi e'lon formasi</h6>
                <hr>
                <div class="card border-top border-0 border-4 border-primary">
                    <div class="card-body p-5">
                        <div class="card-title d-flex align-items-center">
                            <div><i class="bx bxs-user me-1 font-22 text-primary"></i>
                            </div>
                            <h5 class="mb-0 text-primary">Ma'lumotlarni to'ldiring</h5>
                        </div>
                        <hr>
                        <form class="row g-3" method="post" action="{{ route('user.statement.store') }}">
                            @csrf
                            <div class="col-12">
                                @foreach ($errors->all() as $error)
                                    <div class="alert alert-danger border-0 bg-danger alert-dismissible fade show">
                                        <div class="text-white">{{ $error }}</div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="col-md-3">
                                <label for="theme" class="form-label">Mavzu</label>
                                <input type="text" name="theme" class="form-control" id="theme">
                            </div>
                            <div class="col-md-3">
                                <label for="subject" class="form-label">Fan nomi</label>
                                <input type="text" name="subject" class="form-control" id="subject">
                            </div>
                            <div class="col-md-3">
                                <label for="group" class="form-label">Gurux raqami</label>
                                <input type="text" name="group" class="form-control" id="group">
                            </div>
                            <div class="col-md-3">
                                <label for="group_name" class="form-label">Gurux nomi</label>
                                <input type="text" name="group_name" class="form-control" id="group_name">
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="date" class="form-label">O`tkazish sanasi</label>
                                        <input type="date" name="date" class="form-control" id="date">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="pair" class="form-label">Para</label>
                                        <input type="text" name="pair" class="form-control" id="pair">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="location" class="form-label">Manzil</label>
                                <input type="text" name="location" class="form-control" id="location">
                            </div>
                            <div class="col-md-12">
                                <label for="description" class="form-label">Ariza matni</label>
                                <textarea class="form-control" id="description" name="description" rows="8"></textarea>
                            </div>

                            <div class="col-12">
                                <button type="submit" class="btn btn-primary px-5">Saqlash</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
   </div>
</div>

@endsection
