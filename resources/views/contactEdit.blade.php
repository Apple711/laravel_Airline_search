@extends("layouts.adminLayout")
@section("contents")
<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Contacts Management
        </h1>
    </section>
    <!-- Main content -->
    <section class="content portlet light">
        <form class="form-horizontal" action="{{url('/contacts/update/'.$company['id'].'/'.$company['name'].'/'.$company['type'])}}" method="post">
            {{ csrf_field() }}
            <div class="box-body">
                <div class="form-group custom_input">
                    <label class="col-sm-2 control-label">Company<span class="required">*</span></label>
                    <div class="col-xs-4">
                        <input class="form-control" name="company" type="text" readonly value="{{ $company['name'] }}">
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
                                    <td><input type="text" id="contact_name" /></td>
                                    <td><input type="text" id="contact_email" /></td>
                                    <td><input type="text" id="contact_title" /></td>
                                    <td><button class="btn btn-default pull-right add-row"><i class="fa fa-plus"></i>&nbsp;&nbsp; Add Row</button></td>
                                </tr>
                            </tbody>
                        </table>
                        
                    </div>
                    
                </div>
            </div>
            <input type="hidden" name="current_product" value="{{$current_product}}"/>
            <input type="hidden" name="current_appfamily" value="{{$current_appfamily}}"/>
            <input type="hidden" name="current_application" value="{{$current_application}}"/>
            <input type="hidden" name="company_type" value="{{$company_type}}"/>
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
        var retVal = confirm("Are you going to remove this contact?");
        if ( retVal == true ){
            obj.parent().parent().remove();
        }
    }

    $(".back_button").click(function(){
        var product_id = $("input[name=current_product]").val();
        var appfamily_id = $("input[name=current_appfamily]").val();
        var application_id = $("input[name=current_application]").val();
        var customer_type = $("input[name=company_type]").val();

        var url = "{{ url('/contacts') }}";
        location.href=url + "/" + product_id + "/" + appfamily_id + "/" + application_id + "/" + customer_type + "/back";
    });
</script>
@endsection