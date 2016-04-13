<!-- START WIDGET -->
<div class="widget-11-2 panel no-border panel-condensed no-margin widget-loader-circle">
	<div class="panel-heading top-right">
		<div class="panel-controls">
			<ul>
				<li>
					<a data-toggle="refresh" class="portlet-refresh text-black" href="#"><i class="portlet-icon portlet-icon-refresh"></i></a>
				</li>
			</ul>
		</div>
	</div>
	<div class="padding-25">
		<div class="pull-left">
			<h2 class="text-success no-margin">{{ trans('sanatorium/search::widgets.top.title') }}</h2>
			<p class="no-margin">{{ trans('sanatorium/search::widgets.top.subtitle') }}</p>
		</div>
		<h3 class="pull-right semi-bold"><sup><small class="semi-bold">*</small></sup> {{ $total }}</h3>
		<div class="clearfix"></div>
	</div>
	<div class="auto-overflow widget-11-2-table">
		<table class="table table-condensed table-hover">
			<tbody>
				@foreach($top as $item)
					<tr>
						<td class="font-montserrat fs-12 col-lg-6">
							{{ $item->query }}
						</td>
						<td class="text-right b-r b-dashed b-grey col-lg-3">
							<a class="hint-text small all" href="{{ URL::to('/?'.trans('sanatorium/shop::general.search.input') . '=' . $item->query) }}" target="_blank">
								{{ trans('sanatorium/search::widgets.top.search') }}
							</a>
						</td>
						<td class="col-lg-3">
							<span class="font-montserrat fs-18">
								{{ $item->query_count }}
							</span>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	<div class="padding-25">
		<p class="small no-margin">
			<a href="#"><i class="fa fs-16 fa-question text-success m-r-10"></i></a>
			<span class="hint-text ">{{ trans('sanatorium/search::widgets.top.footer') }}</span>
		</p>
	</div>
</div>
<!-- END WIDGET -->
