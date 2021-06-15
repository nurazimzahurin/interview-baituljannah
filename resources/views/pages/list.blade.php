@extends('layouts.app')
@section('content')
    <div class="w-100 h-100 d-flex flex-column justify-content-center align-items-center">
        <listing-component :products="{{ json_encode($products->items()) }}"></listing-component>
        <pagination-component :current="{{$products->currentPage()}}" :next="{{json_encode($products->nextPageUrl())}}" :previous="{{json_encode($products->previousPageUrl())}}"></pagination-component>
    </div>
@endsection
