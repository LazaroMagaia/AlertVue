@include('admin.template.header')
    <div id="app">
        <div class="all container">
            <h1>Editar Alerta</h1> <a href="{{URL::previous()}}" class="btn btn-dark">voltar</a>
        </div><!--all-->
        <edit-component></edit-component>
    </div>

@include('admin.template.footer')

