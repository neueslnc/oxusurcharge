<table>
    <thead>
    <tr>
        <th style="width: 30px;"><b>N</b></th>
        <th style="width: 150px;"><b>F.I.O</b> </th>
        <th style="width:100px;"><b>SMS Turi</b></th>
        <th style="width: 250px;"><b>SMS Mazmuni</b></th>
        <th style="width: 150px;"><b>SMS jo'natilgan
             vaqt</b></th>
       
    </tr>
    </thead>
    <tbody id="data_list">
        @foreach ($messages as $key=>$item)
        <tr>
            <td>
        {{ $key+1 }}
            </td>
            <td>{{ $item->user_taker->full_name }}</td>
          @if ($item->type_sms==1)
               <td style="color: #198754;">  <p >ijobiy</p></td>
            @else
            <td style="color:  #dc3545;">  <p >salbiy</p></td>
          
              
            @endif
            <td>{{ $item->sms_body }}</td>
            <td>{{ $item->date_create() }}</td>
          </tr>
        @endforeach
 
    </tbody>
</table>
