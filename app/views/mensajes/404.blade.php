@extends('templates.web')
@section('titulo')
    Opps
    @stop
    @section('contenido')
    <!-- Content start //-->
    <main class="site-main">
        <!-- Intro start //-->
        <section class="section-404">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 align-center">
                        <p class="big">That link is broken.</p>
                        <p class="font-bold">We can not seem to find /404/</p>
                        <p class="primary-color">Please use the navigation above or search to find what you are looking for.</p>
                        <form>
                            <input type="search" name="s" placeholder="type here...">
                            <button type="submit" class="biss-btn biss-btn-primary"><i class="fa fa-search"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- Intro end //-->
    </main>
@endsection
