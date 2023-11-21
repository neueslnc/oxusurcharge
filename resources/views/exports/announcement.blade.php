@php

    $result_month = [];

@endphp
<div>
    <table>
        <thead>
        <tr>
            <th style="font-size: 15px; width: 20px; text-align: center; padding-top: 10px; padding-bottom: 10px; border: 5px solid black; border-collapse: collapse;" colspan="35" >E'LON</th>
        </tr>
        <tr>
            <th style="width: 20px; font-weight: bold; border: 5px solid black; border-collapse: collapse;">#</th>
            <th style="width: 110px; font-weight: bold; border: 5px solid black; border-collapse: collapse;">FISH</th>
            <th style="width: 110px; font-weight: bold; border: 5px solid black; border-collapse: collapse;">Kafedrasi</th>
            @for($i = 1; $i <= $days; $i++)
                @php
                    array_push($result_month, 0);
                @endphp
                <th style="width: 25px; background-color: #fff31e; font-weight: bold; border: 5px solid black; border-collapse: collapse;">{{ $i }}</th>
            @endfor
            <th style="width: 110px; border: 5px solid black; border-collapse: collapse;">Itogi</th>
        </tr>
        </thead>
        <tbody>

            @foreach($teachers as $key => $teacher)
                @php

                    $statics = $teacher->generate_announcement($days, $month);

                 @endphp
                <tr>
                    <td style="border: 5px solid black; border-collapse: collapse;">{{ ++$key }}</td>
                    <td style="border: 5px solid black; border-collapse: collapse;">{{ $teacher->full_name }}</td>
                    <td style="border: 5px solid black; border-collapse: collapse;">{{ $teacher->departament->name }}</td>

                    @for($i = 0; $i < $days; $i++)

                        @php
                            $count = intval($result_month[$i]) + intval($statics['result'][$i]);
                            $result_month[$i] = $count;
                        @endphp
                        <td style="border: 5px solid black; border-collapse: collapse;">{{ $statics['result'][$i] }}</td>
                    @endfor

                    <td style="border: 5px solid black; border-collapse: collapse; background-color: #99CC66; font-weight: bold;">{{ $statics['counts'] }}</td>
                </tr>
            @endforeach

            <tr>
                <td colspan="3" style="text-align: center; border: 5px solid black; border-collapse: collapse;  background-color: #99CC66; font-weight: bold;">
                    Jami
                </td>
                @php
                    $count_month = 0;
                @endphp
                @for($i = 0; $i < $days; $i++)
                    @php
                        $count_month += $result_month[$i];
                    @endphp
                    <td style="border: 5px solid black; border-collapse: collapse; background-color: #99CC66; font-weight: bold;">{{ $result_month[$i] }}</td>
                @endfor
                <td style="border: 5px solid black; border-collapse: collapse; background-color: #99CC66; font-weight: bold;">
                    {{ $count_month }}
                </td>
            </tr>
        </tbody>
    </table>
</div>
