@extends('admin.layouts.index')
@section('title')
    Show Order {{ $order->id }}
@endsection
@section('content')
    <div class="content-page">
        <div class="content">
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-danger mt-2">
                        <h4>Order Total Price: {{ $order->total_price }} AED</h4>
                    </div>
                    <h4 class="page-title mt-3">Products</h4>
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-centered table-borderless table-hover mb-0">
                                    <thead class="thead-light">
                                    <tr>
                                        <th style="width: 20px;">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck1">
                                                <label class="custom-control-label" for="customCheck1">&nbsp;</label>
                                            </div>
                                        </th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Quantity</th>
                                        <th>Product Price</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach(json_decode($order->content) as $product)
                                        <tr>
                                            <td>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input"
                                                           id="customCheck2">
                                                    <label class="custom-control-label"
                                                           for="customCheck2">&nbsp;</label>
                                                </div>
                                            </td>
                                            <td>
                                                <img
                                                    src="{{ URL::to('/') }}/storage/product-images/{{ $product->options->image }}"
                                                    alt="table-user" style="height: 64px; width: 64px">
                                            </td>
                                            <td>
                                                {{ $product->name }}
                                            </td>
                                            <td>
                                                <span class="font-weight-semibold">{{ $product->qty }}</span>
                                            </td>
                                            <td>
                                                {{ $product->subtotal }} AED
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div> <!-- end col -->
            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-12">
                    <h4 class="page-title mt-3">Address</h4>
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-centered table-borderless table-hover mb-0">
                                    <thead class="thead-light">
                                    <tr>
                                        <th>Address</th>
                                        <th>Place Number</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>
                                            {{ $address->address }}
                                        </td>
                                        <td>
                                            {{ $address->place_number }}
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div> <!-- end col -->
            </div>
            <!-- end row -->

        </div> <!-- container -->

    </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        // $('.verify-user').click(function() {
        //     var btn = $(this);
        //     var id = btn.data('id');
        //     var name = btn.data('name');
        //     var title = 'آیا برای تایید کاربر اطمینان دارید؟';
        //     var text = 'تایید  کاربر  با نام کاربری "'+name+'"';
        //     var deleted_text = 'تایید شد';
        //     alert_row(title, text, base_url + 'user/post/verify', {id: id}, function() {
        //         $('span[data-id="'+id+'"]').removeClass();
        //         $('span[data-id="'+id+'"]').addClass('fa fa-check');
        //     });
        // });
        $('.delete_category').click(function () {
            var btn = $(this);
            var id = btn.data('id');
            var name = btn.data('name');
            var title = 'Are you sure you want to delete the Role?';
            var text = 'Delete Role :  "' + name + '"';
            var deleted_text = 'Role  ' + name + 'Deleted ';
            delete_row(title, text, deleted_text, base_url + 'category/post/delete', {id: id}, function () {
                $('tr[data-id="' + id + '"]').fadeOut();
            });
        });

        $('#customFile').on('change', function () {
            //get the file name
            var fileName = $(this).val();
            //replace the "Choose a file" label
            $(this).next('.custom-file-label').html(fileName);
        })
    </script>
@endsection
