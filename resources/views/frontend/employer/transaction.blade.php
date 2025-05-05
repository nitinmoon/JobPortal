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
                                <h5 class="font-weight-700 float-start text-uppercase">Transaction History</h5>
                                <a href="{{ route('companyJobPost') }}" class="site-button right-arrow button-sm float-end">Back</a>
                            </div>
                            <table>
                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Type</th>
                                        <th>Amount</th>
                                        <th>Date</th>
                                        <th>Payment Method</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="order-id text-primary">#123</td>
                                        <td class="job-name"><a href="javascript:void(0);">Social Media Expert</a></td>
                                        <td class="amount text-primary">$99.00</td>
                                        <td class="date">Dec 15,2021</td>
                                        <td class="transfer">Paypal</td>
                                        <td class="expired pending">Pending </td>
                                    </tr>
                                    <tr>
                                        <td class="order-id text-primary">#456</td>
                                        <td class="job-name"><a href="javascript:void(0);">Web Designer</a></td>
                                        <td class="amount text-primary">$199.00</td>
                                        <td class="date">Nov 10,2021</td>
                                        <td class="transfer">Bank Transfer</td>
                                        <td class="expired pending">Pending</td>
                                    </tr>
                                    <tr>
                                        <td class="order-id text-primary">#789</td>
                                        <td class="job-name"><a href="javascript:void(0);">Finance Accountant</a></td>
                                        <td class="amount text-primary">$299.00</td>
                                        <td class="date">Oct 5,2021</td>
                                        <td class="transfer">Paypal</td>
                                        <td class="expired pending">Pending </td>
                                    </tr>
                                    <tr>
                                        <td class="order-id text-primary">#101</td>
                                        <td class="job-name"><a href="javascript:void(0);">Social Media Expert</a></td>
                                        <td class="amount text-primary">$399.00</td>
                                        <td class="date">Dec 15,2021</td>
                                        <td class="transfer">Bank Transfer</td>
                                        <td class="expired success">Successfull </td>
                                    </tr>
                                    <tr>
                                        <td class="order-id text-primary">#112</td>
                                        <td class="job-name"><a href="javascript:void(0);">Web Designer</a></td>
                                        <td class="amount text-primary">$499.00</td>
                                        <td class="date">Nov 10,2021</td>
                                        <td class="transfer">Paypal</td>
                                        <td class="expired pending">Pending </td>
                                    </tr>
                                    <tr>
                                        <td class="order-id text-primary">#987</td>
                                        <td class="job-name"><a href="javascript:void(0);">Finance Accountant</a></td>
                                        <td class="amount text-primary">$599.00</td>
                                        <td class="date">Oct 5,2021</td>
                                        <td class="transfer">Bank Transfer</td>
                                        <td class="expired success">Successfull </td>
                                    </tr>
                                    <tr>
                                        <td class="order-id text-primary">#654</td>
                                        <td class="job-name"><a href="javascript:void(0);">Social Media Expert</a></td>
                                        <td class="amount text-primary">$699.00</td>
                                        <td class="date">Dec 15,2021</td>
                                        <td class="transfer">Paypal</td>
                                        <td class="expired success">Successfull </td>
                                    </tr>
                                    <tr>
                                        <td class="order-id text-primary">#321</td>
                                        <td class="job-name"><a href="javascript:void(0);">Web Designer</a></td>
                                        <td class="amount text-primary">$799.00</td>
                                        <td class="date">Nov 10,2021</td>
                                        <td class="transfer">Bank Transfer</td>
                                        <td class="expired success">Successfull </td>
                                    </tr>
                                    <tr>
                                        <td class="order-id text-primary">#569</td>
                                        <td class="job-name"><a href="javascript:void(0);">Finance Accountant</a></td>
                                        <td class="amount text-primary">$899.00</td>
                                        <td class="date">Oct 5,2021</td>
                                        <td class="transfer">Paypal</td>
                                        <td class="expired pending">Pending </td>
                                    </tr>
                                    <tr>
                                        <td class="order-id text-primary">#563</td>
                                        <td class="job-name"><a href="javascript:void(0);">Web Designer</a></td>
                                        <td class="amount text-primary">$999.00</td>
                                        <td class="date">Nov 10,2021</td>
                                        <td class="transfer">Bank Transfer</td>
                                        <td class="expired success">Successfull </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="pagination-bx float-end">
                                <ul class="pagination">
                                    <li class="previous"><a href="javascript:void(0);"><i class="ti-arrow-left"></i> Prev</a></li>
                                    <li class="active"><a href="javascript:void(0);">1</a></li>
                                    <li><a href="javascript:void(0);">2</a></li>
                                    <li><a href="javascript:void(0);">3</a></li>
                                    <li class="next"><a href="javascript:void(0);">Next <i class="ti-arrow-right"></i></a></li>
                                </ul>
                            </div>
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