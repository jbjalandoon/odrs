    <!-- <footer class="footer mt-4 bg-light d-flex">
      <div class="container text-center align-items-center">
        <span class="text-muted">
          © 2021 made with <i class="fa fa-heart" style="color:red"></i> by - Mitsu Tech
        </span>
      </div>
    </footer>
    Optional JavaScript; choose one of the two!
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    Option 1: Bootstrap Bundle with Popper
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

    Option 2: Separate Popper and Bootstrap JS
    <
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
    -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

    <script type="text/javascript">
      function requestPassword(){
        const email = $("#email").val();
        $.ajax({
          url  : 'request-password',
          type : 'post',
          dataType: 'json',
          data : {
            'email' : email,
          },
          success : function(html)
          {
            console.log(html)
            if (html['status']) {
              alert('Password successfully sent to your email')
            } else {
              alert('Email not found!')
            }
            location.reload()
          }
        });
      }
    </script>
  </body>
</html>
