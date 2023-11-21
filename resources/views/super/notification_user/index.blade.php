@extends('template')

@section('body')

<div class="page-wrapper">
    <div class="page-content">
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Xabarnomalar</div>
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
            <h6 class="mb-0 text-uppercase">Xabarnomalar</h6>
        </div>

        <div class="d-flex align-items-center">
            <div class="ms-auto">
                <a href="{{ route('superadmin.notification_user.create') }}" class="btn btn-primary px-3"><i class="bx bx-plus"></i>Yangi xabarnoma</a>
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
                                <th class="fixed_header2 align-middle">
                                    Mavzu <br>
                                    <select class="single-select" id="theme" name="theme">
                                        <option value="">None</option>
                                        @foreach ($themes as $theme)
                                            <option value="{{ $theme->name }}" {{ $sort_title == $theme->name ? "selected" : "" }}>{{ $theme->name }}</option>
                                        @endforeach
                                    </select>
                                </th>
                                <th class="fixed_header2 align-middle">Xabar</th>
                                <th class="fixed_header2 align-middle" id="sort_date">Sana <i class="lni {{ $sort_date == 'top' || empty($sort_date) ? 'lni-arrow-up' : 'lni-arrow-down' }}"></i></th>
                                <th class="fixed_header2 align-middle">
                                    Kim yubordi <br>
                                    <select class="single-select" id="sender" name="sender">
                                        <option value="">None</option>
                                        @foreach ($senders as $sender)
                                            <option value="{{ $sender->id }}" {{ $sort_sender == $sender->id ? "selected" : "" }}>{{ $sender->full_name }}</option>
                                        @endforeach
                                    </select>
                                </th>
                                <th class="fixed_header2 align-middle">
                                    Kimga yubordi 
                                    <select class="single-select" id="recipient" name="recipient">
                                        <option value="">None</option>
                                        @foreach ($recipients as $recipient)
                                            <option value="{{ $recipient->id }}" {{ $sort_recipient == $recipient->id ? "selected" : "" }}>{{ $recipient->full_name }}</option>
                                        @endforeach
                                    </select>
                                </th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($news as $i => $new)
                                <tr>
                                    <td>
                                        {{ ++$nomer }}
                                    </td>
                                    <td>
                                        {{ $new->title }}
                                    </td>
                                    <td>
                                        {{ $new->message }}
                                    </td>
                                    <td>
                                        {{ $new->date_create() }}
                                    </td>
                                    <td>
                                        {{ $new->admin_send->full_name}}
                                    </td>
                                    <td>
                                        {{$new->admin_user->full_name}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="card-body">

                        {{ $news->links() }}
                    </div>

                </div>
            </div>
        </div>
   </div>
</div>

@endsection

@section('scripte_include_end_body')

    <script src="{{ url('assets/plugins/select2/js/select2.min.js') }}"></script>

    <script>
        
        $('.single-select').select2({
            theme: 'bootstrap4',
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            allowClear: Boolean($(this).data('allow-clear')),
        });

        let sort_date_const = '{{ $sort_date }}';

        let sort_title_const = '{{ $sort_title }}';

        let sort_sender_const = '{{ $sort_sender }}';

        let sort_recipient_const = '{{ $sort_recipient }}';

        function redirect(sort_date, sort_title, sort_sender, sort_recipient) {
         
            window.location.href = `{{ route('superadmin.notification_user.index') }}?sort_date=${ sort_date }&sort_title=${ sort_title }&sort_sender=${ sort_sender }&sort_recipient=${ sort_recipient }&page={{ $page }}`;
        }

        $("#sort_date").on('click', function () {
            
            let sort_date = sort_date_const == '' || sort_date_const == 'top' ? 'bot' : 'top';

            redirect(sort_date, sort_title_const, sort_sender_const, "");
        });

        $("#theme").on('select2:select', function (e) {
            
            redirect(sort_date_const, e.params.data.id, sort_sender_const, sort_recipient_const);

        });

        $("#sender").on('select2:select', function (e) {
            
            redirect(sort_date_const, sort_title_const, e.params.data.id, sort_recipient_const);
        });

        $("#recipient").on('select2:select', function (e) {
            
            redirect(sort_date_const, sort_title_const, sort_sender_const, e.params.data.id);
        });
    </script>

@endsection