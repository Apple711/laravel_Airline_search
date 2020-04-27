@extends("layouts.adminLayout")
@section("contents")
<!-- Content Wrapper. Contains page content -->
<script>
    $(function(){
        $('#result_tbl').DataTable( {
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
<div class="content-wrapper">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="content portlet light">
        <form action="#" class="form-horizontal">
            <div class="form-body">
                <h3 class="form-section">SEARCH FILTER BOX</h3>
                <div class="form-group">
                    <label class="control-label col-md-3" for="inputWarning">CUSTOMER TYPE</label>
                    <div class="btn-group btn-group-devided" data-toggle="buttons">
                        <label class="btn btn-transparent dark btn-outline btn-circle btn-sm active">
                            <input type="radio" name="options" class="toggle" id="all">ALL</label>
                        <label class="btn btn-transparent dark btn-outline btn-circle btn-sm">
                            <input type="radio" name="options" class="toggle" id="mro">MRO</label>
                        <label class="btn btn-transparent dark btn-outline btn-circle btn-sm">
                            <input type="radio" name="options" class="toggle" id="airline">AIRLINE</label>
                        
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">PRODUCT FAMILY</label>
                    <div class="col-md-4">
                        <select class="form-control" id="search_product_sel" name="search_product_sel">
                            <option></option>
                            @foreach ($products as $product)
                                <option value="{{$product->id}}">{{$product->family}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">APPLICATION FAMILY</label>
                    <div class="col-md-4">
                        <select class="form-control" id="appfamily_sel" name="appfamily_sel">
                            <option></option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">APPLICATION</label>
                    <div class="col-md-4">
                        <select class="form-control" id="app_sel" name="app_sel">
                            <option></option>
                        </select>
                    </div>
                </div>
                <div class="refresh" >
                    <button class="btn green" id="refresh_btn">REFRESH</button>
                </div>
            </div>
            
        </form>

        <div id="searchContent" data-url={{route('search.content')}}>
            
            
        </div>
        
        
      
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
    $("#search_product_sel").change(function(){
        var id = $("#search_product_sel").val();
        $.ajax({
            type:'POST',
            url:'/getAppfamily',
            data:{id: id},
            beforeSend: function(){
                var xml = '<option></option';    
                $('#appfamily_sel').html(xml);
                $('#app_sel').html(xml);
                $("#searchContent").html('');
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

    $("#appfamily_sel").change(function(){
        var id = $("#appfamily_sel").val();
        $.ajax({
            type:'POST',
            url:'/getApplication',
            data:{id: id},
            beforeSend: function(){
                var xml = '<option></option';  
                $('#app_sel').html(xml);
                $("#searchContent").html('');
            },
            success:function(data){
                var xml = '';
                data.applications.forEach(function(element, index) {
                    xml = xml + '<option value="' + element.id + '">' + element.application + '</option>';
                });
                $("#app_sel").append(xml);
            }
        });
    })

    $("#app_sel").change(function(){
        get_result();
    });

    $("#refresh_btn").click(function(e){
        e.preventDefault();
        get_result();
    });

    function get_result(){
        var product_id = $("#search_product_sel").val();
        var appfamily_id = $("#appfamily_sel").val();
        var application_id = $("#app_sel").val();
        var customer_type = "all";
        $('input[name=options]').each(function() {
            if($(this).is(':checked')) {
                customer_type = $(this).attr('id');
            } 
        });

        $.ajax({
            type:'POST',
            url:$("#searchContent").data('url'),
            data:{customer_type:customer_type, product_id: product_id, appfamily_id:appfamily_id, application_id:application_id },
            beforeSend: function(){
                $("#searchContent").html('');
            },
            success:function(data){
                $("#searchContent").html(data.content);
            }
        });
    }
</script>
@endsection