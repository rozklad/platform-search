<!-- Widget: sanatorium/search::hooks.box -->
<form method="GET" class="{{ $css_classes }}">
	<div class="form-group">
		<input type="text" name="{{ trans('sanatorium/shop::general.search.input') }}" class="form-control product-search" placeholder="{{ trans('sanatorium/search::general.search_placeholder') }}">
	</div>
	<button class="btn btn-default" type="submit">
		<span class="button-label">
			{{ trans('sanatorium/search::action.search_btn') }}
		</span>
		<i class="fa fa-search"></i>
	</button>

	{{-- Note down user_id for analytics --}}
	@if ( Sentinel::check() )
		@if ( $user = Sentinel::getUser() ) 
			<input type="hidden" name="user_id" value="{{ $user->id }}">
		@endif
	@endif
	
</form>
