@extends ('backend.layouts.app')

@section ('title',  isset($repository->moduleTitle) ? $repository->moduleTitle. ' Management' : 'Management')

@section('after-styles')
    {{ Html::style("css/backend/plugin/datatables/dataTables.bootstrap.min.css") }}
@endsection

@section('page-header')
    <h1>{{ isset($repository->moduleTitle) ? $repository->moduleTitle : '' }} Management</h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">{{ isset($repository->moduleTitle) ? str_plural($repository->moduleTitle) : '' }} Listing</h3>

            <div class="box-tools pull-right">
                @include('common.product.index-header-buttons', ['createRoute' => $repository->getActionRoute('createRoute')])
            </div>
        </div>

        <div class="box-body">
            {{-- <div class="row">

            <div class="col-md-2  pull-right">
                <div id="flip" class="btn btn-success">Bulk Upload</div>
            </div>
            <div class="col-md-10">
                <div id="panel" style="display: none;">
                    {{ Form::open([
                        'route'     => $repository->getActionRoute('bulkUploadRoute'),
                        'class'     => 'form-horizontal',
                        'role'      => 'form',
                        'method'    => 'post',
                        'files'     => true
                    ])}}
                    <table class="table">
                        <tr>
                            <td> Upload CSV File : 
                            <p> <a target="_blank" href="{!! URL::to('uploads/bulk-upload/default.csv') !!}">Download Sample file</a></p>
                            </td>
                            <td> <input type="file" name="csv_file" class="form-control">
                            <td> {{ Form::submit('Bulk Upload', ['class' => 'btn btn-success btn-xs']) }} </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div> --}}

        <div class="box-body">
            <div class="table-responsive">
                <table id="items-table" class="table table-condensed table-hover">
                    <thead>
                        <tr id="tableHeadersContainer"></tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">History</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body">
            {!! history()->renderType('Product') !!}
        </div>
    </div>
@endsection

@section('after-scripts')

    {{ Html::script("js/backend/plugin/datatables/jquery.dataTables.min.js") }}
    {{ Html::script("js/backend/plugin/datatables/dataTables.bootstrap.min.js") }}

    <script>
        var headers      = JSON.parse('{!! $repository->getTableHeaders() !!}'),
            columns      = JSON.parse('{!! $repository->getTableColumns() !!}');
            moduleConfig = {
                getTableDataUrl: '{!! route($repository->getActionRoute("dataRoute")) !!}'
            };

        jQuery(document).ready(function()
        {
            BaseCommon.Utils.setTableHeaders(document.getElementById("tableHeadersContainer"), headers);
            BaseCommon.Utils.setTableColumns(document.getElementById("items-table"), moduleConfig.getTableDataUrl, 'GET', columns);

            jQuery("#flip").click(function()
            {
                jQuery("#panel").toggle();
            });

    	});
    </script>
@endsection