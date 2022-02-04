@include('admin.template.header')
    <div id="app">
        <div class="all container">
            <h1>Alertas</h1> <a href="{{URL::previous()}}" class="btn btn-dark">voltar</a>
        </div><!--all-->
        <alert-component></alert-component>
    </div>

@include('admin.template.footer')

