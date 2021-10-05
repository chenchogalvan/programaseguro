@extends('admin')


@section('section')
    <div class="content-wrapper profile-page">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6">
                    <h4 class="mb-0"> Perfil</h4>
                </div>

            </div>
        </div>
        <!-- widgets -->
        <div class="row">

            <div class="col-lg-12 mb-30">
                <div class="card">
                    <div class="card-body">
                        <div class="user-bg" style="background: url(/images/userbg.jpg);">
                            <div class="user-info">
                                <div class="row">
                                    <div class="col-lg-6 align-self-center">
                                        <div class="user-dp"><img src="/images/team/user.png" alt=""></div>
                                        <div class="user-detail">
                                            <h2 class="name">{{ Auth::user()->name }}</h2>
                                            <p class="designation mb-0">- {{ Auth::user()->email }}</p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- Orders Status widgets-->

        <div class="row">
            <div class="col-xl-4 mb-30">
                @if (Session::has('successDatos'))
                <div class="mb-30">
                    <div class="alert alert-success" role="alert">
                        <h4 class="alert-heading">Datos actualizados</h4>
                        <p>Los datos se actualizaron de forma correcta</p>
                    </div>
                </div>
                @endif
                <div class="card mb-30 about-me">
                    <div class="card-body">
                        <h5 class="card-title"> Información</h5>

                        <div class="btn-group info-drop">
                            {{-- <button type="button" class="dropdown-toggle-split text-muted" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false"><i class="ti-more"></i></button> --}}
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#exampleModalCenter"><i
                                        class="text-success ti-pencil-alt"></i>
                                    Editar</a>

                            </div>
                        </div>


                        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <div class="modal-title">
                                            <div class="mb-30">
                                                <h6>{{ Auth::user()->name }}</h6>
                                                <h2>Actualizar datos</h2>
                                                <p>En caso de querer actualizar otro dato, favor de mandar un ticket.</p>
                                            </div>
                                        </div>
                                        {{-- <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button> --}}
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="{{ route('actualizarInfo') }}">
                                            @csrf
                                            <div class="form-group">
                                                <label>Correo</label>
                                                <input type="email" class="form-control" name="email"
                                                    value="{{ Auth::user()->email }}">
                                            </div>
                                            {{-- <div class="form-group">
                                                <label>Teléfono</label>
                                                <input type="text" class="form-control" name="phone"
                                                    value="{{ Auth::user()->phone }}">
                                            </div>
                                            <div class="form-group">
                                                <label>N° IMSS</label>
                                                <input type="text" class="form-control" name="NSS"
                                                    value="{{ Auth::user()->NSS }}">
                                            </div>
                                            <div class="form-group">
                                                <label>RFC</label>
                                                <input type="text" class="form-control" name="RFC"
                                                    value="{{ Auth::user()->RFC }}">
                                            </div>
                                            <div class="form-group">
                                                <label>CURP</label>
                                                <input type="text" class="form-control" name="CURP"
                                                    value="{{ Auth::user()->CURP }}">
                                            </div> --}}
                                            <button type="submit" class="btn btn-primary">Guardar datos</button>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <ul class="list-unstyled ">
                            <li class="list-item"><span class="text-info ti-star"></span><b>Teléfono:</b>
                                {{ Auth::user()->phone }}
                            </li>
                            <li class="list-item"><span class="text-info ti-star"></span><b>Correo:</b>
                                {{ Auth::user()->email }}
                            </li>
                            <li class="list-item"><span class="text-info ti-star"></span><b>RFC:</b>
                                {{ Auth::user()->RFC }}
                            </li>
                            <li class="list-item"><span class="text-info ti-star"></span><b>N° Seguro:</b>
                                {{ Auth::user()->NSS }}
                            </li>
                            <li class="list-item"><span class="text-info ti-star"></span><b>CURP:</b>
                                {{ Auth::user()->CURP }}
                            </li>





                            <li>
                                <fieldset @if ($upago->count() > 0)   @else disabled="on" @endif >
                                    <button class="btn btn-success d-grid" data-toggle="modal" data-target="#exampleModalCenter">@if ($upago->count() > 0) Editar correo  @else Debes realizar el pago para poder editar tu correo @endif</button>
                                </fieldset>
                            </li>

                        </ul>
                    </div>
                </div>

            </div>
            <div class="col-xl-8 mb-30">
                <div class="card tickets">
                    <div class="card-body">
                        <h5 class="card-title"> Tickets</h5>
                        <!-- action group -->
                        <div class="btn-group info-drop">
                            <button type="button" class="dropdown-toggle-split text-muted" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false"><i class="ti-more"></i></button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('soporte') }}"><i class="text-success ti-book"></i>Crear nuevo
                                    ticket</a>
                            </div>
                        </div>
                        <div class="scrollbar max-h-550 tickets-info">
                            <ul class="list-unstyled">
                                @foreach ($t as $t)
                                <li class="mb-15">
                                    <div class="media">
                                        <div class="media-body">
                                            <h6 class="mt-0 ">{{ $t->asunto }} - <small @if ($t->status == 'abierto') class="text-success" @elseif($t->status == 'cerrado') class="text-danger" @endif> {{ $t->status }}</small></h6>

                                            <p class="mt-10">{{ $t->mensaje }}</p>
                                        </div>
                                    </div>
                                    <div class="divider mt-15"></div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                </div>





            </div>
        </div>
    </div>
@endsection

