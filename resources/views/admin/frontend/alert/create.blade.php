@include('admin.template.header')
    <div id="app">
        <div class="all container">
            <h1>novo alerta</h1> <a href="{{URL::previous()}}" class="btn btn-dark">voltar</a>
        </div><!--all-->
        <create-component></create-component>
    </div>

@include('admin.template.footer')

