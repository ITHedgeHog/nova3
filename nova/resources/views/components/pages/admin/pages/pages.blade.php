<div v-cloak>
	<mobile>
		@can('create', $page)
			<p><a href="{{ route('admin.pages.create') }}" class="btn btn-success btn-lg btn-block">{!! icon('add') !!}<span>{{ _m('pages-add') }}</span></a></p>
		@endcan

		<p><a href="{{ route('admin.content') }}" class="btn btn-secondary btn-lg btn-block">{!! icon('list') !!}<span>{{ _m('pages-manage-content') }}</span></a></p>
	</mobile>

	<div class="data-table bordered striped">
		<div class="row header">
			<div class="col">
				<div class="input-group">
					{!! Form::text('searchName', null, ['class' => 'form-control', 'v-model' => 'search', 'placeholder' => _m('pages-filter')]) !!}
					<span class="input-group-btn">
						<button class="btn btn-secondary" type="button" @click.prevent="resetFilters">{!! icon('close') !!}</button>
					</span>
				</div>
			</div>
			<div class="col-md-6">
				<desktop>
					<div class="btn-toolbar pull-right">
						@can('create', $page)
							<div class="btn-group">
								<a href="{{ route('admin.pages.create') }}" class="btn btn-success">{!! icon('add') !!}<span>{{ _m('pages-add') }}</span></a>
							</div>
						@endcan

						<div class="btn-group">
							<a href="{{ route('admin.content') }}" class="btn btn-secondary">{!! icon('list') !!}<span>{{ _m('pages-manage-content') }}</span></a>
						</div>
					</div>
				</desktop>
			</div>
		</div>
		<div class="row" v-for="page in filteredPages">
			<div class="col-md-9">
				<p class="lead"><strong>@{{ page.name }}</strong></p>
				<p><strong>{{ _m('key') }}:</strong> @{{ page.key }}</p>
			</div>
			<div class="col-md-3">
				<mobile>
					@can('edit', $page)
						<p><a :href="page.editUrl" class="btn btn-secondary btn-lg btn-block">{!! icon('edit') !!}<span>{{ _m('edit') }}</span></a></p>
					@endcan

					@can('remove', $page)
						<p v-show="!page.protected"><a href="#" class="btn btn-danger btn-lg btn-block" @click.prevent="removePage(page.id)">{!! icon('delete') !!}<span>{{ _m('remove') }}</span></a></p>
					@endcan
				</mobile>
				<desktop>
					<div class="btn-toolbar pull-right">
						@can('edit', $page)
							<div class="btn-group">
								<a :href="page.editUrl" class="btn btn-secondary">{!! icon('edit') !!}<span>{{ _m('edit') }}</a>
							</div>
						@endcan

						@can('remove', $page)
							<div class="btn-group" v-if="!page.protected">
								<a href="#" class="btn btn-danger" @click.prevent="removePage(page.id)">{!! icon('delete') !!}<span>{{ _m('remove') }}</span></a>
							</div>
						@endcan
					</div>
				</desktop>
			</div>
		</div>
	</div>
</div>

@can('remove', $page)
	{!! modal(['id' => "removePage", 'header' => _m('pages-remove')]) !!}
@endcan