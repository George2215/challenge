<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            .background-div{
                background-color: #CCEAF8
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="row">
                <div class="col border border-dark rounded-sm background-div">
                    <form class="mb-3" method="GET" action="{{ route('invoice') }}">
                        <button class="btn btn-primary mt-2 mb-3" type="submit">
                            Calcular Total
                        </button>

                        <div class="form-group">
                            <!--<label for="formGroupExampleInput"></label>-->
                            <input type="text"
                                class="form-control {{ $errors->has('invoice') ? 'is-invalid' : ''}}""
                                id="formGroupExampleInput"
                                name="invoice"
                                value="{{ old('invoice') }}"
                                placeholder="Número de Factura">
                                <div class="invalid-feedback">Este campo es requerido</div>
                        </div>
                    </form>
                    <div class="form-group">
                        <!--<label for="formGroupExampleInput2">Another label</label>-->
                        @isset($total)
                        <input type="text" 
                            class="form-control" 
                            id="formGroupExampleInput2"
                            name="total"
                            value="$ {{ number_format($total) }}"
                            placeholder="Valor total Factura"
                            disabled>
                        @endisset
                    </div>
                </div>

                <div class="col border border-dark rounded-sm ml-2 background-div">
                    <a class="btn btn-primary mt-2 mb-3" href="{{ route('invoice.hundred') }}">
                        Facturas con Productos > 100
                    </a>
                    <div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="bg-white text-dark" scope="col">Id Factura</th>
                                </tr>
                            </thead>
                            <tbody>
                                @isset($arrayInvoiceId)
                                    @foreach($arrayInvoiceId as $invoice)
                                    <tr>
                                        <th class="bg-white text-dark" scope="row">{{ $invoice }}</th>
                                    </tr>
                                    @endforeach
                                @endisset
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="col border border-dark rounded-sm ml-2 background-div">
                    <a class="btn btn-primary mt-2 mb-3" href="{{ route('products') }}">
                        Nombres de Productos > 1MM
                    </a>
                    <div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="bg-white text-dark" scope="col">Nombre Producto</th>
                                </tr>
                            </thead>
                            <tbody>
                                @isset($arrayNames)
                                    @foreach($arrayNames as $name)
                                    <tr>
                                        <th class="bg-white text-dark" scope="row">{{ $name }}</th>
                                    </tr>
                                    @endforeach
                                @endisset
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="col border border-dark rounded-sm ml-2 background-div">
                    <form class="mb-3" method="POST" action="{{ route('product.store') }}">
                        @csrf

                        <button class="btn btn-primary mt-2 mb-3" type="submit">
                            Registrar Producto
                        </button>

                        <div class="form-group">
                            <!--<label for="formGroupExampleInput"></label>-->
                            <input type="text"
                                class="form-control {{ $errors->has('invoice_id') ? 'is-invalid' : ''}}"
                                id="formGroupExampleInput"
                                name="invoice_id"
                                value="{{ old('invoice_id') }}"
                                placeholder="Número de Factura">
                                <div class="invalid-feedback">Este campo es requerido</div>
                        </div>
                        <div class="form-group">
                            <!--<label for="formGroupExampleInput"></label>-->
                            <input type="text"
                                class="form-control {{ $errors->has('name') ? 'is-invalid' : ''}}"
                                id="formGroupExampleInput"
                                name="name"
                                value="{{ old('name') }}"
                                placeholder="Nombre Producto">
                                <div class="invalid-feedback">Este campo es requerido</div>
                        </div>
                        <div class="form-group">
                            <!--<label for="formGroupExampleInput"></label>-->
                            <input type="text"
                                class="form-control {{ $errors->has('quantity') ? 'is-invalid' : ''}}"
                                id="formGroupExampleInput"
                                name="quantity"
                                value="{{ old('quantity') }}"
                                placeholder="Cantidad">
                                <div class="invalid-feedback">Este campo es requerido</div>
                        </div>
                        <div class="form-group">
                            <!--<label for="formGroupExampleInput"></label>-->
                            <input type="text"
                                class="form-control {{ $errors->has('price') ? 'is-invalid' : ''}}"
                                id="formGroupExampleInput"
                                name="price"
                                value="{{ old('price') }}"
                                placeholder="Precio">
                                <div class="invalid-feedback">Este campo es requerido</div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- JavaScript Bundle with Popper -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

        <script>
            @if ($errors->any())
                toastr.error("Formulario Incompleto")
            @endif
        </script>

        <script>
            @if (session('message'))
                toastr.success("{!! Session::get('message') !!}")
            @endif
        </script>
    </body>
</html>
