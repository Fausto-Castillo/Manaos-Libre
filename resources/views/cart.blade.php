@extends('layouts.default')

@section('php')
<?php
    $titulo = 'Mi Carrito';
    $producto = false;
    $tituloPag = 'Mi Carrito';
?>
@endsection

@section('content')


@include('inserts.anuncioYtitulo')
<div class="page-breadcrumb">
  

  <table id="cart" class="table table-hover table-condensed">
    <thead>
    <tr>
        <th style="width:50%">Producto(s)</th>
        <th style="width:10%">Precio</th>
        <th style="width:8%">Cantidad</th>
        <th style="width:22%" class="text-center">Subtotal</th>
        <th style="width:10%"></th>
    </tr>
    </thead>
    <tbody>

    <?php $total = 0 ?>

    @if(session('cart'))
        @foreach(session('cart') as $id => $details)

            <?php $total += $details['precio'] * $details['quantity'] ?>

            <tr>
                <td data-th="Product">
                    <div class="row">
                        <div class="col-sm-3 hidden-xs"><img src="{{ $details['foto'] ?? '/img/placeholder-home.jpg'}}" width="100" height="100" class="img-responsive"/></div>
                        <div class="col-sm-9">
                            <h4 class="nomargin">{{ $details['name'] }}</h4>
                        </div>
                    </div>
                </td>
                <td data-th="precio">${{ $details['precio'] }}</td>
                <td data-th="Quantity">
                    <input type="number" value="{{ $details['quantity'] }}" class="form-control quantity" />
                </td>
                <td data-th="Subtotal" class="text-center">${{ $details['precio'] * $details['quantity'] }}</td>
                <td class="actions" data-th="">
                    <button class="btn btn-info btn-sm update-cart" data-id="{{ $id }}"><i class="fa fa-refresh"></i></button>
                    <button class="btn btn-danger btn-sm remove-from-cart" data-id="{{ $id }}"><i class="fa fa-trash-o"></i></button>
                </td>
            </tr>
        @endforeach
    @endif

    </tbody>
    <tfoot>
    <tr class="visible-xs">
        <td class="text-center"><strong>Total ${{ $total }}</strong></td>
    </tr>
    <tr>
        <td><a href="{{ url('/') }}" class="btn btn-warning"><i class="fa fa-angle-left"></i> Seguir comprando</a></td>
        <td colspan="2" class="hidden-xs"></td>
        <td class="hidden-xs text-center"><strong>Total ${{ $total }}</strong></td>
        @if (!session('cart'))
        <td><a href="{{ url('/checkout') }}" class="btn btn-warning disabled">Checkout <i class="fa fa-angle-right"></i></a></td>
        @else
        <td><a href="{{ url('/checkout') }}" class="btn btn-warning">Checkout <i class="fa fa-angle-right"></i></a></td>
        @endif
    </tr>
    </tfoot>
</table>
@endsection

@section('scripts')
 
 
    <script type="text/javascript">
 
        $(".update-cart").click(function (e) {
           e.preventDefault();
 
           var ele = $(this);
 
            $.ajax({
               url: '{{ url('update-cart') }}',
               method: "patch",
               data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id"), quantity: ele.parents("tr").find(".quantity").val()},
               success: function (response) {
                   window.location.reload();
               }
            });
        });
 
        $(".remove-from-cart").click(function (e) {
            e.preventDefault();
 
            var ele = $(this);
 
            if(confirm("Estás seguro?")) {
                $.ajax({
                    url: '{{ url('remove-from-cart') }}',
                    method: "DELETE",
                    data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id")},
                    success: function (response) {
                        window.location.reload();
                    }
                });
            }
        });
 
    </script>
 
@endsection