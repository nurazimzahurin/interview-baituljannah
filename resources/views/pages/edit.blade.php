@extends('layouts.app')
@section('content')
    <div class="w-100 h-100 d-flex flex-column justify-content-center align-items-center">
        <edit-component :product="{{ $product }}" :url="{{ json_encode($product->getFirstMediaUrl('picture'))  }}"></edit-component>
    </div>
@endsection
