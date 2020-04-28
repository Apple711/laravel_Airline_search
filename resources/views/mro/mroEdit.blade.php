@extends("layouts.adminLayout")
@section("contents")
<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Add MRO COMPANY
        </h1>
    </section>
    <!-- Main content -->
    <section class="content portlet light">
        <form class="form-horizontal" action="{{url('/mro/update/'.$company->id)}}" method="post">
            {{ csrf_field() }}
            <div class="box-body">
                <div class="form-group custom_input">
                    <label class="col-sm-2 control-label">Company<span class="required">*</span></label>
                    <div class="col-xs-4">
                        <input class="form-control" name="company" type="text" value="{{ $company->company }}">
                    </div>
                </div>
                <div class="form-group custom_input">
                    <label class="col-sm-2 control-label">Country<span class="required"></span></label>
                     <div class="col-xs-4">
                        <input class="form-control" name="country" type="text" value="{{ $company->country }}">
                    </div>
                </div>
                

                <div class="form-group custom_input">
                    <div id="searchContent" class="col-md-6">
                        <h4>CONTACTS</h4>
                        
                        <table class="table table-striped table-bordered table-hover table-checkable order-column" id="contact_table">
                            <thead>
                                <tr>
                                    <th>NAME</th>
                                    <th>EMAIL</th>
                                    <th>TITLE</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ( count($contacts)>0 )
                                    @foreach($contacts as $tr)
                                        <tr class="gradeA odd" item_id="{{$tr->id}}">
                                            <td class=" ">{{$tr->name}}</td>
                                            <td class=" ">{{$tr->email }}</td>
                                            <td class=" ">{{$tr->title }}</td>
                                            <td class="center ">
                                                <a onclick="del($(this))" data-method="delete" class='button button-small' title='Delete'><i class='fa fa-trash'></i></a>  
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>

                        <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                            <tbody>
                                <tr>
                                    <td><input tyep="text" id="contact_name" /></td>
                                    <td><input tyep="text" id="contact_email" /></td>
                                    <td><input tyep="text" id="contact_title" /></td>
                                    <td><button class="btn btn-default pull-right add-row"><i class="fa fa-plus"></i>&nbsp;&nbsp; Add Row</button></td>
                                </tr>
                            </tbody>
                        </table>
                        
                    </div>

                    <div class="form-group custom_input">
                        <div class="compatiable col-md-12">
                            <h4 class="form-section">CAPABILITIES</h4>
                            <div class="form-group">
                                <label class="control-label col-md-3">PRODUCT FAMILY</label>
                                <div class="col-md-4">
                                    <select class="form-control" id="product_sel" name="product_sel">
                                        <option></option>
                                        @foreach ($products as $product)
                                            <option value="{{$product->id}}">{{$product->family}}</option>
                                        @endforeach
                                    </select>
                                </div>
                
                            </div>
                            <br>
                            <div class="application">
                                <h4 class="form-section">APPLICATIONS</h4>
                                <div class="row">
                                    <div class="col-md-4" style="height:350px;overflow-y: scroll;">                                        
                                        <table id="source_list" class="table" role="grid" aria-describedby="example1_info" >
                                            <tbody>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-1">
                                        <button class="btn green" id="add-app">ADD</button>
                                    </div>
                                    <div class="col-md-4" style="height:350px;overflow-y: scroll;">
                                        <table id="destination_list" class="table" role="grid" aria-describedby="example1_info">
                                            <thead>
                                                <tr>
                                                    <td>Application</td>
                                                    <td>Product Family</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ( count($appLists)>0 )
                                                    @foreach($appLists as $tr)
                                                        <tr class="gradeA odd">
                                                            <td><input type='hidden' value='{{$tr->id}}' name='app_list[]'/>{{$tr->application}}<td>
                                                            <td>{{$tr->family}}<td>
                                                            <td><a onclick='del_app($(this))' class='button button-small' title='Delete'><i class='fa fa-trash'></i></a><td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-3">
                                        <button class="btn green" id="reset_app">RESET APPLICATIONS</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <!--<button type="submit" class="btn btn-default">Cancel</button>-->
                <button type="submit" class="btn btn-info save_button">Save</button>
                <button type="button" class="btn btn-info back_button">Back</button>
            </div>
        </form>


        
        
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(".add-row").click(function(e){
        e.preventDefault();
        var contact_name = $("#contact_name").val();
        var contact_email = $("#contact_email").val();
        var contact_title = $("#contact_title").val();
        $("#contact_table tbody").append("<tr><td><input type='hidden' value='"+contact_name+"' name='contact_name[]' />"+contact_name+"</td><td><input type='hidden' value='"+contact_email+"' name='contact_email[]' />"+contact_email+"</td><td><input type='hidden' value='"+contact_title+"' name='contact_title[]' />"+contact_title+"</td><td><a onclick='del_new($(this))' class='button button-small' title='Delete'><i class='fa fa-trash'></i></a></td></tr>");
    });

    $("#product_sel").change(function(){
        var id = $("#product_sel").val();
        console.log(id);
        $.ajax({
            type:'POST',
            url:'/mro/getApplication',
            data:{id: id},
            success:function(data){
                var xml = "";
                $("#source_list tbody").html("");
                data.applications.forEach(element => {
                    xml = xml + "<tr id='"+element.id+"'><td><input type='checkbox' /></td><td>"+element.application+"</td></tr>";
                });
                $("#source_list tbody").append(xml);
            }
        });
    });

    $("#add-app").click(function(e){
        e.preventDefault();
        var xml = "";
        $('#source_list > tbody  > tr').each(function(index, tr) { 
            var selected = tr.firstChild.firstChild.checked;
            if (selected) {
                xml = "<tr id='"+tr.getAttribute('id')+"'><td><input type='hidden' value='"+tr.getAttribute('id')+"' name='app_list[]'/>"+tr.getElementsByTagName('td')[1].innerText+"<td></tr>";
                $("#destination_list tbody").append(xml);
                tr.firstChild.firstChild.checked = false;
            }
        });
    })

    $("#reset_app").click(function(e){
        e.preventDefault();
        $("#destination_list tbody").html("");
    })
    function del_app(obj) {
        var retVal = confirm("Are you going to remove this application?");
        if ( retVal == true ){
            obj.parent().parent().remove();
        }
    }

    function del(obj) {
        var retVal = confirm("Are you going to remove this contact?");
        if ( retVal == true ){
            var id = obj.parent().parent().attr("item_id");
            $.ajax({
                type:'POST',
                url:'/contact/delete',
                data:{id: id},
                success:function(data){
                    if(data == "true"){
                        delelement = obj.parent().parent();
                        delelement.remove();
                    }
                }
            });
        }
        
    }

    function del_new(obj) {
        var retVal = confirm("Are you going to remove this Contact?");
        if ( retVal == true ){
            obj.parent().parent().remove();
        }
    }

    $(".back_button").click(function(){
        location.href = "{{URL::to('MRO')}}"
    });
</script>
@endsection