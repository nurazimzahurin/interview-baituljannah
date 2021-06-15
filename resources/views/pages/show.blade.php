@extends('layouts.app')
@section('content')
    <div class="w-100 h-100 d-flex flex-column justify-content-center align-items-center">
        <show-component :product="{{ $product }}" :url="{{ json_encode($product->getFirstMediaUrl('picture'))  }}"></show-component>
    </div>
@endsection
