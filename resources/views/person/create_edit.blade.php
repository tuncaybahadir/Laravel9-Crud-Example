@extends('layouts.main')

@section('container')

    @if ($errors->any())

        @php
            $name = old('name');
            $birthdate = old('birthdate');
            $gender = old('gender');

            $cityName = old('city_name');
            $postCode = old('post_code');
            $address = old('address');
            $countryName = old('country_name');
        @endphp


        @foreach($errors->all() as $error)
            {!! $error !!}<br>
        @endforeach
        <br>
        <hr>

    @else

        @php
            $name = $data->name ?? null;
            $birthdate = $data->birthdate ?? null;
            $gender = $data->gender ?? null;

            $cityName = $data->address->city_name ?? null;
            $postCode = $data->address->post_code ?? null;
            $address = $data->address->address ?? null;
            $countryName = $data->address->country_name ?? null;
        @endphp

    @endif


    <form class="form" method="post"
          action="@isset($data) {{ route('person.update', $data->id) }} @else {{ route('person.store') }} @endisset"
          autocomplete="off">
        @csrf
        @isset($data)
            @method('PUT')
        @endisset


        Adı: <input type="text" name="name" value="{{ $name }}"/> <br><br>

        Doğum Tarihi : <input type="text" name="birthdate" value="{{ $birthdate }}"/> <br><br>

        Cinsiyet : <select name="gender">
            @foreach($genderStates as $key => $value)
                <option value="{{ $key }}" @if($key === $gender) selected @endif>{{ $value }}</option>
            @endforeach
        </select> <br><br>

        Şehir Adı : <input type="text" name="city_name" value="{{ $cityName }}"/> <br><br>

        Posta Kodu : <input type="text" name="post_code" value="{{ $postCode }}"/> <br><br>

        Adres : <textarea rows="3" name="address">{{ $address }}</textarea><br><br>

        Ülke Adı : <input type="text" name="country_name" value="{{ $countryName }}"/> <br><br>


        <button type="submit">@isset($data)
                Güncelle
            @else
                Ekle
            @endisset</button>
    </form>
    <a href="{{ route('person.index') }}">Vazgeç</a>

@endsection
