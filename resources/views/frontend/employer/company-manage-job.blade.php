@extends('frontend.layouts.app')

@section('title', 'Home')

@section('content')
<div class="page-content">
    <div class="content-block">
        <!-- Browse Jobs -->
        <div class="section-full bg-white p-t50 p-b20">
            <div class="container">
                <div class="row">
                    <div class="col-xl-3 col-lg-4 m-b30">
                        <div class="sticky-top">
                            @include('frontend.employer.sidebar')
                        </div>
                    </div>
                    <div class="col-xl-9 col-lg-8 m-b30">
                        <div class="job-bx submit-resume">
                            <div class="job-bx-title clearfix">
                                <h5 class="font-weight-700 float-start text-uppercase">Manage jobs</h5>
                                <div class="float-end">
                                    <span class="select-title">Sort by freshness</span>
                                    <select>
                                        <option>All</option>
                                        <option>None</option>
                                        <option>Read</option>
                                        <option>Unread</option>
                                        <option>Starred</option>
                                        <option>Unstarred</option>
                                    </select>
                                </div>
                            </div>
                            <table class="table-job-bx cv-manager company-manage-job">
                                <thead>
                                    <tr>
                                        <th class="feature">
                                            <div class="form-check">
                                                <input type="checkbox" id="check12" class="form-check-input selectAllCheckBox" name="example1">
                                                <label class="form-check-label" for="check12"></label>
                                            </div>
                                        </th>
                                        <th>Job Title</th>
                                        <th>Applications</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="feature">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="check1" name="example1">
                                                <label class="form-check-label" for="check1"></label>
                                            </div>
                                        </td>
                                        <td class="job-name">
                                            <a href="javascript:void(0);">Social Media Expert</a>
                                            <ul class="job-post-info">
                                                <li><i class="fas fa-map-marker-alt"></i> Sacramento, California</li>
                                                <li><i class="far fa-bookmark"></i> Full Time</li>
                                                <li><i class="fa fa-filter"></i> Web Designer</li>
                                            </ul>
                                        </td>
                                        <td class="application text-primary">(5) Applications</td>
                                        <td class="expired pending">Pending </td>
                                        <td class="job-links">
                                            <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#exampleModalLong">
                                                <i class="fa fa-eye"></i></a>
                                            <a href="javascript:void(0);"><i class="ti-trash"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="feature">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="check2" name="example1">
                                                <label class="form-check-label" for="check2"></label>
                                            </div>
                                        </td>
                                        <td class="job-name">
                                            <a href="javascript:void(0);">Web Designer</a>
                                            <ul class="job-post-info">
                                                <li><i class="fas fa-map-marker-alt"></i> Sacramento, California</li>
                                                <li><i class="far fa-bookmark"></i> Full Time</li>
                                                <li><i class="fa fa-filter"></i> Web Designer</li>
                                            </ul>
                                        </td>
                                        <td class="application text-primary">(8) Applications</td>
                                        <td class="expired text-red">Expired</td>
                                        <td class="job-links">
                                            <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#exampleModalLong">
                                                <i class="fa fa-eye"></i></a>
                                            <a href="javascript:void(0);"><i class="ti-trash"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="feature">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="check3" name="example1">
                                                <label class="form-check-label" for="check3"></label>
                                            </div>
                                        </td>
                                        <td class="job-name">
                                            <a href="javascript:void(0);">Finance Accountant</a>
                                            <ul class="job-post-info">
                                                <li><i class="fas fa-map-marker-alt"></i> Sacramento, California</li>
                                                <li><i class="far fa-bookmark"></i> Full Time</li>
                                                <li><i class="fa fa-filter"></i> Web Designer</li>
                                            </ul>
                                        </td>
                                        <td class="application text-primary">(9) Applications</td>
                                        <td class="expired pending">Pending </td>
                                        <td class="job-links">
                                            <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#exampleModalLong">
                                                <i class="fa fa-eye"></i></a>
                                            <a href="javascript:void(0);"><i class="ti-trash"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="feature">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="check4" name="example1">
                                                <label class="form-check-label" for="check4"></label>
                                            </div>
                                        </td>
                                        <td class="job-name">
                                            <a href="javascript:void(0);">Social Media Expert</a>
                                            <ul class="job-post-info">
                                                <li><i class="fas fa-map-marker-alt"></i> Sacramento, California</li>
                                                <li><i class="far fa-bookmark"></i> Full Time</li>
                                                <li><i class="fa fa-filter"></i> Web Designer</li>
                                            </ul>
                                        </td>
                                        <td class="application text-primary">(7) Applications</td>
                                        <td class="expired success">Active </td>
                                        <td class="job-links">
                                            <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#exampleModalLong">
                                                <i class="fa fa-eye"></i></a>
                                            <a href="javascript:void(0);"><i class="ti-trash"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="feature">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="check5" name="example1">
                                                <label class="form-check-label" for="check5"></label>
                                            </div>
                                        </td>
                                        <td class="job-name">
                                            <a href="javascript:void(0);">Web Designer</a>
                                            <ul class="job-post-info">
                                                <li><i class="fas fa-map-marker-alt"></i> Sacramento, California</li>
                                                <li><i class="far fa-bookmark"></i> Full Time</li>
                                                <li><i class="fa fa-filter"></i> Web Designer</li>
                                            </ul>
                                        </td>
                                        <td class="application text-primary">(6) Applications</td>
                                        <td class="expired pending">Pending </td>
                                        <td class="job-links">
                                            <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#exampleModalLong">
                                                <i class="fa fa-eye"></i></a>
                                            <a href="javascript:void(0);"><i class="ti-trash"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="feature">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="check6" name="example1">
                                                <label class="form-check-label" for="check6"></label>
                                            </div>
                                        </td>
                                        <td class="job-name">
                                            <a href="javascript:void(0);">Finance Accountant</a>
                                            <ul class="job-post-info">
                                                <li><i class="fas fa-map-marker-alt"></i> Sacramento, California</li>
                                                <li><i class="far fa-bookmark"></i> Full Time</li>
                                                <li><i class="fa fa-filter"></i> Web Designer</li>
                                            </ul>
                                        </td>
                                        <td class="application text-primary">(3) Applications</td>
                                        <td class="expired text-red">Expired</td>
                                        <td class="job-links">
                                            <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#exampleModalLong">
                                                <i class="fa fa-eye"></i></a>
                                            <a href="javascript:void(0);"><i class="ti-trash"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="feature">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="check7" name="example1">
                                                <label class="form-check-label" for="check7"></label>
                                            </div>
                                        </td>
                                        <td class="job-name">
                                            <a href="javascript:void(0);">Social Media Expert</a>
                                            <ul class="job-post-info">
                                                <li><i class="fas fa-map-marker-alt"></i> Sacramento, California</li>
                                                <li><i class="far fa-bookmark"></i> Full Time</li>
                                                <li><i class="fa fa-filter"></i> Web Designer</li>
                                            </ul>
                                        </td>
                                        <td class="application text-primary">(2) Applications</td>
                                        <td class="expired success">Active </td>
                                        <td class="job-links">
                                            <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#exampleModalLong">
                                                <i class="fa fa-eye"></i></a>
                                            <a href="javascript:void(0);"><i class="ti-trash"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="feature">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="check8" name="example1">
                                                <label class="form-check-label" for="check8"></label>
                                            </div>
                                        </td>
                                        <td class="job-name">
                                            <a href="javascript:void(0);">Web Designer</a>
                                            <ul class="job-post-info">
                                                <li><i class="fas fa-map-marker-alt"></i> Sacramento, California</li>
                                                <li><i class="far fa-bookmark"></i> Full Time</li>
                                                <li><i class="fa fa-filter"></i> Web Designer</li>
                                            </ul>
                                        </td>
                                        <td class="application text-primary">(4) Applications</td>
                                        <td class="expired success">Active </td>
                                        <td class="job-links">
                                            <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#exampleModalLong">
                                                <i class="fa fa-eye"></i></a>
                                            <a href="javascript:void(0);"><i class="ti-trash"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="feature">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="check9" name="example1">
                                                <label class="form-check-label" for="check9"></label>
                                            </div>
                                        </td>
                                        <td class="job-name">
                                            <a href="javascript:void(0);">Finance Accountant</a>
                                            <ul class="job-post-info">
                                                <li><i class="fas fa-map-marker-alt"></i> Sacramento, California</li>
                                                <li><i class="far fa-bookmark"></i> Full Time</li>
                                                <li><i class="fa fa-filter"></i> Web Designer</li>
                                            </ul>
                                        </td>
                                        <td class="application text-primary">(1) Applications</td>
                                        <td class="expired text-red">Expired</td>
                                        <td class="job-links">
                                            <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#exampleModalLong">
                                                <i class="fa fa-eye"></i></a>
                                            <a href="javascript:void(0);"><i class="ti-trash"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="feature">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="check10" name="example1">
                                                <label class="form-check-label" for="check10"></label>
                                            </div>
                                        </td>
                                        <td class="job-name">
                                            <a href="javascript:void(0);">Web Designer</a>
                                            <ul class="job-post-info">
                                                <li><i class="fas fa-map-marker-alt"></i> Sacramento, California</li>
                                                <li><i class="far fa-bookmark"></i> Full Time</li>
                                                <li><i class="fa fa-filter"></i> Web Designer</li>
                                            </ul>
                                        </td>
                                        <td class="application text-primary">(1) Applications</td>
                                        <td class="expired success">Active </td>
                                        <td class="job-links">
                                            <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#exampleModalLong">
                                                <i class="fa fa-eye"></i></a>
                                            <a href="javascript:void(0);"><i class="ti-trash"></i></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="pagination-bx m-t30 float-end">
                                <ul class="pagination">
                                    <li class="previous"><a href="javascript:void(0);"><i class="ti-arrow-left"></i> Prev</a></li>
                                    <li class="active"><a href="javascript:void(0);">1</a></li>
                                    <li><a href="javascript:void(0);">2</a></li>
                                    <li><a href="javascript:void(0);">3</a></li>
                                    <li class="next"><a href="javascript:void(0);">Next <i class="ti-arrow-right"></i></a></li>
                                </ul>
                            </div>
                            <!-- Modal -->
                            <div class="modal fade modal-bx-info" id="exampleModalLong" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <div class="logo-img">
                                                <img alt="" src="images/logo/icon2.png">
                                            </div>
                                            <h5 class="modal-title">Company Name</h5>
                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <ul>
                                                <li><strong>Job Title :</strong>
                                                    <p> Web Developer – PHP, HTML, CSS </p>
                                                </li>
                                                <li><strong>Experience :</strong>
                                                    <p>5 Year 3 Months</p>
                                                </li>
                                                <li><strong>Deseription :</strong>
                                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry has been the industry's standard dummy text ever since.</p>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal End -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Browse Jobs END -->
    </div>
</div>
@endsection
@section('script')
<script>
    $(function() {});
</script>
@endsection