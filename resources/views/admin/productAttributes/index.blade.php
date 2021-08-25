@extends('admin.layouts.index')
@section('title' , 'آرشیو ویژگی های محصولات')
@section('page-titr' , 'آرشیو ویژگی های محصولات')

@section('head')
    <link rel="stylesheet" href="{{ url('/') }}/front/css/lib/all.min.css" />
    {{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"/>--}}
    <link href="{{ URL::to('/') }}/back/assets/css/iconPicker.css" rel="stylesheet" type="text/css"/>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <h4 class="header-title mb-3">آرشیو ویژگی های محصولات</h4>
                <div class="table-responsive">

                    <table class="table mb-0 table-responsive-xs table-hover table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>نام</th>
                            <th>آیکون</th>
                            <th>ابزار</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($attributes->isEmpty())
                            <tr>
                                <td colspan="8" class="text-center p-3 bg-soft-pink">موردی یافت نشد</td>
                            </tr>
                        @else
                            @foreach($attributes as $item=>$attribute)
                                <tr data-id="{{ $attribute->id }}">
                                    <th scope="row">{{ $item+1 }}</th>
                                    <td>{{ $attribute->name }}</td>
                                    <td>
                                        @if($attribute->icon != null)
                                            <i class="{{ $attribute->icon }}"></i>
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group2">

                                            <a href="{{ route('product-attributes.edit' , $attribute->id) }}"
                                               class="btn btn-success "
                                               data-toggle="tooltip" title="" data-original-title="ویرایش">
                                                <span class="mdi mdi-pencil"></span></a>

                                            <button
                                                class="btn btn-sm btn-danger waves-effect waves-light deleteItem"
                                                data-id="{{ $attribute->id }}"
                                                data-name="{{  $attribute->name }}"
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
                {{ $attributes->links() }}
            </div>
        </div>
    </div>
@endsection
@section('script')

    <script src="{{ url('/') }}/front/js/lib/all.min.js"></script>
    <script src="{{ URL::to('/') }}/back/assets/js/iconPicker.js"></script>
    <script type="text/javascript">
        $('.deleteItem').click(function () {
            var btn = $(this);
            var url = "{{ route('product.attributes.ajax.delete') }}";
            var id = btn.data('id');
            var name = btn.data('name');
            var title = 'آیا مطمئن هستید که ویژگی را حذف کنید؟';
            var text = 'حذف ویژگی:   "' + name + '"';
            var deleted_text = 'ویژگی  ' + name + 'حذف شد. ';
            delete_row(title, text, deleted_text, url , {id: id}, function () {
                $('tr[data-id="' + id + '"]').fadeOut();
            });
        });
    </script>


    <link rel="stylesheet" href="{{ url('/') }}/front/js/lib/all.min.js" />

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
