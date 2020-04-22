<script>
    $(function(){
        $('#resulttable').DataTable( {
            "bPaginate": true,
            "searching": false,
            "bFilter": false, 
            "bInfo": false,
            "scrollX": true,
            "bSortable": false,
            "ordering": false
        } );
    })
</script>
<table id="resulttable" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
    <thead>
        <tr>
            <th>
                <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                    <input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" />
                    <span></span>
                </label>
            </th>
            <th>COMPANY NAME</th>
            <th>CONTACT</th>
            <th>TITLE</th>
            <th>PRODUCT</th>
            <th>APPLCATION</th>
            <th>MATCHES</th>
            <th>MRO/AIRLINE</th>
        </tr>
    </thead>
    <tbody>
        @php
            $i = 0;
            $mailchain = "";
        @endphp
        @if ( count($results)>0 )
            @foreach ($results as $tr)
                <tr class="gradeA odd">
                    <td class=""><input type="checkbox" /></td>
                    <td class=" ">{{$customer_type=='airline' ? $tr->operator : $tr->company}}</td>
                    <td class=" ">{{$tr->email }}</td>
                    <td class=" ">{{$tr->title }}</td>
                    <td class=" ">{{$product->family}}</td>
                    <td class=" ">{{$application->application}}</td>
                    <td class=" "></td>
                    <td class=" ">{{$customer_type=='airline' ? 'Airline' : 'MRO'}}</td>
                </tr>
                @php
                    $mailchain.= ($i==0) ? $tr->email : ":".$tr->email;
                    $i++;
                @endphp
            @endforeach
        @endif
        @if ( $customer_type == "all" )
            @if ( count($airline_results)>0 )
                @foreach ($airline_results as $tr)
                    <tr class="gradeA odd">
                        <td class=""><input type="checkbox" /></td>
                        <td class=" ">{{$tr->operator}}</td>
                        <td class=" ">{{$tr->email}}</td>
                        <td class=" ">{{$tr->title}}</td>
                        <td class=" ">{{$product->family}}</td>
                        <td class=" ">{{$application->application}}</td>
                        <td class=" "></td>
                        <td class=" ">Airline</td>
                    </tr>
                @endforeach
                @php
                    $mailchain.= ($i==0) ? $tr->email : "; ".$tr->email;
                    $i++;
                @endphp
            @endif
        @endif
    </tbody>
</table>
<div class="email_copy">
    <div class="form-group row">
        <div class="col-md-6">
            <textarea name="Text1" cols="100" rows="5">{{$mailchain}}</textarea>
        </div>
        <div class="col-md-4">
            <button class="btn green" id="copy_btn">Copy</button>
        </div>
    </div>
</div>

<script>
    $("#copy_btn").click(function(){
        const e2 = $('textarea').val();
        console.log(e2);
        const el = document.createElement('textarea');
        el.value = e2;
        document.body.appendChild(el);
        el.select();
        document.execCommand('copy');
        document.body.removeChild(el);
    })
</script>