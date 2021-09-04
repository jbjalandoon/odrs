<section class="dashboard">
<div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0">Dashboard</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
          <i class="fas fa-download fa-sm"></i> Generate Report</a>
    </div>

    <div class="row">
        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
          <div class="card pending shadow h-100 py-2">
              <div class="card-body">
                  <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                          <div class="fw-bold text-danger text-uppercase mb-1">
                              Pending Requests</div>
                          <div class="h5 mb-0 fw-bold">18</div>
                      </div>
                      <div class="col-auto">
                          <i class="fas fa-file-alt fa-2x"></i>
                      </div>
                  </div>
              </div>
          </div>
      </div>

      <!-- On process Documents -->
      <div class="col-xl-3 col-md-6 mb-4">
          <div class="card process shadow h-100 py-2">
              <div class="card-body">
                  <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                          <div class="fw-bold text-warning text-uppercase mb-1">
                              On Process Documents</div>
                          <div class="h5 mb-0 fw-bold text-gray-800">00</div>
                      </div>
                      <div class="col-auto">
                          <i class="fas fa-redo-alt fa-2x text-gray-300"></i>
                      </div>
                  </div>
              </div>
          </div>
      </div>

      <!-- Ready to Claim Documents -->
      <div class="col-xl-3 col-md-6 mb-4">
          <div class="card printed shadow h-100 py-2">
              <div class="card-body">
                  <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                          <div class="fw-bold text-info text-uppercase mb-1">
                              Ready to Claim</div>
                          <div class="h5 mb-0 fw-bold">00</div>
                      </div>
                      <div class="col-auto">
                          <i class="fas fa-print fa-2x"></i>
                      </div>
                  </div>
              </div>
          </div>
      </div>

      <!-- Completed Documents -->
      <div class="col-xl-3 col-md-6 mb-4">
          <div class="card complete shadow h-100 py-2">
              <div class="card-body">
                  <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                          <div class="fw-bold text-success text-uppercase mb-1">Completed Requests
                          </div>
                          <div class="row no-gutters align-items-center">
                              <div class="col-auto">
                                  <div class="h5 mb-0 mr-3 fw-bold">50</div>
                              </div>
                          </div>
                      </div>
                      <div class="col-auto">
                          <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>

  <div class="row">
    <!-- Activity Log -->
    <div class="col-xl-4 col-lg-5">
      <div class="card shadow mb-4 activity-log">
          <!-- Card Header - Dropdown -->
          <div class="card-header py-3">
              <h6 class="m-0 fw-bold text-primary">Activity Log</h6>
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
    </div>

    <div class="col-xl-8 col-lg-7">
        <!-- Bar Chart -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 fw-bold text-primary">Requested Documents per Month</h6>
            </div>
            <div class="card-body">
                <div class="chart-bar">
                    <canvas id="myBarChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</section>
