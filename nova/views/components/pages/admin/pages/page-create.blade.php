<div class="visible-xs visible-sm">
	<p><a href="{{ route('admin.pages') }}" class="btn btn-default btn-lg btn-block">Back to Page Manager</a></p>
</div>
<div class="visible-md visible-lg">
	<div class="btn-toolbar">
		<div class="btn-group">
			<a href="{{ route('admin.pages') }}" class="btn btn-default">Back to Page Manager</a>
		</div>
	</div>
</div>

{!! Form::open(['route' => 'admin.pages.store', 'class' => 'form-horizontal']) !!}
	<div class="form-group{{ ($errors->has('type')) ? ' has-error' : '' }}">
		<label class="col-md-2 control-label">Page Type</label>
		<div class="col-md-5">
			<div class="radio">
				<label>
					{!! Form::radio('type', 'basic', false) !!} Basic Page
				</label>
			</div>
			<div class="radio">
				<label>
					{!! Form::radio('type', 'advanced', false) !!} Advanced Page
				</label>
			</div>
			{!! $errors->first('type', '<p class="help-block">:message</p>') !!}
		</div>
	</div>

	<div id="pageBasic" class="hide">
		<div class="form-group">
			<div class="col-md-5 col-md-offset-2">
				<h3>Page Info</h3>
			</div>
		</div>

		<div class="form-group{{ ($errors->has('basic[name]')) ? ' has-error' : '' }}">
			<label class="col-md-2 control-label">Name</label>
			<div class="col-md-5">
				{!! Form::text('basic[name]', null, ['class' => 'form-control input-lg']) !!}
				{!! $errors->first('basic[name]', '<p class="help-block">:message</p>') !!}
			</div>
		</div>

		<div class="form-group">
			<label class="col-md-2 control-label">Description</label>
			<div class="col-md-6">
				{!! Form::textarea('basic[description]', null, ['class' => 'form-control input-lg', 'rows' => 3]) !!}
			</div>
		</div>

		<div class="form-group{{ ($errors->has('basic[uri]')) ? ' has-error' : '' }}">
			<label class="col-md-2 control-label">URI</label>
			<div class="col-md-6">
				<div class="input-group">
					<span class="input-group-addon">{{ Request::root() }}/</span>
					{!! Form::text('basic[uri]', null, ['class' => 'form-control input-lg']) !!}
				</div>
				{!! $errors->first('basic[uri]', '<p class="help-block">:message</p>') !!}
				<p class="help-block">URIs identify and describe the resource (in this case, a page) that's being accessed with the following format: <code>foo/bar</code>. The only restrictions around URIs with basic pages is that they <strong>cannot</strong> have the same URI as another page and <strong>cannot</strong> use variables.</p>
			</div>
		</div>

		<div class="form-group{{ ($errors->has('basic[key]')) ? ' has-error' : '' }}">
			<label class="col-md-2 control-label">Key</label>
			<div class="col-md-6">
				{!! Form::text('basic[key]', null, ['class' => 'form-control input-lg']) !!}
				{!! $errors->first('basic[key]', '<p class="help-block">:message</p>') !!}
				<p class="help-block">Keys are used to uniquely identify your pages and create dynamic links to them. Even if the URI or other values of the page change, using the key to build links means that those links will always work as long as the key doesn't change. The only restriction with keys is that they <strong>cannot</strong> have the same key as another page.</p>
			</div>
		</div>
	</div>

	<div id="pageAdvanced" class="hide">
		<div class="form-group">
			<div class="col-md-8 col-md-offset-2">
				<h3>Page Info</h3>
			</div>
		</div>

		<div class="form-group">
			<label class="col-md-2 control-label">Name</label>
			<div class="col-md-5">
				{!! Form::text('advanced[name]', null, ['class' => 'form-control input-lg']) !!}
			</div>
		</div>

		<div class="form-group">
			<label class="col-md-2 control-label">Description</label>
			<div class="col-md-8">
				{!! Form::textarea('advanced[description]', null, ['class' => 'form-control input-lg', 'rows' => 3]) !!}
			</div>
		</div>

		<div class="form-group{{ ($errors->has('advanced[uri]')) ? ' has-error' : '' }}">
			<label class="col-md-2 control-label">URI</label>
			<div class="col-md-6">
				<div class="input-group">
					<span class="input-group-addon">{{ Request::root() }}/</span>
					{!! Form::text('advanced[uri]', null, ['class' => 'form-control input-lg']) !!}
				</div>
				{!! $errors->first('advanced[uri]', '<p class="help-block">:message</p>') !!}
				<p class="help-block">URIs identify and describe the resource (in this case, a page) that's being accessed with the following format: <code>foo/bar</code>. You can also specify variables in your URIs to use in code by wrapping the name of the variable in braces: <code>foo/bar/{id}</code>. In your code, you'd then pass <code>$id</code> as a parameter to the method and be able to use whatever value is in the URI at that segment. Optional variables are indicated by a trailing question mark: <code>foo/bar/{id?}</code> and in your code, should have a default value to prevent errors. The only restriction around URIs with advanced pages is that they <strong>cannot</strong> have the same URI as another page.</p>
			</div>
		</div>

		<div class="form-group">
			<label class="col-md-2 control-label">URI Conditions</label>
			<div class="col-md-6">
				{!! Form::textarea('advanced[conditions]', null, ['class' => 'form-control input-lg', 'rows' => 3]) !!}
				<p class="help-block">You can more closely control the content that can be put into URI parameters by defining conditions on any of the variables. URI conditions are period-delimited with the name of the variable first followed by the regular expression you want to use for evaluating the parameter: <code>name.[A-Za-z]+</code>. If you have multiple conditions for a URI, you can separate them with pipes: <code>name.[A-Za-z]+|id.[0-9]+</code>.</p>
			</div>
		</div>

		<div class="form-group{{ ($errors->has('advanced[key]')) ? ' has-error' : '' }}">
			<label class="col-md-2 control-label">Key</label>
			<div class="col-md-6">
				{!! Form::text('advanced[key]', null, ['class' => 'form-control input-lg']) !!}
				{!! $errors->first('advanced[key]', '<p class="help-block">:message</p>') !!}
				<p class="help-block">Keys are used to uniquely identify your pages and create dynamic links to them. Even if the URI or other values of the page change, using the key to build links means that those links will always work as long as the key doesn't change. The only restriction with keys is that they <strong>cannot</strong> have the same key as another page. You should <strong>not</strong> put any variables into your keys.</p>
			</div>
		</div>

		<div class="form-group">
			<label class="col-md-2 control-label">HTTP Verb</label>
			<div class="col-md-2">
				{!! Form::select('advanced[verb]', $httpVerbs, null, ['class' => 'form-control input-lg']) !!}
			</div>
			<div class="col-md-2">
				<p><a href="#" class="btn btn-link btn-lg" data-toggle="modal" data-target="#helpVerbs">What are HTTP Verbs?</a></p>
			</div>
		</div>

		<div class="form-group">
			<label class="col-md-2 control-label">Resource</label>
			<div class="col-md-8">
				{!! Form::text('advanced[resource]', null, ['class' => 'form-control input-lg']) !!}
				<p class="help-block">The page resource <strong>must</strong> be a class name (including its full namespace) and method that tells {{ config('nova.app.name') }} what code it should use when this page is requested. Resources should be in the following format: <code>Foo\Bar\Baz@method</code>. You do not need to specify any variables from the URI in the resource; those items will automatically be passed to the method you provide.</p>
			</div>
		</div>
	</div>

	<div id="pageContent" class="hide">
		<div class="form-group">
			<div class="col-md-5 col-md-offset-2">
				<h3>Content</h3>
			</div>
		</div>

		<div class="form-group{{ ($errors->has('content[title]')) ? ' has-error' : '' }}">
			<label class="col-md-2 control-label">Page Title</label>
			<div class="col-md-6">
				{!! Form::text('content[title]', null, ['class' => 'form-control input-lg']) !!}
				{!! $errors->first('content[title]', '<p class="help-block">:message</p>') !!}
				<p class="help-block">Page titles define the title of the document and are often used by search engine result pages as well as displayed in the title bar of the browser. The page title should be an accurate and concise description of the page's content.</p>
			</div>
		</div>

		<div class="form-group{{ ($errors->has('content[header]')) ? ' has-error' : '' }}">
			<label class="col-md-2 control-label">Page Header</label>
			<div class="col-md-6">
				{!! Form::text('content[header]', null, ['class' => 'form-control input-lg']) !!}
				{!! $errors->first('content[header]', '<p class="help-block">:message</p>') !!}
				<p class="help-block">Page headers are displayed above the page's content and act as a title for the page.</p>
			</div>
		</div>

		<div class="form-group{{ ($errors->has('content[message]')) ? ' has-error' : '' }}">
			<label class="col-md-2 control-label">Content</label>
			<div class="col-md-8">
				{!! Form::textarea('content[message]', null, ['class' => 'form-control input-lg', 'rows' => 10]) !!}
				{!! $errors->first('content[message]', '<p class="help-block">:message</p>') !!}

				<ul class="nav nav-pills nav-pills-sm">
					<li><a href="#help-markdown" data-toggle="pill">Markdown Help</a></li>
					<li><a href="#help-compilers" data-toggle="pill">Page Compilers Help</a></li>
				</ul>
				<div class="tab-content">
					<div id="help-markdown" class="tab-pane">
						{!! partial('help-markdown') !!}
					</div>
					<div id="help-compilers" class="tab-pane">
						{!! partial('help-compilers') !!}
					</div>
				</div>
			</div>
		</div>
	</div>

	<div id="pageControls" class="form-group hide">
		<div class="col-md-5 col-md-offset-2">
			<div class="visible-xs visible-sm">
				{!! Form::button("Add Page", ['class' => 'btn btn-primary btn-lg btn-block', 'type' => 'submit']) !!}
			</div>
			<div class="visible-md visible-lg">
				{!! Form::button("Add Page", ['class' => 'btn btn-primary btn-lg', 'type' => 'submit']) !!}
			</div>
		</div>
	</div>
{!! Form::close() !!}

{!! modal(['id' => 'helpVerbs', 'header' => "What Are HTTP Verbs?", 'body' => view(locate('page', 'admin/pages/help-verbs'))]) !!}