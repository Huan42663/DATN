@extends('admin.master')

@section('title', 'danh sách sự kiện')

@section('model', 'Event')

@section('function', 'List')

@section('content')
    <!-- [Recent Orders] start -->
    <div class="col-lg-12 mt-3">
        <div class="card stretch stretch-full">
            <div class="card-header">
                <h5 class="card-title">Recent Orders</h5>
                <div class="card-header-action">
                    <div class="card-header-btn">
                        <div data-bs-toggle="tooltip" title="Delete">
                            <a href="javascript:void(0);" class="avatar-text avatar-xs bg-danger" data-bs-toggle="remove">
                            </a>
                        </div>
                        <div data-bs-toggle="tooltip" title="Refresh">
                            <a href="javascript:void(0);" class="avatar-text avatar-xs bg-warning" data-bs-toggle="refresh">
                            </a>
                        </div>
                        <div data-bs-toggle="tooltip" title="Maximize/Minimize">
                            <a href="javascript:void(0);" class="avatar-text avatar-xs bg-success" data-bs-toggle="expand">
                            </a>
                        </div>
                    </div>
                    <div class="dropdown">
                        <a href="javascript:void(0);" class="avatar-text avatar-sm" data-bs-toggle="dropdown"
                            data-bs-offset="25, 25">
                            <div data-bs-toggle="tooltip" title="Options">
                                <i class="feather-more-vertical"></i>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a href="javascript:void(0);" class="dropdown-item"><i class="feather-at-sign"></i>New</a>
                            <a href="javascript:void(0);" class="dropdown-item"><i class="feather-calendar"></i>Event</a>
                            <a href="javascript:void(0);" class="dropdown-item"><i class="feather-bell"></i>Snoozed</a>
                            <a href="javascript:void(0);" class="dropdown-item"><i class="feather-trash-2"></i>Deleted</a>
                            <div class="dropdown-divider"></div>
                            <a href="javascript:void(0);" class="dropdown-item"><i class="feather-settings"></i>Settings</a>
                            <a href="javascript:void(0);" class="dropdown-item"><i class="feather-life-buoy"></i>Tips &
                                Tricks</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body custom-card-action p-0">
                <div class="table-responsive">
                    <a href="customers-create.html" class="btn btn-primary">
                        <i class="feather-plus me-2"></i>
                        <span>Create Event</span>
                    </a>
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Order Id</th>
                                <th>Country</th>
                                <th>Date</th>
                                <th>Company</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="hstack gap-3">
                                        <div class="avatar-image avatar-lg rounded">
                                            <img class="img-fluid" src="assets/images/gallery/4.png" alt="">
                                        </div>
                                        <div>
                                            <a href="javascript:void(0);" class="d-block">iPhone 14 Pro Max</a>
                                            <span class="fs-12 text-muted">Electronics </span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <a href="javascript:void(0);" class="d-block mb-1">Brasil</a>
                                    <span class="fs-12 text-muted d-block">Code: PH</span>
                                </td>
                                <td>
                                    <a href="javascript:void(0);" class="d-block mb-1">05/28/2020</a>
                                    <span class="fs-12 text-muted d-block">Code: Paid</span>
                                </td>
                                <td>
                                    <a href="javascript:void(0);" class="d-block mb-1">Intertico</a>
                                    <span class="fs-12 text-muted d-block">Web, UI/UX Design</span>
                                </td>
                                <td class="text-dark fw-bold">$3560</td>
                                <td>
                                    <span class="badge bg-soft-primary text-primary">Approved</span>
                                </td>
                                <td class="text-end">
                                    <div class="hstack gap-2 justify-content-end">
                                        <a href="javascript:void(0);" class="avatar-text avatar-md">
                                            <i class="feather-eye"></i>
                                        </a>
                                        <a href="javascript:void(0);" class="avatar-text avatar-md">
                                            <i class="feather-edit"></i>
                                        </a>
                                        <a href="javascript:void(0);" class="avatar-text avatar-md">
                                            <i class="feather-trash-2"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="hstack gap-3">
                                        <div class="avatar-image avatar-lg rounded">
                                            <img class="img-fluid" src="assets/images/gallery/5.png" alt="">
                                        </div>
                                        <div>
                                            <a href="javascript:void(0);" class="d-block">Canon DSLR 1230</a>
                                            <span class="fs-12 text-muted">Electronics </span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <a href="javascript:void(0);" class="d-block mb-1">Belarus</a>
                                    <span class="fs-12 text-muted d-block">Code: BY</span>
                                </td>
                                <td>
                                    <a href="javascript:void(0);" class="d-block mb-1">04/18/2021</a>
                                    <span class="fs-12 text-muted d-block">Code: Paid</span>
                                </td>
                                <td>
                                    <a href="javascript:void(0);" class="d-block mb-1">Agoda</a>
                                    <span class="fs-12 text-muted d-block">Houses &amp; Hotels</span>
                                </td>
                                <td class="text-dark fw-bold">$4850</td>
                                <td>
                                    <span class="badge bg-soft-warning text-warning">In Progress</span>
                                </td>
                                <td class="text-end">
                                    <div class="hstack gap-2 justify-content-end">
                                        <a href="javascript:void(0);" class="avatar-text avatar-md">
                                            <i class="feather-eye"></i>
                                        </a>
                                        <a href="javascript:void(0);" class="avatar-text avatar-md">
                                            <i class="feather-edit"></i>
                                        </a>
                                        <a href="javascript:void(0);" class="avatar-text avatar-md">
                                            <i class="feather-trash-2"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="hstack gap-3">
                                        <div class="avatar-image avatar-lg rounded">
                                            <img class="img-fluid" src="assets/images/gallery/3.png" alt="">
                                        </div>
                                        <div>
                                            <a href="javascript:void(0);" class="d-block">Hear Bud 202</a>
                                            <span class="fs-12 text-muted">Electronics </span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <a href="javascript:void(0);" class="d-block mb-1">Phillipines</a>
                                    <span class="fs-12 text-muted d-block">Code: BH</span>
                                </td>
                                <td>
                                    <a href="javascript:void(0);" class="d-block mb-1">07/23/2019</a>
                                    <span class="fs-12 text-muted d-block">Code: Paid</span>
                                </td>
                                <td>
                                    <a href="javascript:void(0);" class="d-block mb-1">RoadGee</a>
                                    <span class="fs-12 text-muted d-block">Transportation</span>
                                </td>
                                <td class="text-dark fw-bold">$8376</td>
                                <td>
                                    <span class="badge bg-soft-success text-success">Success</span>
                                </td>
                                <td class="text-end">
                                    <div class="hstack gap-2 justify-content-end">
                                        <a href="javascript:void(0);" class="avatar-text avatar-md">
                                            <i class="feather-eye"></i>
                                        </a>
                                        <a href="javascript:void(0);" class="avatar-text avatar-md">
                                            <i class="feather-edit"></i>
                                        </a>
                                        <a href="javascript:void(0);" class="avatar-text avatar-md">
                                            <i class="feather-trash-2"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="hstack gap-3">
                                        <div class="avatar-image avatar-lg rounded">
                                            <img class="img-fluid" src="assets/images/gallery/2.png" alt="">
                                        </div>
                                        <div>
                                            <a href="javascript:void(0);" class="d-block">Smart watch</a>
                                            <span class="fs-12 text-muted">Electronics </span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <a href="javascript:void(0);" class="d-block mb-1">Argentina</a>
                                    <span class="fs-12 text-muted d-block">Code: BR</span>
                                </td>
                                <td>
                                    <a href="javascript:void(0);" class="d-block mb-1">12/21/2021</a>
                                    <span class="fs-12 text-muted d-block">Code: Paid</span>
                                </td>
                                <td>
                                    <a href="javascript:void(0);" class="d-block mb-1">The Hill</a>
                                    <span class="fs-12 text-muted d-block">Insurance</span>
                                </td>
                                <td class="text-dark fw-bold">$9486</td>
                                <td>
                                    <span class="badge bg-soft-danger text-danger">Rejected</span>
                                </td>
                                <td class="text-end">
                                    <div class="hstack gap-2 justify-content-end">
                                        <a href="javascript:void(0);" class="avatar-text avatar-md">
                                            <i class="feather-eye"></i>
                                        </a>
                                        <a href="javascript:void(0);" class="avatar-text avatar-md">
                                            <i class="feather-edit"></i>
                                        </a>
                                        <a href="javascript:void(0);" class="avatar-text avatar-md">
                                            <i class="feather-trash-2"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="hstack gap-3">
                                        <div class="avatar-image avatar-lg rounded">
                                            <img class="img-fluid" src="assets/images/gallery/1.png" alt="">
                                        </div>
                                        <div>
                                            <a href="javascript:void(0);" class="d-block">Headphones JBL</a>
                                            <span class="fs-12 text-muted">Electronics </span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <a href="javascript:void(0);" class="d-block mb-1">Agoda</a>
                                    <span class="fs-12 text-muted d-block">Code: BT</span>
                                </td>
                                <td>
                                    <a href="javascript:void(0);" class="d-block mb-1">05/28/2020</a>
                                    <span class="fs-12 text-muted d-block">Code: Paid</span>
                                </td>
                                <td>
                                    <a href="javascript:void(0);" class="d-block mb-1">Phillipines</a>
                                    <span class="fs-12 text-muted d-block">Transportation</span>
                                </td>
                                <td class="text-dark fw-bold">$8476</td>
                                <td>
                                    <span class="badge bg-soft-primary text-primary">Approved</span>
                                </td>
                                <td class="text-end">
                                    <div class="hstack gap-2 justify-content-end">
                                        <a href="javascript:void(0);" class="avatar-text avatar-md">
                                            <i class="feather-eye"></i>
                                        </a>
                                        <a href="javascript:void(0);" class="avatar-text avatar-md">
                                            <i class="feather-edit"></i>
                                        </a>
                                        <a href="javascript:void(0);" class="avatar-text avatar-md">
                                            <i class="feather-trash-2"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                <ul class="list-unstyled d-flex align-items-center gap-2 mb-0 pagination-common-style">
                    <li>
                        <a href="javascript:void(0);"><i class="bi bi-arrow-left"></i></a>
                    </li>
                    <li><a href="javascript:void(0);" class="active">1</a></li>
                    <li><a href="javascript:void(0);">2</a></li>
                    <li>
                        <a href="javascript:void(0);"><i class="bi bi-dot"></i></a>
                    </li>
                    <li><a href="javascript:void(0);">8</a></li>
                    <li><a href="javascript:void(0);">9</a></li>
                    <li>
                        <a href="javascript:void(0);"><i class="bi bi-arrow-right"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- [Recent Orders] end -->
@endsection
