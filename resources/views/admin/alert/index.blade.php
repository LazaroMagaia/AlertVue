@include('admin.template.header')

<div id="app">
    <div class="space-handle">
        <indexalert-component id={!! Auth::user()->id !!}></indexalert-component>
    </div>
</div>
@include('admin.template.sidebar')
