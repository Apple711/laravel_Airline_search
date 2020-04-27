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
           Edit Application Family
        </h1>
       
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <!-- /.box -->
                <div class="box box-info">
                    <!-- form start -->

                    <form class="form-horizontal" id="user_form" name="user_form" action="{{url('admin/appfamily/'.$application_groups->id )}}" method = "post">

                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
                        <div class="box-body">
                            <div class="form-group custom_input {{ $errors->has('appfamily') ? ' has-error' : '' }}">
                                <label class="col-sm-2 control-label">Application Family<span class="required">*</span></label>
                                <div class="col-xs-4">
                                    <input class="form-control" name="appfamily" type="text" value="{{ $application_groups->appfamily }}" placeholder="Application Family" required>
                                    @if ($errors->has('appfamily'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('appfamily') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group custom_input {{ $errors->has('products') ? ' has-error' : '' }}">
                                <label class="col-sm-2 control-label">Product Family<span class="required"></span></label>
                                 <div class="col-xs-4">
                                    <select class = "form-control" name = "product_family" requried>
                                        @foreach ($products as $product)
                                            <option {{($application_groups->productid == $product->id)?"selected":""}} value= {{$product->id}}>{{$product->family}}</option>
                                        @endforeach
                                    
                                    </select>
                                    @if ($errors->has('products'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('products') }}</strong>
                                        </span>
                                    @endif
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