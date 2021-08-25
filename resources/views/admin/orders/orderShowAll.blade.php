@extends('admin.layouts.index')
@section('title' , 'Show All Orders')
@section('content')
    <div class="content-page">
        <div class="content">

            <!-- Start Content-->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                @include('admin.message')
                                <div class="row mb-2">
                                    <div class="col-lg-8">
                                        <form class="form-inline">
                                            <div class="form-group mb-2">
                                                <label for="inputPassword2" class="sr-only">Search</label>
                                                <input type="search" class="form-control" id="inputPassword2"
                                                       placeholder="Search...">
                                            </div>
                                            <div class="form-group mx-sm-3 mb-2">
                                                <label for="status-select" class="mr-2">Status</label>
                                                <select class="custom-select" id="status-select">
                                                    <option selected="">Choose...</option>
                                                    <option value="1">Paid</option>
                                                    <option value="2">Awaiting Authorization</option>
                                                    <option value="3">Payment failed</option>
                                                    <option value="4">Cash On Delivery</option>
                                                    <option value="5">Fulfilled</option>
                                                    <option value="6">Unfulfilled</option>
                                                </select>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-centered mb-0">
                                        <thead class="thead-light">
                                        <tr>
                                            <th style="width: 20px;">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input"
                                                           id="customCheck1">
                                                    <label class="custom-control-label"
                                                           for="customCheck1">&nbsp;</label>
                                                </div>
                                            </th>
                                            <th>Order ID</th>
                                            <th>Products</th>
                                            <th>Date</th>
                                            <th>Total</th>
                                            <th>Order Status</th>
                                            <th>Order Invoice</th>
                                            <th style="width: 125px;">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($orders as $order)
                                            <tr data-id="{{ $order->id }}">
                                                <td>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input"
                                                               id="customCheck2">
                                                        <label class="custom-control-label"
                                                               for="customCheck2">&nbsp;</label>
                                                    </div>
                                                </td>
                                                <td><a href="javascript: void(0);"
                                                       class="text-body font-weight-bold">{{ $order->id }}</a>
                                                </td>
                                                <td>
                                                    @foreach(json_decode($order->content) as $image)
                                                        <img
                                                            src="{{ URL::to('/') }}/storage/product-images/{{ $image->options->image }}"
                                                            alt="product-img"
                                                            height="32">
                                                    @endforeach
                                                </td>
                                                <td>
                                                    {{ \Carbon\Carbon::createFromTimeStamp(strtotime($order->created_at))->isoFormat('MMMM DD YYYY') }}
                                                </td>
                                                <td>
                                                    {{ $order->total_price }}
                                                </td>
                                                <td>
                                                    <h5>
                                                        @if($order->status == 0)
                                                            <span class="badge badge-info">
                                                                New
                                                            </span>
                                                        @elseif($order->status == 1)
                                                            <span class="badge badge-warning">
                                                                Pending
                                                            </span>
                                                        @elseif($order->status == 2)
                                                            <span class="badge badge-danger">
                                                            Finished
                                                        </span>
                                                        @endif
                                                    </h5>
                                                </td>
                                                <td>
                                                    <a href="{{ route('order.invoice', $order->id) }}"
                                                       class="action-icon ml-2"> <i
                                                            class="mdi mdi-download"></i></a>
                                                </td>
                                                <td>
                                                    <a href="{{ route('order.show.one', $order->id) }}"
                                                       class="action-icon"> <i
                                                            class="mdi mdi-eye"></i></a>
                                                    @if($order->status == 0 or $order->status == 1)
                                                        <a href="#" data-id="{{ $order->id }}"
                                                           class="action-icon verify-user"> <i
                                                                class="mdi mdi-progress-check"></i></a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                {{ $orders->links() }}
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
        $('.verify-user').click(function () {
            var btn = $(this);
            var id = btn.data('id');
            var title = 'Are You Sure You Want To Confirm The Order?';
            var text = 'Order confirmation with number "' + id + '"';
            var deleted_text = 'Confirmed';
            alert_row(title, text, base_url + 'order/status/change', {id: id}, function () {
                $('tr[data-id="' + id + '"]').fadeOut();
            });
        });
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
