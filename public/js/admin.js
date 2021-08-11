var server = location.protocol+'//'+location.hostname+(location.port ? ':'+location.port: '/');
script();

function showCheckbox(){
  $('.assigned-role').addClass('d-none')
  $('.edit-button').addClass('d-none')
  $('.checkbox').removeClass('d-none')
  $('.cancel-button').removeClass('d-none')
  $('#submit').removeClass('d-none')
}

function cancelCheckbox(){
  $('.assigned-role').removeClass('d-none')
  $('.edit-button').removeClass('d-none')
  $('.checkbox').addClass('d-none')
  $('.cancel-button').addClass('d-none')
  $('#submit').addClass('d-none')
}

const showLoading = function() {
  let timerInterval
  Swal.fire({
    title: 'Loading!',
    html: ' Please Wait',
    allowOutsideClick: false,
    timerProgressBar: true,
    didOpen: () => {
      Swal.showLoading()
    },
  })
};


var adminPendingTable = $('#admin-pending-table').DataTable({
  "columnDefs" : [{
    "targets" : [0],
    "visible" : false,
    "searchable" : false,
  }],
  "bPaginate": true,
  "bLengthChange": false,
  "bFilter": true,
  "bInfo": false,
  "bAutoWidth": false,
  "dom": '<"row"<"col-6"<"select-pending mb-3">><"col-6"f>>t<"row"<"col-6"<"action-pending mt-3">><"col-6 float-end mt-3"p>>',
  fnInitComplete: function(){
      $('div.select-pending').html('<span class="h2"> Pending Request </span>');
      $('div.action-pending').html('<button onClick="confirmSelect()" class="btn btn-primary">Confirm Selected</button>');
    }
});


$('#admin-pending-table tbody').on( 'click', 'tr', function () {
  $(this).toggleClass('selected');
});

function confirmSelect()
{
  Swal.fire({
    title: 'Are you sure?',
    text: "You won't be able to revert this!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes'
  }).then((result) => {
    if(result.isConfirmed){
      const data = [];
      for (var i = 0; i < adminPendingTable.rows('.selected').data().length; i++) {
        data.push(adminPendingTable.rows('.selected').data()[i]);
      }
    // alert(data);
      $.ajax({
        type: "POST",
        data: {data},
        url: "document-requests/request-confirm",
        beforeSend: function(){
          showLoading();
        },
        success: function(response){
          swal.close()
          Swal.fire({
            icon: 'success',
            title: 'Successfuly Approved',
          }).then(function(){
            location.reload()
          })
        },
        error: function (request, error) {
          swal.close()
          Swal.fire({
            icon: 'error',
            title: 'Something went wrong!'
          }).then(function(){
            location.reload()
          })
          // location.reload()
        },
      });
    }
  });
}

function denyRequest(id, student_number)
{
  Swal.fire({
    title: 'Are you sure?',
    text: "You won't be able to revert this!",
    icon: 'warning',
    input: 'textarea',
    inputLabel: 'Remark',
    inputPlaceholder: 'Type your message here...',
    inputAttributes: {
      'aria-label': 'Type your message here'
    },
    showCancelButton: true,
    confirmButtonText: 'Yes, deny it!'
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        type: 'POST',
        url: 'document-requests/deny-request',
        data: {
          'id' : id,
          'remark' : result.value,
          'student_number' : student_number
        },
        success: function(html){
          Swal.close();
          Swal.fire({
            'icon': 'success',
            'title' : 'Successfully Denied',
          });
          location.reload()
        }
      });
    }
  });
}

var approvalTable = $('#approval-table').DataTable({
  "columnDefs" : [{
    "targets" : [0,1],
    "visible" : false,
    "searchable" : false,
  }],
  "bPaginate": true,
  "bLengthChange": false,
  "bFilter": true,
  "bInfo": false,
  "bAutoWidth": false,
  "dom": '<"row"<"col-6"<"select mb-3">><"col-6"f>>t<"row"<"col-6"<"action mt-3">><"col-6 mt-3 float-end"p>>',
  fnInitComplete: function(){
      $('div.select').html('<span class="h2"> For Approval </span>');
      $('div.action').html('<button onclick="approveSelect()" id="approve-selected" class="btn btn-primary">Approve Selected</button>');
    }
});

var onHoldTable = $('#on-hold-table').DataTable({
  "columnDefs" : [{
    "targets" : [0,1],
    "visible" : false,
    "searchable" : false,
  }],
  "bPaginate": true,
  "bLengthChange": false,
  "bFilter": true,
  "bInfo": false,
  "bAutoWidth": false,
  "dom": '<"row"<"col-6"<"select-hold mb-3">><"col-6"f>>t<"row"<"col-6"<"action-hold mt-3">><"col-6 mt-3 float-end"p>>',
  fnInitComplete: function(){
      $('div.select-hold').html('<span class="h2"> On Hold Requests </span>');
      $('div.action-hold').html('<button onclick="approveSelect()" id="approve-selected" class="btn btn-primary">Approve Selected</button>');
    }
});

$('#approval-table tbody').on ('click', 'tr', function(){
  $(this).toggleClass('selected');
});

$('#on-hold-table').on ('click', 'tr', function(){
  $(this).toggleClass('selected');
});

function approveSelect()
{
  Swal.fire({
    title: 'Are you sure?',
    text: "You won't be able to revert this!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Yes'
  }).then((result) => {
    if(result.isConfirmed){
      const data = [];
      for (var i = 0; i < approvalTable.rows('.selected').data().length; i++) {
        data.push(approvalTable.rows('.selected').data()[i]);
      }
      for (var i = 0; i < onHoldTable.rows('.selected').data().length; i++) {
        data.push(onHoldTable.rows('.selected').data()[i]);
      }
      $.ajax({
        type: "POST",
        data: {data},
        url: "approval/approve",
        beforeSend: function(){
          showLoading();
        },
        success: function(response){
          swal.close()
          Swal.fire({
            icon: 'success',
            title: 'Successfuly Approved',
          })
          location.reload()
        },
        error: function (request, error) {
          swal.close()
          Swal.fire({
            icon: 'error',
            title: 'Something went wrong!'
          })
          // location.reload()
        },
      });
    }
  });
}

function holdRequest(id, student_number, detail_id)
{
  Swal.fire({
    icon: 'warning',
    title: 'Are you sure?',
    text: 'You wont be able to revert this!',
    input: 'textarea',
    inputLabel: 'Remark',
    inputPlaceholder: 'Type your message here...',
    inputAttributes: {
      'aria-label': 'Type your message here'
    },
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, hold it!'
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        type: 'POST',
        url: 'approval/hold',
        data: {
          'id' : id,
          'remark' : result.value,
          'student_number' : student_number,
          'request_detail_id': detail_id
        },
        beforeSend: function(){
          Swal.close()
          showLoading();
        },
        success: function(html){
          Swal.close();
          Swal.fire({
            'icon': 'success',
            'title' : 'Successfully Hold the request',
          });
        },
        error: function (request, error) {
          swal.close()
          Swal.fire({
            icon: 'error',
            title: 'Something went wrong!'
          })
        },

      });
    }
  });
}

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

var onProcessTable = $('#process-table').DataTable({
  "columnDefs" : [{
    "targets" : [0,1],
    "visible" : false,
    "searchable" : false,
  }],
  "bPaginate": true,
  "bLengthChange": false,
  "bFilter": true,
  "bInfo": false,
  "bAutoWidth": false,
  "dom": '<"row"<"col-6"<"select mb-3">><"col-6"f>>t<"row"<"col-6"<"action mt-3">><"col-6 float-end mt-3"p>>',
  fnInitComplete: function(){
      $('div.select').html('<span class="h2"> On Process Documents </span>');
      // $('div.action').html('<button onClick="printRequest()" id="process-selected" class="btn btn-primary">Process Complete</button>');
    }
});

var processedTable = $('#processed-table').DataTable({
  "bPaginate": true,
  "bLengthChange": false,
  "bFilter": true,
  "bInfo": false,
  "bAutoWidth": false,
  "dom": '<"row"<"col-6"<"select mb-3">><"col-6"f>>t<"row"<"col-6"<"action mt-3">><"col-6 float-end mt-3"p>>',
  fnInitComplete: function(){
      $('div.select').html('<span class="h2"> Ready to Claim Documents </span>');
      // $('div.action').html('<button onClick="printRequest()" id="process-selected" class="btn btn-primary">Process Complete</button>');
    }
});

async function printRequest(id, per_page, template, email)
{
  if(template == null && per_page == 0){
    Swal.fire({
      icon: 'warning',
      title: 'This request will mark as printed.',
      showCancelButton: true,
      html: `You will not be able to undo the action`,
      confirmButtonText: `Confirm`,
    }).then((result) => {
      /* Read more about isConfirmed, isDenied below */
      if (result.isConfirmed) {
        $.ajax({
          type: "POST",
          data: {
            'id': id,
            'email': email
          },
          url: "on-process-document/print-requests",
          beforeSend: function(){
            Swal.close()
            showLoading();
          },
          success: function(html){
            Swal.close();
            Swal.fire({
              'icon': 'success',
              'title' : 'Successfully mark as printed',
            }).then(function(){
              location.reload()
            })
          },
          error: function (request, error) {
            swal.close()
            Swal.fire({
              icon: 'error',
              title: 'Something went wrong!'
            }).then(function(){
              location.reload()
            })
          },
        });
      }
    })
  } else {
    if (template != null && per_page == 0) {
      Swal.fire({
        icon: 'warning',
        title: 'This request will mark as printed.',
        showCancelButton: true,
        html: `You will not be able to undo the action <br><small>(This document has a template)</small> <br><a href='`+server+`/document-requests/`+template+`/`+id+`' target="_blank">CLICK HERE TO DOWNLOAD</a>`,
        confirmButtonText: `Confirm`,
      }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
          $.ajax({
            type: "POST",
            data: {
              'id': id,
              'email': email
            },
            url: "on-process-document/print-requests",
            beforeSend: function(){
              Swal.close()
              showLoading();
            },
            success: function(html){
              Swal.close();
              Swal.fire({
                'icon': 'success',
                'title' : 'Successfully mark as printed',
              }).then(function(){
                location.reload()
              })
            },
            error: function (request, error) {
              swal.close()
              Swal.fire({
                icon: 'error',
                title: 'Something went wrong!'
              }).then(function(){
                location.reload()
              })
            },
          });
        }
      })
    } else {
      Swal.fire({
        title: 'Please Upload a File',
        icon: 'warning',
        html: `<form method='post' id='form' enctype='multipart/form-data'><input type='hidden' name='email' value=`+email+`><input type='hidden' name='id' value=`+id+`><input type='file' name='file' id='file' class='form-control' accept='application/pdf' required></form> <Br>`,
        showCancelButton: true,
        confirmButtonText: `Confirm`,
        preConfirm: () => {
          if (document.getElementById("file").files.length != 0) {
            var filePath = document.getElementById("file").value;
              // Allowing file type
            var allowedExtensions = /(\.pdf)$/i;
            if (allowedExtensions.exec(filePath)) {
              return [
                 document.getElementById('file').value
              ]
            } else {
              Swal.showValidationMessage('Wrong Format!')

            }
          } else {
            Swal.showValidationMessage('Missing!')
          }
        }
      }).then((result) => {
        if (result.isConfirmed) {
          data = new FormData(document.getElementById('form'))
          Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes,'
          }).then((result) => {
            if (result.isConfirmed) {
              $.ajax({
                url: `on-process-document/print-requests`,
                type: `POST`,
                data: data,
                contentType: false,
                processData:false,
                beforeSend: function(){
                  Swal.close()
                  showLoading();
                },
                success: function(resp){
                  console.log(resp);
                  Swal.fire({
                    title: 'Upload Sucess',
                    text: "Page: " + resp,
                    icon: 'success',
                    confirmButtonText: 'Ok'
                  }).then((result) => {
                    if (result.isConfirmed) {
                      location.reload();
                    }
                  })
                },
                error: function (request, error) {
                  swal.close()
                  Swal.fire({
                    icon: 'error',
                    title: 'Something went wrong!'
                  }).then(function(){
                    location.reload()
                  })
                },
              });
            }
          })
        }
      })
    }

  }

  // const data = [];
  // const steps = [];
  // for (var i = 0; i < onProcessTable.rows('.selected').data().length; i++) {
  //   data.push(onProcessTable.rows('.selected').data()[i]);
  //   steps.push(i+1);
  // }
  // const swalQueueStep = Swal.mixin({
  //   showCancelButton: true,
  //   allowOutsideClick: false,
  //   confirmButtonText: 'Next',
  //   cancelButtonText: 'Cancel',
  //   progressSteps: steps,
  //   input: 'file',
  //   inputAttributes: {
  //     required: true,
  //     accept: 'application/pdf',
  //   },
  //   inputPlaceholder: "Insert File to determine the page",
  //   reverseButtons: false,
  //   validationMessage: 'This field is required'
  // });
  // const values = []
  // let currentStep
  //
  // for (currentStep = 0; currentStep < steps.length;) {
  //   const result = await swalQueueStep.fire({
  //     title: data[currentStep][3] + ' - (' + data[currentStep][2] + ')',
  //     text: data[currentStep][5],
  //     showCancelButton: true,
  //     currentProgressStep: currentStep
  //   })
  //
  //   if (result.value) {
  //       values[currentStep] = result.value
  //       currentStep++
  //     } else if (result.dismiss === Swal.DismissReason.cancel) {
  //       currentStep--
  //     } else {
  //       break
  //     }
  // }
  // $.ajax({
  //   type: "POST",
  //   data: {
  //     'data': data,
  //     'pages':values,
  //   },
  //   url: "on-process-document/print-requests",
  //   success: function(msg){
  //     Swal.close();
  //     Swal.fire({
  //       'icon': 'success',
  //       'title' : 'Successfully Processed',
  //     }).then(function(){
  //       location.reload();
  //     });
  //   },
  //   error: function (request, error) {
  //     // console.log(arguments);
  //     alert(" Can't do because: " + error);
  //   },
  // });
}

// $('#process-table tbody').on( 'click', 'tr', function () {
//   $(this).toggleClass('selected');
// });

$("#slug").keypress(function (e){
  if(e.which == 13){
    const slug = $("#slug").val();
    $.ajax({
      type: 'GET',
      data:{
        'slug': slug
      },
      url: 'printed-requests/get-printed',
      success: function(data){
        var form = '';
        const requests = JSON.parse(data);
        var value = [];
        var request_id;
        for(var i = 0; i < requests.length; i++) {
          console.log(requests[i]);
          request_id = requests[i]['request_id']
          form += `<div class="form-check">
                    <input class="form-check-input" type="checkbox" value="`+requests[i]['id']+`" id="id-`+requests[i]['id']+`">
                    <label class="form-check-label" for="id-`+requests[i]['id']+`">
                      `+requests[i]['document']+`
                    </label>
                  </div>`;
        }
        Swal.fire({
          title: 'Receive Request',
          icon: 'question',
          html: '<small>Select document that will be receive</small><br>' + form,
          text: 'Select the document that will be received',
          preConfirm: () => {
            for(var i = 0; i < requests.length; i++) {
              if(Swal.getPopup().querySelector(`#id-`+requests[i]['id']).checked){
                value.push(Swal.getPopup().querySelector(`#id-`+requests[i]['id']).value);
              }
            }
            return value;
          }
        }).then((result) =>{
          $.ajax({
            url: 'printed-requests/scan',
            type: 'POST',
            data: {'value': value, 'request_id': request_id},
            beforeSend: function(){
              Swal.close()
              showLoading();
            },
            success: function(resp){
              Swal.fire({
                title: 'Sucessfully received',
                icon: 'success',
              }).then((result) => {
                  location.reload();
              })
            },
            error: function (request, error) {
              swal.close()
              Swal.fire({
                icon: 'error',
                title: 'Something went wrong!'
              }).then(function(){
                location.reload()
              })
            },
          });
        });
        console.log(JSON.parse(data));
      }
    });
  }
});


$(document).ready(function(){

  $(".permissions-data").each(function(){
    var element = $(this);
    $.ajax({
      url : 'role-permissions/retrieve',
      type: 'get',
      data: {id: $(this).attr("id")},
      beforeSend: function(){
        element.html('Fetching Data...');
      },
      success: function(html){
        console.log(html);
        element.html(html);
      },
      error: function (xhr, ajaxOptions, thrownError) {
        alert(xhr.responseText);
        alert(thrownError);
      }
    });
  });

  $(".document-notes").each(function(){
    var element = $(this);
    $.ajax({
      url : 'documents/notes',
      type: 'get',
      data: {id: $(this).attr("id")},
      beforeSend: function(){
        element.html('Fetching Data...');
      },
      success: function(html){
        element.html(html);
      },
      error: function (xhr, ajaxOptions, thrownError) {
        alert(xhr.responseText);
        alert(thrownError);
      }
    });
  });

  $(".document-requirements").each(function(){
    var element = $(this);
    $.ajax({
      url : 'documents/requirements',
      type: 'get',
      data: {id: $(this).attr("id")},
      beforeSend: function(){
        element.html('Fetching Data...');
      },
      success: function(html){
        element.html(html);
      },
      error: function (xhr, ajaxOptions, thrownError) {
        alert(xhr.responseText);
        alert(thrownError);
      }
    });
  });
});

function filterClaimeds(){
  var documentID = $('#documents').val();
  $.ajax({
    url : 'claimed-requests/filter',
    type: 'get',
    data: {document_id: documentID},
    success: function(html){
      $("#claimedRequest").html(html);
      $('.dataTable').DataTable({
        pageLength: 9,
        dom: 'frtp',
      });
    }
  });
}

function displayPermissions(id){
  $.ajax({
    url: 'getPermissions',
    type: 'get',
    data: {id: id},
    success: function(html){
      $(this).html(html);
      script();
    }
  });
}

function script(){
  $('.dataTable').DataTable({
    pageLength: 9,
    dom: 'frtp',
  });

    $(".js-example-responsive").select2({
  });

  $(".documents-tag").select2({
    tags: true
  });

  $('#type').change(function(){
    var type = 'yearly';
    if ($('#type').val() == 'monthly') {
      type = 'month';
    } else if ($('#type').val() == 'yearly'){
      type = 'text';
    } else {
      type = 'date';
    }
    $('#argument').attr('type', type);
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

$(".sideLink").click(function(){
  const page = $(this).children('span').html();
  window.history.pushState('', 'New Page Title', '/admin/' + page.replace(/\s+/g, '-').toLowerCase());
  const url = page.replace(/\s+/g, '-').toLowerCase();
  $.ajax({
    url: url,
    type : 'GET',
    success: function(html){
      $("#content").html(html);
      script();
    }
  });
}).hover(function(){
  $(this).css('cursor', 'pointer');
});

function filterPermission(){
  const moduleID = $('#module').val();
  const typeID = $('#type').val();
  $.ajax({
    url : 'permissions/filter',
    type: 'get',
    data: {module_id: moduleID, type_id: typeID},
    success: function(html){
      $('#permission-table').html(html);
      script();
    }
  });
}

function insertSpreadsheet(){
  var fd = new FormData();
  var files = $('#file')[0].files;
  if(files.length > 0 ){
     fd.append('students',files[0]);
     $.ajax({
        url: 'students/insert-spreadsheet',
        type: 'post',
        data: fd,
        dataType: 'json',
        contentType: false,
        processData: false,
        beforeSend: function(){
          showLoading();
        },
        success: function(response){
          swal.close()
          console.log(response)
          Swal.fire({
            icon: response['status'],
            title: response['message'],
            html: 'To be insert: ' + response['insert_count'] + '<br> Succesfully inserted: ' + response['inserted_count'] + '<br> Existing Data: ' + response['exisiting_count']
          })
        },
        error: function (request, error) {
          swal.close()
          Swal.fire({
            icon: 'error',
            title: 'Something went wrong!'
          })
        },
     });
  }else{
     alert("Please select a file.");
  }

}

function filterProcessDocument(){
  var documentID = $('#document').val();
  $.ajax({
    url : 'on-process-document/filter',
    type: 'get',
    data: {document_id: documentID},
    success: function(html){
      $('#processTable').html(html);
      $('#process-table').DataTable({
        "columnDefs" : [{
          "targets" : [0,1],
          "visible" : false,
          "searchable" : false,
        }],
        "bPaginate": true,
        "bLengthChange": false,
        "bFilter": true,
        "bInfo": false,
        "bAutoWidth": false,
        "dom": '<"row"<"col-6"<"select mb-3">><"col-6"f>>t<"row"<"col-6"<"action mt-3">><"col-6 float-end mt-3"p>>',
        fnInitComplete: function(){
            $('div.select').html('<span class="h2"> On Process Documents </span>');
            // $('div.action').html('<button onClick="printRequest()" id="process-selected" class="btn btn-primary">Process Complete</button>');
          }
      });
    }
  });
}

function filterPrintedDocument(){
  var documentID = $('#document').val();
  $.ajax({
    url : 'printed-requests/filter',
    type: 'get',
    data: {document_id: documentID},
    success: function(html){
      $('#processedTable').html(html);
      $('#processed-table').DataTable({
        "bPaginate": true,
        "bLengthChange": false,
        "bFilter": true,
        "bInfo": false,
        "bAutoWidth": false,
        "dom": '<"row"<"col-6"<"select mb-3">><"col-6"f>>t<"row"<"col-6"<"action mt-3">><"col-6 float-end mt-3"p>>',
        fnInitComplete: function(){
            $('div.select').html('<span class="h2"> Ready to Claim Documents </span>');
            // $('div.action').html('<button onClick="printRequest()" id="process-selected" class="btn btn-primary">Process Complete</button>');
          }
      });
    }
  });
}

function showOfficerForm(){
  if ($("#role_id").val() == 5) {
    $('#officeForm').show();
  } else {
    $('#officeForm').css("display","none");
  }
}
