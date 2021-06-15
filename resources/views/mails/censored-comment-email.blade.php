@component('mail::panel')
    <h3>Hi {{ $product->author->name }} </h3>
    <p>Your product : {{$product->name}}, there has been censored comment as such : {{$comment}}</p>
@endcomponent
