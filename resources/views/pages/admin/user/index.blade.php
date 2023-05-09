@extends('layouts.admin')

@section('extend_assets_css')
    <link rel="stylesheet" href="{{ asset('plugins/noty/noty.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">
@endsection

@section('extend_assets_js')
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/buttons/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/buttons/buttons.print.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/buttons/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/buttons/buttons.flash.min.js') }}"></script> 
    <script src="{{ asset('plugins/datatables/buttons/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('plugins/noty/noty.min.js') }}"></script>
@endsection

@section('extend_assets_js_native')
    <script>
        $(document).ready(function(){
            var table = $('#data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.super.user.index') }}",
                columns: [
                    {data: 'id', name: 'number', class: 'text-center', orderable: false, searchable: false, 
                        render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {data: 'name', name: 'name', orderable: false, searchable: true, 
                        render: function (data, type, row, meta) {
                            return '<p>'+data+'</p>';
                        }
                    },
                    {data: 'email', name: 'email', orderable: false, searchable: true, 
                        render: function (data, type, row, meta) {
                            return '<p>'+data+'</p>';
                        }
                    },
                    {data: 'level', name: 'level', orderable: false, searchable: false, 
                        render: function (data, type, row, meta) {
                            return `<div class="text-center"><span class="badge bg-light rounded-pill py-2 px-3 font-size-14 text-success"><i class="bi bi-shield-fill-check me-1"></i>${data}</span></div>`;
                        }
                    },
                    {data: 'created_at', name: 'created_at', orderable: false, searchable: false, 
                        render: function (data, type, row, meta) {
                            return `<div class="badge bg-light rounded-pill py-2 px-3 font-size-10 text-dark" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Created">${data}</div>`;
                        }
                    },
                    {data: 'action', name: 'action', orderable: false, searchable: false,
                        render: function (data, type, row, meta) {
                            // Route replace first for dynamic
                            let routeEdit = '{{route("admin.super.user.edit", ":id")}}';
                            let routeDelete = '{{route("admin.super.user.destroy", ":id")}}';
                            routeEdit = routeEdit.replace(':id', data[0]);
                            routeDelete = routeDelete.replace(':id', data[0]);
                            // then, passing to link
                            let actEdit = `<div class="col-lg-6 pr-lg-1 mb-1 mb-lg-0"><a href="${routeEdit}" class="btn btn-sm btn-outline-primary w-100" data-bs-toggle="tooltip" data-bs-placement="left" title="Edit ${data[1]}"><i class="bi bi-pencil-square"></i></a></div>`;
                            let actDelete = `<div class="col-lg-6 pl-lg-1"><a href="javascript:void(0)" onclick="actionDelete(this)" data-route="${routeDelete}" data-button-type="delete" class="btn btn-sm btn-outline-danger w-100" data-bs-toggle="tooltip" data-bs-placement="left" title="Delete ${data[1]}?"><i class="bi bi-trash"></i></a></div>`;
                            let action = `<div class="row px-3 text-center">${actEdit} ${actDelete}</div>`;
                            return action;
                        }
                    },
                ],
                autoWidth: false,
            });

            table.on('draw', function () {
               DOMRender();
            });
        })
    </script>
    @include('components.admin.action.delete')
    @include('components.status')
@endsection

@section('content')
    <div class="block block-rounded">
        <div class="block-header d-md-flex align-items-center justify-content-between py-3 border-bottom">
            <h3 class="block-title">User</h3>
            <button type="button" class="btn btn-success font-size-12" data-bs-toggle="modal" data-bs-target="#user-add"> 
                <i class="bi bi-plus"></i> Add
            </button>
        </div>
        <div class="block-content block-content-full pt-3">
            <table class="table table-responsive table-vcenter js-dataTable-full" id="data-table">
                <thead>
                    <tr>
                        <th class="text-center" style="vertical-align: middle;" width="5%">No</th>
                        <th class="text-center" style="vertical-align: middle;" width="30%">Name</th>
                        <th class="text-center" style="vertical-align: middle;" width="25%">Email</th>
                        <th class="text-center" style="vertical-align: middle;" width="10%">Level</th>
                        <th class="text-center" style="vertical-align: middle;" width="15%">Time</th>
                        <th class="text-center" style="vertical-align: middle;" width="15%">Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
    @include('components.admin.action.add-user')
@endsection
