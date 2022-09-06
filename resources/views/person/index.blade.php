@extends('layouts.main')

@section('header')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.css" />
@endsection

@section('container')

<a href="{{ route('person.create') }}">
    Kişi Ekle
</a>


<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Adı</th>
        <th>Doğum Tarihi</th>
        <th>Cinsiyeti</th>
        <th>Şehir Adı</th>
        <th>Oluşturulma Tarihi</th>
        <th>İşlemler</th>
    </tr>
    </thead>

    <!-- Table - Body -->
    <tbody>

    @foreach($data as $key => $value)
        <tr>
            <td>
                {{ $value->id }}
            </td>
            <td>
                {{ $value->name }}
            </td>

            <td>
                {{ $value->birthdate }}
            </td>

            <td>
                {{ $value->gender_read }}
            </td>

            <td>
                {{ $value->address->city_name ?? null }}
            </td>

            <td>
                {{ date('d.m.Y H:i', strtotime($value->created_at)) }}
            </td>

            <!-- Action Buttons -->
            <td class="text-end">
                <a href="{{ route('person.edit', $value->id) }}">
                    Düzenle
                </a>
                <a data-id="{{ $value->id }}" href="javascript:;" class="delete-content">
                    Sil
                </a>
            </td>
        </tr>
    @endforeach

    </tbody>

</table>

{{ $data->links() }}

@endsection

@section('footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.js"></script>
    <script>


        // Delete Data
        $('.delete-content').on('click', function (){
            var buttonData = $(this);

            var jc = $.confirm({
                title: 'İçerik Silme',
                content: 'İçeriği silmek istiyormusunuz ?',
                keyboardEnabled: true,
                buttons: {
                    deleteData: {
                        text: 'Evet',
                        btnClass: 'btn-light-danger',
                        action: function(){
                            return $.ajax({
                                url: modulUrl + '/' + buttonData.data('id'),
                                type: 'DELETE',
                                cache: false,
                                data: "_token={{ csrf_token() }}",
                                success: function(result) {
                                    if(result) {
                                        toastr.success("Kayıt başarılı bir şekilde silindi.");
                                        setTimeout(function(){ window.location.href = modulUrl; }, 1500);
                                    } else {
                                        toastr.error("Kayıt silinirken hata oluştu.");
                                    }
                                },
                                error: function(request,msg,error) {
                                    toastr.error("Kayıt silme işleminde hata oluştu.");
                                }
                            });

                        }
                    },
                    cancel: {
                        text: 'Hayır',
                        btnClass: 'btn-light-dark',
                        action: function () {
                        }
                    }
                }
            });
        });
    </script>
@endsection
