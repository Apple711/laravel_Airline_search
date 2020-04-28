@extends("layouts.adminLayout")
@section("contents")
<!-- Content Wrapper. Contains page content -->
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    function edit(obj) {
        var company_name = obj.parent().parent().find("td:eq(1)").text();
        var country = obj.parent().parent().find("td:eq(2)").text();
        var url = "{{ url('airline/edit') }}";
        location.href=url + "/" + company_name + "/" + country;
    }

    $(function(){
        $('#example1').DataTable( {
            "bPaginate": true,
            "searching": true,
            "bFilter": false, 
            "bInfo": false,
            "scrollX": true,
            "bSortable": false,
            "ordering": false
        } );
    })
</script>
<div class="content-wrapper" style="min-height: 916px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
           AIRLINE COMPANIES
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">               
                <!--//Account list-->
                <div class="box account_list">
                  
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                                        <thead>
                                            <tr role="row">
                                                <th style="width: 50px;"><input type="checkbox" /></th>
                                                <th style="width: 150px;">Company</th>
                                                <th style="width: 150px;">Country</th>
                                                <th style="width: 268px;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ( count($airlines)>0 )
                                                @foreach ($airlines as $tr)
                                                    <tr class="gradeA odd" item_id="<?php echo $tr->id ?>">
                                                        <td class=""><input type="checkbox" /></td>
                                                        <td class=" ">{{$tr->operator}}</td>
                                                        <td class=" ">{{$tr->country}}</td>
                                                        <td class="center ">
                                                            <a onclick="edit($(this))" class="btn btn-primary btn-xs edit"><i class="fa fa-edit "></i> Edit</a>                                     @if(Auth::user()->role == 1)                  
                                                                <a href="{{ url('/airline/delete/'.$tr->operator.'/'.$tr->country)}}" data-method="delete" class="btn btn-danger btn-xs delete"><i class="fa fa-trash "></i> Delete</a>
                                                            @endif
                                                        </td>
                                                    </tr>   
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <!-- /.box -->
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<style>
    .form-group.custom_input{
        margin-right: 20px
    }
</style>
@endsection