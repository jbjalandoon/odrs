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
  $.ajax({
    url: 'students/setup',
    type: 'get',
    dataType: 'JSON',
    success: async function(data){
      if (data.students.length != 0) {

            var steps = []
            var ctr = 0
            var courses = {}
            var questions = [{}]
            var key;
            var course;
            const values = []
            for(var i = 0; i < data.courses.length; i++) {
              key = data.courses[i][`id`]
              course = data.courses[i]['course']
              courses[key] = course
            }
            Object.keys(data.students).forEach(function(key) {
              switch (key) {
                case 'contact':
                  questions.push({
                    input: `text`,
                    title: `First Time Setup`,
                    html: `Please enter <strong>CONTACT NUMBER </strong>`,
                    showCancelButton: ctr > 0,
                    currentProgressStep: ctr,
                    preConfirm: (value) => {
                      if (value == '') {
                        Swal.showValidationMessage('First input missing')
                      }
                    }
                  })
                break;
                case 'gender':
                questions.push({
                  input: `radio`,
                  inputOptions: {
                    'm': 'Male',
                    'f': 'Female',
                  },
                  title: `First Time Setup`,
                  html: `Please enter <strong>GENDER</strong>`,
                  showCancelButton: ctr > 0,
                  currentProgressStep: ctr,
                  preConfirm: (value) => {
                    if (value == null) {
                      Swal.showValidationMessage('Please Select Gender')
                    }
                  }
                })
                break;
                case 'course_id':
                questions.push({
                  inputOptions: courses,
                  input: `select`,
                  title: `First Time Setup`,
                  html: `Please enter <strong>COURSE</strong>`,
                  showCancelButton: ctr > 0,
                  currentProgressStep: ctr,
                })
                break;
                case 'status':
                questions.push({
                  input: `radio`,
                  inputOptions: {
                    'alumni': 'Alumni',
                    'enrolled': 'Currently Enrolled',
                    'drop': 'Dropout',
                  },
                  title: `First Time Setup`,
                  html: `Please enter <strong>STATUS</strong>`,
                  showCancelButton: ctr > 0,
                  preConfirm: (value) => {
                    alert(value)
                    if (value == 'alumni') {
                      questions.push({
                        input: `text`,
                        title: `First Time Setup`,
                        html: `Please enter <strong>YEAR GRADUATED</strong>`,
                        showCancelButton: ctr > 0,
                        currentProgressStep: ctr,
                      })
                      steps.push(++ctr);
                    }
                    else if (value == 'enrolled') {
                      questions.push({
                        input: `number`,
                        title: `First Time Setup`,
                        html: `Please enter <strong>YEAR LEVEL</strong>`,
                        showCancelButton: ctr > 0,
                        currentProgressStep: ctr,
                      })
                      steps.push(++ctr);
                    }
                    else {
                      values[4] = null
                    }
                  },
                  currentProgressStep: ctr,
                })
                break;
              }
              steps.push(++ctr);
            })
            const swalQueueStep = Swal.mixin({
              confirmButtonText: 'Forward',
              allowOutsideClick: false,
              cancelButtonText: 'Back',
              progressSteps: steps,
              inputAttributes: {
                required: true
              },
              reverseButtons: true,
              validationMessage: 'This field is required'
            })

            let currentStep
            for (currentStep = 0; currentStep < steps.length;) {
              const result = await swalQueueStep.fire(questions[currentStep + 1])
              if (result.value) {
                values[currentStep] = result.value
                currentStep++
              } else if (result.dismiss === Swal.DismissReason.cancel) {
                if (ctr > 4) {
                  ctr--
                  steps.pop()
                  questions.pop()
                }
                currentStep--
              } else {
                break
              }
            }

            if (currentStep === steps.length) {
              $.ajax({
                url: 'students/setup',
                type: 'post',
                dataType: 'json',
                data: {
                  'contact' : values[0],
                  'gender' : values[1],
                  'course_id' : values[2],
                  'status' : values[3],
                  'level' : values[4],
                },
                success: function(data){
                  if (data.status == 'success') {
                    Swal.fire({
                      icon: 'success',
                      title: 'Successfully Updated',
                      text: 'Your profile has been Updated',
                    })
                  } else {
                    Swal.fire({
                      icon: 'error',
                      title: 'Oops...',
                      text: 'Something went wrong!',
                    })
                  }
                }
              })
            }
      }
    }
  });

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
// function opentab(evt, tabName) {
//   var i, tabcontent, tablinks;
//   tabcontent = document.getElementsByClassName("tabcontent");
//   for (i = 0; i < tabcontent.length; i++) {
//     tabcontent[i].style.display = "none";
//   }
//   tablinks = document.getElementsByClassName("tablinks");
//   for (i = 0; i < tablinks.length; i++) {
//     tablinks[i].className = tablinks[i].className.replace(" active", "");
//   }
//   document.getElementById(tabName).style.display = "block";
//   evt.currentTarget.className += " active";
// }

// document.getElementById("defaultOpen").click();
