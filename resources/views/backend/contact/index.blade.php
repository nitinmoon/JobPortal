@extends('backend.layouts.app')
@section('title', 'Contacts')
@section('content')
<div class="pagetitle">
    <h1>Contacts List</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Contacts</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section dashboard">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body mt-2">
                    <div class="datatable-wrapper datatable-loading no-footer sortable searchable fixed-columns">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered datatable contact-table" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th style="min-width:50px;">Sr No</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Message</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
@section('script')
<script>
    $(function() {
        var table = $('.contact-table').DataTable({
            "aaSorting": [],
            processing: true,
            serverSide: true,
            pageLength: 100,
            "bDestroy": true,
            ajax: {
                url: "{{ route('contactsList') }}",
                beforeSend: function() {
                    $('#preloader').show();
                },
                data: function(param) {
                    // param.job_category_id = $("#job_category_id").val();
                    // param.job_type_id = $("#job_type_id").val();
                    // param.deleted = $("#deleted").val();
                    // param.status = $("#status").val();
                },
                complete: function() {
                    $('#preloader').hide();
                }
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'message',
                    name: 'message'
                },
            ]
        });
    });
</script>
@endsection