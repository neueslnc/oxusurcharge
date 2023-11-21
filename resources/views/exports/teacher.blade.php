<table>
    <thead>
    <tr>
        <th style="width: 20px;">#</th>
        <th style="width: 110px;">F.I.O </th>
        @foreach ($criterias as $key => $item)

            @if ($item->increase=='positive')
                <th style="width: {{ in_array($key, array(6,9,13)) ? '200px' : '80px' }};color:#198754;">
                    @if ($item->increase=='positive')
                        <div>
                            <div> <span >{{ $item->name }}</span></div>
                            <br>
                            <div><span>
                                    @if ($item->increase=='positive')
                                        +5
                                    @else
                                        -5
                                    @endif
                                </span>
                            </div>
                        </div>

                    @else
                        <div>
                            <div><span >{{ $item->name }}</span></div>
                            <br>
                            <div> <span style="padding-top: 50px">
                                    @if ($item->increase=='positive')
                                        +5
                                    @else
                                        -5
                                    @endif</span>
                            </div>
                        </div>
                    @endif
                </th>
            @else
                <th style="width: 110px;color:  #dc3545;" >
                    @if ($item->increase=='positive')
                        <div>
                            <div>
                                <span style="color: #198754;">{{ $item->name }}</span>
                            </div>
                            <br>
                            <div> <span style="padding-top: 50px">
                                    @if ($item->increase=='positive')
                                        +5
                                    @else
                                        -5
                                    @endif</span></div>
                            </div>
                    @else
                        <div  role="alert">

                            <div> <span style="color:  #dc3545;">{{ $item->name }}</span></div>
                            <br>
                            <div> <span style="padding-top: 50px">
                                    @if ($item->increase=='positive')
                                        +5
                                    @else
                                        -5
                                    @endif</span>
                            </div>
                        </div>
                    @endif
                </th>
            @endif

        @endforeach
        <th style="width: 110px;">UMUMIY USTAMA</th>
    </tr>
    </thead>
    <tbody id="data_list">
    @foreach ($teachers as $i => $teacher)
        <tr>
            <td class="nomer fixed_header3">
                {{ ++$i }}
            </td>
            <th>
                {{ $teacher->full_name }}
            </th>
            @foreach ($criterias as $num => $item)

                
                @if ($item->increase=='positive' && $item->rules["rules"]["checkbox"]['limit'] == 1)
                <td  style="color: #198754">
                @elseif ($item->increase=='negative' && $item->rules["rules"]["checkbox"]['limit'] == 1)
                    <td style="color: #dc3545">
                @else
                <td>
                @endif

                    @if ($item->rules['rules'])

                        @if ($item->rules["rules"]["checkbox"]['limit'] == 1)
                            @if ( $teacher->on_criteria()->where('user_id', '=', $teacher->id)->where('criteria_id', '=', $item->id)->first() )
                                {{ $teacher->on_criteria()->where('user_id', '=', $teacher->id)->where('criteria_id', '=', $item->id)->first()->status == 1 ? $item->increase == 'positive' ? "+ {$item->percent}" : "- {$item->percent}" : "" }}
                            @endif
                        @else

                            @for ($i = 0; $i < $item->rules["rules"]["checkbox"]['limit']; $i++)
                                @if ( $teacher->on_criteria()->where('user_id', '=', $teacher->id)->where('criteria_id', '=', $item->id)->first() )

                                    @if($teacher->on_criteria()->where('user_id', '=', $teacher->id)->where('criteria_id', '=', $item->id)->first()['states']['checkbox']['position'][$i]['included'] == 1)
                                        @switch($i)
                                            @case(0)
                                                O
                                                @break
                                            @case(1)
                                                ,S
                                                @break
                                            @case(2)
                                                ,T
                                                @break
                                        @endswitch
                                    @endif

                                @endif
                            @endfor
                            
                        @endif

                    @endif
                </td>
            @endforeach
            <td>
                {{ $teacher->percent }}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
