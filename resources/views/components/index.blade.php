@extends('layouts/default')

{{-- Page title --}}
@section('title')
{{ trans('general.components') }}
@parent
@stop

@section('header_right')
    @can('components.create')
        <a href="{{ route('create/component') }}" class="btn btn-primary pull-right"> {{ trans('general.create') }}</a>
    @endcan
@stop

{{-- Page content --}}
@section('content')


<div class="row">
  <div class="col-md-12">

    <div class="box box-default">
        <div class="box-body">
          {{ Form::open([
               'method' => 'POST',
               'route' => ['component/bulk-form'],
               'class' => 'form-inline' ]) }}


          <div id="toolbar">
            <!-- <select name="bulk_actions" class="form-control select2" style="width: 130px;">
              <option value="checkout">Checkout</option>
              <option value="checkin">Checkin</option>
            </select>
            <button class="btn btn-default" id="bulkEdit" disabled>Go</button>
            -->
          </div>


          <table
          data-toolbar="#toolbar"
          name="components"
          class="table table-striped snipe-table"
          id="table"
          data-url="{{route('api.components.list') }}"
          data-cookie="true"
          data-click-to-select="true"
          data-cookie-id-table="componentsTable-{{ config('version.hash_version') }}-{{ config('version.hash_version') }}">
            <thead>
              <tr>
                <th data-sortable="true" data-field="id" data-visible="false">{{ trans('general.id') }}</th>
                <th data-switchable="true" data-visible="false" data-searchable="true" data-sortable="true" data-field="companyName">{{ trans('admin/companies/table.title') }}</th>
                <th data-sortable="true" data-searchable="true" data-field="name">{{ trans('admin/components/table.title') }}</th>
				<th data-sortable="true" data-field="component_tag">{{ trans('admin/components/table.component_tag') }}</th>
                <th data-sortable="true" data-searchable="true" data-field="serial" data-visible="false">{{ trans('admin/hardware/form.serial') }}</th>
                <th data-searchable="true" data-sortable="true" data-field="location">{{ trans('general.location') }}</th>
				<th data-field="manufacturer" data-searchable="true" data-sortable="true">{{ trans('general.manufacturer') }}</th>
				<th data-sortable="true" data-field="model">{{ trans('admin/hardware/form.model') }}</th>
				<th data-searchable="true" data-sortable="true" data-field="model_number">{{ trans('admin/models/table.modelnumber') }}</th>
                <th data-searchable="true" data-sortable="true" data-field="category">{{ trans('general.category') }}</th>
                <th data-switchable="true" data-searchable="false" data-sortable="true" data-field="qty"> {{ trans('admin/components/general.total') }} </th>
				<th data-switchable="false" data-searchable="false" data-sortable="true" data-field="numRemaining"> {{ trans('admin/components/general.remaining') }}</th>
				<th data-switchable="true" data-searchable="false" data-sortable="true" data-field="min_amt"> {{ trans('general.min_amt') }}</th>
                <th data-sortable="true" data-searchable="true" data-field="order_number" data-visible="false">{{ trans('admin/components/general.order') }}</th>
                <th data-sortable="true" data-searchable="true" data-field="purchase_date" data-visible="false">{{ trans('admin/components/general.date') }}</th>
                <th data-sortable="true" data-searchable="true" data-field="purchase_cost" data-visible="false">{{ trans('admin/components/general.cost') }}</th>
				<th data-sortable="false" data-field="eol" data-searchable="true">{{ trans('general.eol') }}</th>
				<th data-sortable="true" data-searchable="true" data-field="notes">{{ trans('general.notes') }}</th>
				<th data-sortable="true" data-searchable="true"  data-field="order_number">{{ trans('admin/hardware/form.order') }}</th>

                <th data-switchable="false" data-searchable="false" data-sortable="false" data-field="actions"> {{ trans('table.actions') }}</th>

              </tr>
            </thead>
          </table>
          {{ Form::close() }}
        </div><!-- /.box-body -->
      </div><!-- /.box -->

  </div>
</div>

@stop

@section('moar_scripts')
@include ('partials.bootstrap-table', ['exportFile' => 'components-export', 'search' => true])

<script>
    $(function() {
        function checkForChecked() {
            var check_checked = $('input.one_required:checked').length;
            if (check_checked > 0) {
                $('#bulkEdit').removeAttr('disabled');
            }
            else {
                $('#bulkEdit').attr('disabled', 'disabled');
            }
        }
        $('#table').on('change','input.one_required',checkForChecked);
        $("#checkAll").change(function () {
            $("input:checkbox").prop('checked', $(this).prop("checked"));
            checkForChecked();
        });
    });
</script>

@stop
