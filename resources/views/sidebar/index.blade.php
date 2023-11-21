<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{ url('logo.png') }}" width="10" height="50" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">{{ config('app.name') }}</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">

        @role('super_admin')
            <li class="">
                <a href="javascript:;" class="has-arrow" aria-expanded="false">
                    <div class="parent-icon"><i class='bx bx-home-circle'></i>
                    </div>
                    <div class="menu-title">Xodimlar</div>
                </a>
                <ul>
                    <li>
                        <a href="#" onclick="redrect('{{ route('superadmin.employees.index') }}')"><i class="bx bx-right-arrow-alt"></i>Xodimlar bazasi</a>
                    </li>
                    <li>
                        <a href="#" onclick="redrect('{{ route('departament.index') }}')"><i class="bx bx-right-arrow-alt"></i>Kafedra</a>
                    </li>
                    <li>
                        <a href="#" onclick="redrect('{{ route('emloyees.index') }}')"><i class="bx bx-right-arrow-alt"></i>Foydalanuvchi</a>
                    </li>
                </ul>
            </li>

            <li class="">
                <a href="javascript:;" class="has-arrow" aria-expanded="false">
                    <div class="parent-icon"><i class='bx bx-home-circle'></i>
                    </div>
                    <div class="menu-title">Ariza <span class="badge bg-warning text-dark" id="bid_count_active"></span> </div>
                </a>
                <ul>
                    <li> 
                        <a class="has-arrow" href="javascript:;">
                            <i class="bx bx-right-arrow-alt"></i>
                            E'lon
                            <span class="badge bg-warning text-dark" id="bid_1_count_active" style="margin-left: 5px;"></span>
                        </a>
                        <ul>
                            <li>
                                <a href="#" onclick="redrect('{{ route('superadmin.announcement.index', ['status' => 0,'unfulfilled'=>0]) }}')">
                                    <i class="bx bx-right-arrow-alt"></i>
                                    <div style="margin-right: 5px;">E'lon berish</div>
                                </a>
                            </li>
                            <li>
                                <a href="#" onclick="redrect('{{ route('superadmin.announcement.index', ['status' => 1,'unfulfilled'=>0]) }}')">
                                    <i class="bx bx-right-arrow-alt"></i>
                                    <div style="margin-right: 5px;">Qabul qilinganlar</div>
                                </a>
                            </li>
                            <li>
                                <a href="#" onclick="redrect('{{ route('superadmin.announcement.index', ['status' => 2,'unfulfilled'=>0]) }}')">
                                    <i class="bx bx-right-arrow-alt"></i>
                                    <div style="margin-right: 5px;">Rad etilganlar</div>
                                </a>
                            </li>
                            <li>
                                <a href="#" onclick="redrect('{{ route('superadmin.announcement.index', ['status' => 1,'unfulfilled'=>1]) }}')">
                                    <i class="bx bx-right-arrow-alt"></i>
                                    <div style="margin-right: 5px;">Bajarilmagan e'lonlar</div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li> 
                        <a class="has-arrow" href="javascript:;">
                            <i class="bx bx-right-arrow-alt"></i>
                            Bildirgi 
                            <span class="badge bg-warning text-dark" id="bid_2_count_active" style="margin-left: 5px;"></span>
                        </a>
                        <ul>
                            <li>
                                <a href="#" onclick="redrect('{{ route('superadmin.statement.index', ['status' => 0,'unfulfilled'=>0]) }}')">
                                    <i class="bx bx-right-arrow-alt"></i>
                                    <div style="margin-right: 5px;">Bildirgi berish</div>
                                </a>
                            </li>
                            <li>
                                <a href="#" onclick="redrect('{{ route('superadmin.statement.index', ['status' => 1,'unfulfilled'=>0]) }}')">
                                    <i class="bx bx-right-arrow-alt"></i>
                                    <div style="margin-right: 5px;">Qabul qilinganlar</div>
                                    <span class="badge bg-warning text-dark"></span>
                                </a>
                            </li>
                            <li>
                                <a href="#" onclick="redrect('{{ route('superadmin.statement.index', ['status' => 2,'unfulfilled'=>0]) }}')">
                                    <i class="bx bx-right-arrow-alt"></i>
                                    <div style="margin-right: 5px;">Rad etilganlar</div>
                                    <span class="badge bg-warning text-dark"></span>
                                </a>
                            </li>
                            <li>
                                <a href="#" onclick="redrect('{{ route('superadmin.statement.index', ['status' => 1,'unfulfilled'=>1]) }}')">
                                    <i class="bx bx-right-arrow-alt"></i>
                                    <div style="margin-right: 5px;">Bajarilmagan bildirgilar</div>
                                    <span class="badge bg-warning text-dark"></span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>

            <li> 
                <a href="javascript:;" class="has-arrow" aria-expanded="false">
                    <div class="parent-icon"><i class='bx bx-home-circle'></i>
                    </div>
                    <div class="menu-title">Maqola</div>
                    <span class="badge bg-warning text-dark" id="article_count_active" style="margin-left: 5px;"></span>
                </a>
                <ul>
                    <li>
                        <a href="#" onclick="redrect('{{ route('superadmin.article.index', ['status' => 0]) }}')">
                            <i class="bx bx-right-arrow-alt"></i>
                            <div style="margin-right: 5px;">Maqola berish</div>
                        </a>
                    </li>
                    <li>
                        <a href="#" onclick="redrect('{{ route('superadmin.article.index', ['status' => 1]) }}')">
                            <i class="bx bx-right-arrow-alt"></i>
                            <div style="margin-right: 5px;">Qabul qilinganlar</div>
                            <span class="badge bg-warning text-dark"></span>
                        </a>
                    </li>
                    <li>
                        <a href="#" onclick="redrect('{{ route('superadmin.article.index', ['status' => 2]) }}')">
                            <i class="bx bx-right-arrow-alt"></i>
                            <div style="margin-right: 5px;">Rad etilganlar</div>
                            <span class="badge bg-warning text-dark"></span>
                        </a>
                    </li>
                </ul>
            </li>

            <li> 
                <a href="javascript:;" class="has-arrow" aria-expanded="false">
                    <div class="parent-icon"><i class='bx bx-home-circle'></i>
                    </div>
                    <div class="menu-title">Xabarnomalar</div>
                    <span class="badge bg-warning text-dark" id="article_count_active" style="margin-left: 5px;"></span>
                </a>
                <ul>
                    <li>
                        <a href="#" onclick="redrect('{{ route('superadmin.notification_user.index') }}')">
                            <i class="bx bx-right-arrow-alt"></i>
                            <div style="margin-right: 5px;">Xabarnomalar bazasi</div>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="">
                <a href="javascript:;" class="has-arrow" aria-expanded="false">
                    <div class="parent-icon">
                        <i class='bx bx-home-circle'></i>
                    </div>
                    <div class="menu-title">SMS-Xabarnoma </div>
                </a>
                <ul>
                    <li>
                        <a href="#" onclick="redrect('{{ route('superadmin.sms_message.index',['admin_id'=>Auth::user()->id]) }}')">
                            <i class="bx bx-right-arrow-alt"></i>
                            <div style="margin-right: 5px;">SMS-Xabar</div>
                            <span class="badge bg-warning text-dark"></span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="">
                <a href="javascript:;" class="has-arrow" aria-expanded="false">
                    <div class="parent-icon">
                        <i class='bx bx-home-circle'></i>
                    </div>
                    <div class="menu-title">Hisobotlar</div>
                </a>
                <ul>
                    @foreach ($criterias as $criteria)
                        <li>
                            <a href="#" onclick="redrect('{{ route('report_archive_criteria', ['criteria_id' => $criteria->id]) }}')">
                                <i class="bx bx-right-arrow-alt"></i>
                                <div style="margin-right: 5px;">{{ $criteria->name }}</div>
                                <span class="badge bg-warning text-dark"></span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </li>

            <script>

                async function announcement_count() {

                    let count = 0;

                    return await $.ajax('/get_count_active_announcement_counts', {
                        type: 'GET',
                    }).then(async (data) => {
                        if (data.announcement_count > 0) {
                            $("#bid_1_count_active").html(data.announcement_count);
                        }
                        return data.announcement_count;
                    })
                    .catch(error => console.log('Error:', error));
                }

                async function statement_count() {

                    let count = 0;

                    return await $.ajax('/get_count_active_statement_counts', {
                        type: 'GET',
                    }).then(async (data) => {
                        if (data.statement_count > 0) {
                            $("#bid_2_count_active").html(data.statement_count);
                        }
                        return data.statement_count;
                    })
                    .catch(error => console.log('Error:', error));
                }

                async function article_count() {

                    let count = 0;

                    return await $.ajax('/superadmin/get_count_active_article_counts', {
                        type: 'GET',
                    }).then(async (data) => {
                        if (data.article_count > 0) {
                            $("#article_count_active").html(data.article_count);
                        }
                        return data.article_count;
                    })
                    .catch(error => console.log('Error:', error));
                }

                async function main() {

                    let i = 0;

                    i += await announcement_count();

                    i += await statement_count();

                    article_count();

                    if (i > 0) {
                        $("#bid_count_active").html(i);
                    }
                }

                main()

                setInterval(() => {
                    main();
                }, 100000);
            </script>
        @endrole

        @role('user')

            <li class="">
                <a href="javascript:;" class="has-arrow" aria-expanded="false">
                    <div class="parent-icon">
                        <i class='bx bx-home-circle'></i>
                    </div>
                    <div class="menu-title">Profil</div>
                </a>
                <ul>
                    <li>
                        <a href="#" onclick="redrect('{{ route('profiles.show', ['profile' => auth()->user()->id ]) }}')">
                            <i class="bx bx-right-arrow-alt"></i>
                            <div style="margin-right: 5px;">Ma`lumot</div>
                            <span class="badge bg-warning text-dark"></span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="">
                <a href="javascript:;" class="has-arrow" aria-expanded="false">
                    <div class="parent-icon">
                        <i class='bx bx-home-circle'></i>
                    </div>
                    <div class="menu-title">Ariza</div>
                </a>
                <ul>
                    <li>
                        <a href="#" onclick="redrect('{{ route('user.announcement.index') }}')">
                            <i class="bx bx-right-arrow-alt"></i>
                            <div style="margin-right: 5px;">E'lon</div>
                            <span class="badge bg-warning text-dark"></span>
                        </a>
                    </li>
                    <li>
                        <a href="#" onclick="redrect('{{ route('user.statement.index') }}')">
                            <i class="bx bx-right-arrow-alt"></i>
                            <div style="margin-right: 5px;">Bildirgi</div>
                            <span class="badge bg-warning text-dark"></span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="">
                <a onclick="redrect('{{ route('user.message.index') }}')" class="" aria-expanded="false">
                    <div class="parent-icon"><i class='bx bx-home-circle'></i>
                    </div>
                    <div class="menu-title">Xabarlar</div>
                </a>
            </li>
            <li class="">
                <a onclick="redrect('{{ route('user.article.index') }}')" class="" aria-expanded="false">
                    <div class="parent-icon"><i class='bx bx-home-circle'></i>
                    </div>
                    <div class="menu-title">Maqola</div>
                </a>
            </li>

        @endrole

        @role('admin')

            <li class="">
                <a href="javascript:;" class="has-arrow" aria-expanded="false">
                    <div class="parent-icon"><i class='bx bx-home-circle'></i>
                    </div>
                    <div class="menu-title">Xodimlar</div>
                </a>
                <ul>
                    <li>
                        <a href="#" onclick="redrect('{{ route('admin.employees.index') }}')"><i class="bx bx-right-arrow-alt"></i>Kafedra</a>
                    </li>
                </ul>
            </li>

        @endrole

    </ul>
    <!--end navigation-->
</div>

<script>

    function redrect(url) {
        window.location.href = url;
    }

</script>
