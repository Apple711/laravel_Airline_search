@extends("layouts.adminLayout")
@section("contents")

<script>
    $(function(){
        $(".back_button").click(function(){
            location.href = "{{URL::to('admin/appfamily')}}"
        });

    });
</script>

<div class="content-wrapper" style="min-height: 916px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Add Application Family
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <!-- /.box -->

                <div class="box box-info">
                    <!-- form start -->

                    <form class="form-horizontal" id="role_form" name="role_form" action="{{url('admin/appfamily')}}" method="post">
                        {{ csrf_field() }}
                        <div class="box-body">
                            <div class="form-group custom_input">
                                <label class="col-sm-2 control-label">Application Family<span class="required">*</span></label>
                                <div class="col-xs-4">
                                    <input class="form-control" name="appfamily" type="text" value="" placeholder="Application Family" required>
                                </div>
                            </div>

                            <div class="form-group custom_input">
                                <label class="col-sm-2 control-label">Product<span class="required"></span></label>
                                 <div class="col-xs-4">
                                    <!-- <input class="form-control" name="email" type="text" value="" placeholder="Email" required> -->

                                    <select class = "form-control" name = "product_family" requried>
                                        @foreach ($products as $product)
                                            <option value="{{$product->id}}">{{$product->family}}</option>
                                        @endforeach
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

@endsection