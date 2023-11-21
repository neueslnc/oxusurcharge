<header>
    <div class="topbar d-flex align-items-center">
        <nav class="navbar navbar-expand">
            <div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
            </div>
            <div class="search-bar flex-grow-1">
                <div class="position-relative search-bar-box">
                    <input type="text" class="form-control search-control" placeholder="Поиск ..."> <span class="position-absolute top-50 search-show translate-middle-y"><i class='bx bx-search'></i></span>
                    <span class="position-absolute top-50 search-close translate-middle-y"><i class='bx bx-x'></i></span>
                </div>
            </div>

            @role('user')

                <div class="top-menu ms-auto">
                    <ul class="navbar-nav align-items-center">
                        <li class="nav-item mobile-search-icon">
                            <a class="nav-link" href="#">	<i class="bx bx-search"></i>
                            </a>
                        </li>
                        <li class="nav-item dropdown dropdown-large">
                            <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">

                                <i class="bx bx-bell"></i>

                                <div id="alert_notification_count">

                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="javascript:;">
                                    <div class="msg-header">
                                        <p class="msg-header-title">Xabarnomalar</p>
                                        {{-- <p class="msg-header-clear ms-auto">Marks all as read</p> --}}
                                    </div>
                                </a>
                                <div class="header-notifications-list ps" id="notification_list">
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>

            @endrole

            <div class="user-box dropdown">
                <a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="{{ url('avatar-1.png') }}" class="user-img" alt="user avatar">
                    <div class="user-info ps-3">
                        <p class="user-name mb-0">{{ auth()->user()->full_name }}</p>
                        <p class="designattion mb-0">{{ __(auth()->user()->user_level->name) }}</p>
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="{{ route('destroy') }}"><i class='bx bx-log-out-circle'></i><span>{{ __("exit") }}</span></a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>

    <div id="notification_modals">

    </div>

    @role('user')

        <script>

            function notification_main() {

                $.ajax('/user/get_notification', {
                    type: 'GET',
                    success: function (data, status) {

                        let html = ``;

                        let html_modal = ``;

                        for (const iterator of data.notifications) {
                            html += `
                            <a class="dropdown-item" href="javascript:;">
                                <div class="d-flex align-items-center">
                                    <div class="notify bg-light-primary text-primary"><i class="bx bx-group"></i>
                                    </div>
                                    <div class="flex-grow-1" data-bs-toggle="modal" data-bs-target="#exampleExtraLargeModal_${ iterator['id'] }">
                                        <h6 class="msg-name">${ iterator['title'] }<span class="msg-time float-end">${  iterator['date'] }</span></h6>
                                        <p class="msg-info">${ iterator['message'] }</p>
                                    </div>
                                </div>
                            </a>

                            `;

                            html_modal += `
                            <div class="nm modal fade" id="exampleExtraLargeModal_${ iterator['id'] }" tabindex="-1" aria-hidden="true" style="display: none;" data-id="${ iterator['id'] }">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">${ iterator['title'] }</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">

                                                ${ iterator['message'] }
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            `;
                        }
                        $('#notification_list').html(html);

                        $('#notification_modals').html(html_modal);

                        $('#alert_notification_count').html(`
                            <span class="alert-count">${data.count}</span>
                        `);

                        var myModalEl = document.getElementsByClassName('nm')

                        for (const iterator of myModalEl) {

                            console.log(iterator);

                            iterator.addEventListener('show.bs.modal', function (event) {

                                console.log();

                                $.ajax('/user/set_status_notification', {
                                    type: 'POST',
                                    data: {
                                        "_token": "{{ csrf_token() }}",
                                        "id" : $(iterator).data('id')
                                    },
                                    success: function (data, status) {
                                    },
                                    error: function (jqXhr, textStatus, errorMessage) {

                                        console.log(errorMessage);
                                    }
                                });

                            });

                            iterator.addEventListener('hide.bs.modal', function (event) {

                                notification_main();

                            });

                        }
                    },
                    error: function (jqXhr, textStatus, errorMessage) {

                        console.log(errorMessage);
                    }
                });
            }

            notification_main();

            setInterval(() => {
                notification_main();
            }, 100000);

        </script>

    @endrole

</header>
