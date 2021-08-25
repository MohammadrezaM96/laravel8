@extends('admin.layouts.index')
@section('title' , 'آرشیو شهرها')
@section('page-titr' , 'آرشیو شهرها')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <h4 class="header-title mb-3">آرشیو شهرها</h4>
                <div class="table-responsive">

                    <table class="table mb-0 table-responsive-xs table-hover table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>نام</th>
                            <th>وضعیت</th>
                            <th>ابزار</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($cities->isEmpty())
                            <tr>
                                <td colspan="8" class="text-center p-3 bg-soft-pink">موردی یافت نشد</td>
                            </tr>
                        @else
                            @foreach($cities as $item=>$city)
                                <tr data-id="{{ $city->id }}">
                                    <th scope="row">{{ $item+1 }}</th>
                                    <td>{{ $city->name }}</td>
                                    <td>
                                        @if($city->status == 1)
                                            <span class="badge bg-soft-success text-success p-2">فعال</span>
                                        @else
                                            <span class="badge bg-soft-danger text-danger p-2">غیرفعال</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group2">
                                            @if($city->status == 0)
                                                <a href="{{ route('city.change.status' , $city->id) }}"
                                                   class="btn btn-light text-success" data-toggle="tooltip" title=""
                                                   data-original-title="فعال"><span
                                                        class="mdi mdi-check"></span>
                                                </a>
                                            @else
                                                <a href="{{ route('city.change.status' , $city->id) }}"
                                                   class="btn btn-light text-danger" data-toggle="tooltip" title=""
                                                   data-original-title="غیرفعال"><span
                                                        class="mdi mdi-close"></span>
                                                </a>
                                            @endif

                                            <a href="{{ route('city.edit' , $city->id) }}"
                                               class="btn btn-success "
                                               data-toggle="tooltip" title="" data-original-title="ویرایش">
                                                <span class="mdi mdi-pencil"></span></a>

                                                <button
                                                    class="btn btn-sm btn-danger waves-effect waves-light deleteItem"
                                                    data-id="{{ $city->id }}"
                                                    data-name="{{ $city->name ?? '' }}"
                                                    data-toggle="tooltip" title="" data-original-title="حذف"><i
                                                        class="mdi mdi-delete"></i></button>
                                        </div>

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
@endsection
@section('script')
    <script type="text/javascript">
        $('.deleteItem').click(function () {
            var btn = $(this);
            var url = "{{ route('city.ajax.delete') }}";
            var id = btn.data('id');
            var name = btn.data('name');
            var title = 'آیا مطمئن هستید که شهر را حذف کنید؟';
            var text = 'حذف شهر:   "' + name + '"';
            var deleted_text = 'شهر  ' + name + 'حذف شد. ';
            delete_row(title, text, deleted_text, url , {id: id}, function () {
                $('tr[data-id="' + id + '"]').fadeOut();
            });
        });
    </script>
    <script type="text/javascript">
        //turn to inline mode
        $.fn.editable.defaults.mode = 'popup';
        {{--$('#videoStatus').editable({--}}
        {{--    value: "{{ $video->status }}",--}}
        {{--    source: [--}}
        {{--        {value: 0, text: 'در انتظار تایید'},--}}
        {{--        {value: 1, text: 'تایید شده'}--}}
        {{--    ]--}}
        {{--});--}}
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('[data-name=status]').editable({
                source: [
                    {value: 0, text: 'فعال'},
                    {value: 1, text: 'غیرفعال'},
                ]
            });
        });

        function refresh() {
            setTimeout(() => {
                window.location.reload();

            }, 1000)
        }
    </script>
@endsection
