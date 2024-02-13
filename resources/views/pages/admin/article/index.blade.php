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
                    ajax: "{{ route('admin.article.index') }}",
                    columns: [
                        {data: 'id', name: 'number', class: 'text-center', orderable: false, searchable: false, 
                            render: function (data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1;
                            }
                        },
                        {data: 'title', name: 'title', orderable: false, searchable: true, 
                            render: function (data, type, row, meta) {
                                return `<p>${data}</p>`;
                            }
                        },
                        {data: 'author', name: 'author.name', orderable: false, searchable: true, 
                            render: function (data, type, row, meta) {
                                return '<p>'+data+'</p>';
                            }
                        },
                        {data: 'hits', name: 'hits', orderable: false, searchable: false, 
                            render: function (data, type, row, meta) {
                                return '<p>'+data+'x</p>';
                            }
                        },
                        {data: 'time', name: 'time', orderable: false, searchable: false, 
                            render: function (data, type, row, meta) {
                                return `<div class="badge bg-light rounded-pill py-2 px-3 font-size-10 text-dark mb-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Created">${data[0]}</div><div class="badge bg-light rounded-pill py-2 px-3 font-size-10 text-dark" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Last updated">${data[1]}</div>`;
                            }
                        },
                        {data: 'action', name: 'action', orderable: false, searchable: false,
                            render: function (data, type, row, meta) {
                                // Route replace first for dynamic
                                let routeEdit = '{{route("admin.article.edit", ":id")}}';
                                let routeDelete = '{{route("admin.article.destroy", ":id")}}';
                                routeEdit = routeEdit.replace(':id', data[0]);
                                routeDelete = routeDelete.replace(':id', data[0]);
                                // then, passing to link
                                let actShow = `<div class="col-12 col-lg-4 pe-lg-1 mb-1 mb-lg-0"><a href="${data[2]}" target="_blank" class="btn btn-sm btn-outline-success w-100" data-bs-toggle="tooltip" data-bs-placement="left" title="View ${data[1]}"><i class="bi bi-folder2"></i></a></div>`;
                                let actEdit = `<div class="col-12 col-lg-4 px-lg-2 mb-1 mb-lg-0"><a href="${routeEdit}" class="btn btn-sm btn-outline-primary w-100" data-bs-toggle="tooltip" data-bs-placement="left" title="Edit ${data[1]}"><i class="bi bi-pencil-square"></i></a></div>`;
                                let actDelete = `<div class="col-12 col-lg-4 ps-lg-1"><a href="javascript:void(0)" onclick="actionDelete(this)" data-route="${routeDelete}" data-button-type="delete" class="btn btn-sm btn-outline-danger w-100" data-bs-toggle="tooltip" data-bs-placement="left" title="Delete ${data[1]}?"><i class="bi bi-trash"></i></a></div>`;
                                let action = `<div class="row text-center">${actShow} ${actEdit} ${actDelete}</div>`;
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
            <h3 class="block-title">Article <small><i></i></small></h3>
            <a href="{{ route('admin.article.create') }}" class="btn btn-success font-size-12"> 
                <i class="bi bi-plus-lg"></i> Add
            </a>
        </div>
        <div class="block-content block-content-full py-3">
            <table class="table table-responsive table-vcenter js-dataTable-full" id="data-table">
                <thead>
                    <tr>
                        <th class="text-center" style="vertical-align: middle;" width="5%">No</th>
                        <th class="text-center" style="vertical-align: middle;" width="45%">Title</th>
                        <th class="text-center" style="vertical-align: middle;" width="15%">Author</th>
                        <th class="text-center" style="vertical-align: middle;" width="5%">Visitor</th>
                        <th class="text-center" style="vertical-align: middle;" width="10%">Time</th>
                        <th class="text-center" style="vertical-align: middle;" width="20%">Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
@endsection
