<form method="GET" class="navbar-form {{ $css_classes }}">
	<div class="input-group">
		<input type="text" name="{{ trans('sanatorium/shop::general.search.input') }}" class="form-control input-lg product-search" placeholder="{{ trans('sanatorium/search::action.search_placeholder') }}">
		<span class="input-group-btn">
			<button class="btn btn-primary btn-lg" type="submit">
				<span class="button-label">{{ trans('sanatorium/search::action.search_btn') }}</span>
				<i class="fa fa-search"></i>
			</button>
		</span>
	</div>

	@if ( Sentinel::check() )
		@if ( $user = Sentinel::getUser() ) 
			<input type="hidden" name="user_id" value="{{ $user->id }}">
		@endif
	@endif
	
</form>
