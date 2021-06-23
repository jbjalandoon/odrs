const server = location.protocol+'//'+location.hostname+(location.port ? ':'+location.port: '/')

function deleteRequest(id){
  Swal.fire({
    icon: 'warning',
    title: 'Are you sure?',
    text: "You won't be able to revert this!",
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, delete it!'
  }).then((result) =>{
    if(result.isConfirmed){
      $.ajax({
        type: 'DELETE',
        url: 'requests/delete/' + id,
        success: function(html){
          Swal.fire({
            icon: 'success',
            title: 'Successfully cancelled request'
          });
        }
      })
    }
  });;
}

$(document).ready(function() {

    $('.data-table').DataTable({
      dom: 'frtp',
    });
});

function showDetail(checkbox){
  if (checkbox.checked == true) {
    document.getElementById('qty-form-'+checkbox.id).disabled = false;

  } else {
    document.getElementById('qty-form-'+checkbox.id).disabled = true;
  }
}

function changePassword(){
  const oldPassword = $("#old_password").val();
  const newPassword = $("#new_password").val();
  const repeatPassword = $("#repeat_password").val();
  $.ajax({
    url  : 'users/edit-password',
    type : 'post',
    data : {
      'old_password' : oldPassword,
      'new_password' : newPassword,
      'repeat_password' : repeatPassword
    },
    success : function(html)
    {
      $("#passwordContainer").html(html);
      var myModal = new bootstrap.Modal(document.getElementById("passwordForm"), {});
      myModal.show();
    }
  });
}

function deleteEntry(id, url){
  $.ajax({
    url: url + '/delete',
    type: 'post',
    data: {
      id: id
    },
    success: function(html){
      $("#content").html(html);
      $('.table').DataTable({
        dom: 'frtp',
      });
    }
  });
}

function addEntry(url){
  window.history.pushState('', 'New Page Title', '/admin/' + url + '/add');
  $.ajax({
    url: url + '/add',
    type: 'get',
    success: function(html){
      $("#content").html(html);
    }
  });
}

function activateUser(id, url){
  $.ajax({
    url: url + '/activate',
    type: 'post',
    data: {
      id: id
    },
    success: function(html){
      // alert(html);
      $("#content").html(html);
      $('.table').DataTable({
        dom: 'frtp',
      });
    }
  });
}

jQuery(function ($) {
  $(".sidebar-dropdown > a").click(function() {
  $(".sidebar-submenu").slideUp(200);
  if (
    $(this)
      .parent()
      .hasClass("active")
  ) {
    $(".sidebar-dropdown").removeClass("active");
    $(this)
      .parent()
      .removeClass("active");
  } else {
    $(".sidebar-dropdown").removeClass("active");
    $(this)
      .next(".sidebar-submenu")
      .slideDown(200);
    $(this)
      .parent()
      .addClass("active");
  }

});



  // $(".sideLink").click(function(){
  //   const page = $(this).children('span').html();
  //   window.history.pushState('', 'New Page Title', '/student/' + page.replace(/\s+/g, '-').toLowerCase());
  //   const url = page.replace(/\s+/g, '-').toLowerCase();
  //   $.ajax({
  //     url: url,
  //     type : 'GET',
  //     success: function(html){
  //       $("#content").html(html);
  //       $('.table').DataTable({
  //         dom: 'frtp',
  //       });
  //     }
  //   });
  // }).hover(function(){
  //   $(this).css('cursor', 'pointer');
  // });
});

//ui tab in requests
function opentab(evt, tabName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(tabName).style.display = "block";
  evt.currentTarget.className += " active";
}

document.getElementById("defaultOpen").click();
