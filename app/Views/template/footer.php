  
  <?php if($_SESSION['role'] == 'Students'): ?>
    <footer class="footer p-3 bg-light bg-gradient">
      <div class="container-fluid text-center align-items-center">
        <small class="text-muted">
          Gen. Santos Avenue, Lower Bicutan, Taguig City 1632; (Direct Line) 8 837-5858 to 60; (Telefax) 8 837-5859 <br>
          Website: <a href="https://www.pup.edu.ph/">www.pup.edu.ph</a> |  Email: <a href="#">taguig@pup.edu.ph</a>
        </small>
        <br>
        <strong>“THE COUNTRY’S 1ST POLYTECHNIC U”</strong>
      </div>
  <?php else: ?>
    <footer class="footer p-3 bg-transparent">
    <div class="container-fluid text-center align-items-center">
      <small class="text-muted">
        © 2021 made by - <img src="/img/logo.png" alt=""> Mitsu Tech
      </small>
    </div>
  <?php endif; ?>
        
      </footer>
    </main>
    <!-- Optional JavaScript; choose one of the two! -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.7/dist/sweetalert2.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js" charset="utf-8"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.23/sl-1.3.1/datatables.min.js"></script>
    
  


    
    <?php if($_SESSION['role'] != 'Students'): ?>
      <script src="/js/admin.js" charset="utf-8"></script>
    <?php else:?>
      <script src="/js/student.js" charset="utf-8"></script>
    <?php endif; ?>

  </body>
</html>
