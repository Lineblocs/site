@extends('admin.layouts.default')

{{-- Web site Title --}}
@section('title') {!! trans("admin/customizations.customizations") !!} :: @parent
@endsection

{{-- Content --}}
@section('main')
<script src="https://unpkg.com/monaco-editor@latest/min/vs/loader.js"></script>
<style>
    html, body, #editor {
	position: absolute;
	left: 0;
	top: 0;
	width: 100%;
	height: auto;
	min-height: 300px;
	margin: 0;
	padding: 0;
	overflow: hidden;
}
</style>
    <div class="page-header">
        <h3>
            {!! trans("admin/routingeditor.routing_editor") !!}
        </h3>
    </div>
    <div class="col-md-12">
        <form id="editorFrm" method="POST" action="" enctype="multipart/form-data">
            <div class="row form-group route-editor">
                <div class="controls">
                    <!--<textarea name="opensips_config">{!! $opensips_config !!}</textarea>-->
                    <div id="editor"></div>
                </div>
            </div>
            <div class="row form-group">
                <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                <textarea style="display: none;" name="real_config_input" value=""></textarea>
                <button type="submit" class="btn btn-success">Save</button>
            </div>
        </form>
</div>
<script>
    require.config({ paths: { 'vs': 'https://unpkg.com/monaco-editor@latest/min/vs' }});
window.MonacoEnvironment = { getWorkerUrl: () => proxy };

let routerCode = {!! json_encode($opensips_config) !!};

let proxy = URL.createObjectURL(new Blob([`
	self.MonacoEnvironment = {
		baseUrl: 'https://unpkg.com/monaco-editor@latest/min/'
	};
	importScripts('https://unpkg.com/monaco-editor@latest/min/vs/base/worker/workerMain.js');
`], { type: 'text/javascript' }));


var editor;
var shouldSubmit = false;
require(["vs/editor/editor.main"], function () {
	editor = monaco.editor.create(document.getElementById('editor'), {
		value: routerCode,
		//language: 'javascript',
		theme: 'vs-dark',
	});
});
$("#editorFrm").submit(function(event) {
	event.preventDefault();
	var config = editor.getValue()
	console.log("config data ", config);
	$("textarea[name='real_config_input']").text( config );
	if (!shouldSubmit) {
    	shouldSubmit = true;

		$( this ).get(0).submit();
	}
})
setTimeout(() => {
	var padding = 0;
	var height = $("#editor").outerHeight();
	$(".route-editor").css({"height": height+"px"});
}, 0);
</script>
@endsection