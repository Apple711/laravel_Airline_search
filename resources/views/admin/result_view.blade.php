
<table id="resulttable" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
    <thead>
        <tr>
            <th>
                <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                    <input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" id="check_all" checked />
                    <span></span>
                </label>
            </th>
            <th>COMPANY NAME</th>
            <th>CONTACT</th>
            <th>TITLE</th>
            <th>PRODUCT</th>
            <th>APPLCATION FAMILY</th>
            <th>APPLCATION</th>
            <th>MATCHES</th>
            <th>MRO/AIRLINE</th>
            <th>ACTION</th>
        </tr>
    </thead>
    <tbody>
        @php
            $i = 0;
            $mailchain = "";
            $duplicate_flag = false;
            $pre_country = "";
            $pre_operator = "";
            $pre_email = "";
            $pre_title = "";
        @endphp
        @if ( count($results)>0 )
            @foreach ($results as $tr)
                @php
                    $duplicate_flag = false;
                @endphp
                @if ($customer_type=='airline')
                    @if ($tr->country == $pre_country && $tr->operator == $pre_operator && $tr->email == $pre_email && $tr->title == $pre_title)
                        @php
                            $duplicate_flag = true;
                        @endphp
                    @endif
                @else
                    @php
                        $duplicate_flag = true;
                    @endphp
                @endif
                @if (!$duplicate_flag)
                    <tr class="gradeA odd" item_id="{{$customer_type=='airline' ? $tr->country : $tr->id}}">
                        <td class=""><input type="checkbox" class="row_check" name = "row_check" checked /></td>
                        <td class=" ">{{$customer_type=='airline' ? $tr->operator : $tr->company}}</td>
                        <td class=" ">{{$tr->email }}</td>
                        <td class=" ">{{$tr->title }}</td>
                        <td class=" ">{{$product->family}}</td>
                        <td class=" ">{{$appfamily->appfamily}}</td>
                        <td class=" ">{{$application->application}}</td>
                        <td class=" "></td>
                        <td class=" ">{{$customer_type=='airline' ? 'Airline' : 'MRO'}}</td>
                        <td><a onclick="edit($(this))" class="btn btn-primary btn-xs edit"><i class="fa fa-edit "></i> Edit</a></td>
                    </tr>
                    @php
                        if ($tr->email){
                            $mailchain.= ($i==0) ? $tr->email : "; ".$tr->email;
                            $i++;
                        }
                    @endphp
                @endif
                @if ($customer_type=='airline')
                    @php
                        $pre_country = $tr->country;
                        $pre_operator = $tr->operator;
                        $pre_email = $tr->email;
                        $pre_title = $tr->title;
                    @endphp
                @endif
            @endforeach
        @endif
        @if ( $customer_type == "all" )
            @if ( count($airline_results)>0 )
                @foreach ($airline_results as $tr)
                    @php
                        $duplicate_flag = false;
                    @endphp
                    @if ($tr->country == $pre_country && $tr->operator == $pre_operator && $tr->email == $pre_email && $tr->title == $pre_title)
                        @php
                            $duplicate_flag = true;
                        @endphp
                    @endif
                    @if (!$duplicate_flag)
                        <tr class="gradeA odd" item_id="<?php echo $tr->country ?>">
                            <td class=""><input type="checkbox" class="row_check" name = "row_check" checked /></td>
                            <td class=" ">{{$tr->operator}}</td>
                            <td class=" ">{{$tr->email}}</td>
                            <td class=" ">{{$tr->title}}</td>
                            <td class=" ">{{$product->family}}</td>
                            <td class=" ">{{$appfamily->appfamily}}</td>
                            <td class=" ">{{$application->application}}</td>
                            <td class=" "></td>
                            <td class=" ">Airline</td>
                            <td><a onclick="edit($(this))" class="btn btn-primary btn-xs edit"><i class="fa fa-edit "></i> Edit</a></td>
                        </tr>
                        @php
                            if ($tr->email){
                                $mailchain.= ($i==0) ? $tr->email : "; ".$tr->email;
                                $i++;
                            }
                        @endphp
                    @endif
                    @php
                        $pre_country = $tr->country;
                        $pre_operator = $tr->operator;
                        $pre_email = $tr->email;
                        $pre_title = $tr->title;
                    @endphp
                @endforeach
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
    $('#resulttable').DataTable( {
            "bPaginate": true,
            "searching": false,
            "bFilter": false, 
            "bInfo": false,
            "scrollX": true,
            "bSortable": false,
            "ordering": false,
        } );
    

    function edit(obj) {
        var id = obj.parent().parent().attr("item_id");
        var type = obj.parent().parent().find(':nth-child(9)')[0].innerText;
        company_name = obj.parent().parent().find(':nth-child(2)')[0].innerText;
        var url = "{{ url('/contacts') }}";
        location.href=url + "/" + id + "/" + company_name + "/" + type + "/edit";
        
    }

    $("#copy_btn").click(function(){
        const e2 = $('textarea').val();
        console.log(e2);
        const el = document.createElement('textarea');
        el.value = e2;
        document.body.appendChild(el);
        el.select();
        document.execCommand('copy');
        document.body.removeChild(el);
    });

    $("#check_all").change(function(){
        var table = $('#resulttable').DataTable();
        var checked = this.checked;
        var allPages = table.cells( ).nodes( );
        $(allPages).find('input[type="checkbox"]').prop('checked', checked);
        if (checked){
            $('textarea').val(get_mailchain());;
        }else{
            $('textarea').val("");
        }
    });

    $('#resulttable').on('click', 'tbody td input[type="checkbox"]', function () {
        var table = $('#resulttable').DataTable();
        var row = table.row(this.closest('tr')).data();
        $('textarea').val(get_mailchain());;
    });

    function get_mailchain(){
        var table = $('#resulttable').DataTable();
        var checkedvalues = table.$('input:checked').map(function () {
                var row = table.row(this.closest('tr')).data();
                if (row[2] != ""){
                    return row[2];
                }
            }).get().join(';');
        
        return checkedvalues;
    }
</script>