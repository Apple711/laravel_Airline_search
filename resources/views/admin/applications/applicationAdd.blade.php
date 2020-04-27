@extends("layouts.adminLayout")
@section("contents")

<script>
    $(function(){
        $(".back_button").click(function(){
            location.href = "{{URL::to('admin/applications')}}"
        });

    });
</script>

<div class="content-wrapper" style="min-height: 916px;">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Add Applications
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <!-- /.box -->

                <div class="box box-info">
                    <!-- form start -->

                    <form class="form-horizontal" id="role_form" name="role_form" action="{{url('admin/applications')}}" method="post">
                        {{ csrf_field() }}
                        <div class="box-body">
                            <div class="form-group custom_input">
                                <label class="col-sm-2 control-label">Application<span class="required">*</span></label>
                                <div class="col-xs-4">
                                    <input class="form-control" name="application" type="text" value="" placeholder="Application" required>
                                </div>
                            </div>

                            <div class="form-group custom_input">
                                <label class="col-sm-2 control-label">Product Family<span class="required"></span></label>
                                 <div class="col-xs-4">
                                    <select class = "form-control" name = "family" id="search_product_sel" requried>
                                        <option></option>
                                        @foreach ($products as $product)
                                            <option value="{{$product->id}}">{{$product->family}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group custom_input">
                                <label class="col-sm-2 control-label">Application Family<span class="required"></span></label>
                                 <div class="col-xs-4">
                                    <select class = "form-control" name = "appfamily" id = "appfamily_sel" requried>
                                        <option></option>
                                    </select>
                                </div>
                            </div>
                           
                        </div>
                        <div class="box-footer">
                            <!--<button type="submit" class="btn btn-default">Cancel</button>-->
                            <button type="submit" class="btn btn-info save_button">Save</button>
                            <button type="button" class="btn btn-info back_button">Back</button>
                        </div>
                    </form>
                </div>
                <!-- /.col -->
            </div>
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $("#search_product_sel").change(function(){
        var id = $("#search_product_sel").val();
        $.ajax({
            type:'POST',
            url:'/getAppfamily',
            data:{id: id},
            beforeSend: function(){
                var xml = '<option></option';    
                $('#appfamily_sel').html(xml);
            },
            success:function(data){
                var xml = '';
                data.appfamily.forEach(function(element, index) {
                    xml = xml + '<option value="' + element.id + '">' + element.appfamily + '</option>';
                });
                $("#appfamily_sel").append(xml);
            }
        });
    })

    
</script>
@endsection