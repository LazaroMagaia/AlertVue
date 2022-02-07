@include('admin.template.header')

<div id="app">
    <div class="space-handle">
        <indexalert-component></indexalert-component>
        {{Auth::user()->name}}
    </div>
</div>
@include('admin.template.sidebar')

