<div class="container" id="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/student"><i class="fas fa-home"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Request History</li>
                  </ol>
                </nav> 
                <hr>
                <!-- <h2>Request History</h2> -->
                    <table class="table table-striped history">
                        <thead>
                            <th>Student Number</th>
                            <th>Name</th>
                            <th>Course</th>
                            <th>Document Requested</th>
                            <th>Reason</th>
                            <th>Date Requested</th>
                            <th>Date Received</th>
                        </thead>
                        <tbody>
                        <?php foreach ($request_details as $request_detail): ?>
                          <tr>
                            <td><?=esc($request_detail['student_number'])?></td>
                            <td><?=ucwords(esc($request_detail['firstname']) . ' ' . esc($request_detail['lastname']))?></td>
                            <td><?=ucwords(esc($request_detail['course']))?></td>
                            <td><?=ucwords(esc($request_detail['document']))?></td>
                            <td><?=ucwords(esc($request_detail['reason']))?></td>
                            <td><?=date('F d, Y - H:i A', strtotime(esc($request_detail['requested_at'])))?></td>
                            <td><?=date('F d, Y - H:i A', strtotime(esc($request_detail['received_at'])))?></td>
                          </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>  
                </div>                  
            </div>
        </div>
    </div>
</div>

