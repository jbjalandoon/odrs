<section id="dashboard">
    <div class="container-fluid">
        <div class="row">
            <!-- Activity Log -->
            <div class="col-xl-6 col-lg-7">
                <div class="card shadow mb-4 activity-log">
                <!-- Card Header - Dropdown -->
                    <div class="card-header py-3">
                        <h6 class="m-0 fw-bold text-dark">Activity Log</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                            <thead class="table-dark text-center">
                                <th style="width: 70%;">Activity</th>
                                <th style="width: 30%;">Date - Time</th>
                            </thead>
                            <tbody>
                                <tr>
                                <td>Confirmed one(1) pending request</td>
                                <td>1/1/21 12:00pm</td>
                                </tr>
                                <tr>
                                <td>Processed a document</td>
                                <td>1/1/21 12:00pm</td>
                                </tr>
                                <tr>
                                <td>Printed a document</td>
                                <td>1/1/21 12:00pm</td>
                                </tr>
                                <tr>
                                <td>Completed request</td>
                                <td>1/1/21 12:00pm</td>
                                </tr>
                            </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Documents Available -->
                <div class="card shadow mb-4 activity-log">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3">
                        <h6 class="m-0 fw-bold text-dark">Documents Available for Request</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                            <thead class="table-dark text-center">
                                <th>Document Name</th>
                                <th>Notes</th>
                            </thead>
                            <tbody>
                                    <tr>
                                    <td>Certificate of Good Moral</td>
                                    <td>Bring Documentary Stamp</td>
                                    </tr>
                                    <tr>
                                    <td>Certificate of Good Moral</td>
                                    <td>Bring Documentary Stamp</td>
                                    </tr>
                                    <tr>
                                    <td>Certificate of Good Moral</td>
                                    <td>Bring Documentary Stamp</td>
                                    </tr>
                                    <tr>
                                    <td>Certificate of Good Moral</td>
                                    <td>Bring Documentary Stamp</td>
                                    </tr>
                                    <tr>
                                    <td>Certificate of Good Moral</td>
                                    <td>Bring Documentary Stamp</td>
                                    </tr>
                            </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 2 cards -->
            <div class="col-xl-6 col-lg6 col-md-12 col-12 mt-6">
                <div class="row">
                    <div class="col-xl-6 col-lg6 col-md-12 col-12 mt-6">
                        <div class="card rounded-3 setup">
                            <div class="card rounded-3">
                                <!-- card body -->
                                <div class="card-body">
                                    <!-- heading -->
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h4 class="mb-0">Accounts to Setup</h4>
                                    </div>
                                    <div class="icon-shape icon-md bg-light-primary text-danger rounded-1">
                                        <i class="fas fa-users-cog fs-4"></i>
                                    </div>
                                    </div>
                                    <!-- project number -->
                                    <div>
                                    <h1 class="fw-bold">18</h1>
                                        <p class="mb-0 text-muted"><span class="me-2">2</span>Course</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg6 col-md-12 col-12 mt-6">
                        <div class="card rounded-3">
                            <div class="card rounded-3 registered">
                                <!-- card body -->
                                <div class="card-body">
                                    <!-- heading -->
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h4 class="mb-0">Registered Accounts</h4>
                                    </div>
                                    <div class="icon-shape icon-md bg-light-primary text-success rounded-1">
                                        <i class="fas fa-user-check fs-4"></i>
                                    </div>
                                    </div>
                                    <!-- project number -->
                                    <div>
                                    <h1 class="fw-bold">18</h1>
                                        <p class="mb-0 text-muted"><span class="me-2">2</span>Alumni | <span class="me-2"> 2</span>Students</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-xl-12 col-lg-12">
                        <!-- Bar Chart -->
                        <div class="card shadow mb-4 chart">
                            <div class="card-header py-3">
                                <h6 class="m-0 fw-bold text-dark">Requested Documents per Month</h6>
                            </div>
                            <div class="card-body">
                                <div class="chart-bar">
                                    <canvas id="myBarChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div> 
                </div> 
            </div>
        </div>
    </div>
</section>