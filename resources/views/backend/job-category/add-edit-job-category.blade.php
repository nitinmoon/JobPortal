<form action="{{ route('addUpdateJobCategory') }}" method="POST" name="addUpdateJobCategoryForm" id="addUpdateJobCategoryForm">
  @csrf
  <input type="hidden" name="jobCategoryId" id="jobCategoryId" value="{{ isset($jobCategoryDetails->id) ? $jobCategoryDetails->id : '0' }}">
  <div class="form-group">
    <label>{{ trans('job-type.name') }}<span class="text-danger">*</span></label>
    <input class="form-control" name="name" id="name" type="text" maxlength="100" value="{{ isset($jobCategoryDetails->name) ? $jobCategoryDetails->name : '' }}">
    <span class="error" id="error_name"></span>
  </div>
  <div class="form-group">
    <label>{{ trans('job-type.icon') }}<span class="text-danger">*</span></label>
    <input class="form-control" type="text" name="icon" id="icon" value="{{ isset($jobCategoryDetails->icon) ? $jobCategoryDetails->icon : '' }}" placeholder="e.g. fas fa-user or bi bi-house">
    <span class="error" id="error_icon"></span>
  </div>
  <div class="form-group mt-1">
    <label for=""><small>Select icon from sites <a href="https://icons.getbootstrap.com/" target="_blank">Find Icon</a> put the icon name in feild</small></label>
  </div>
  <div class="modal-footer mt-3">
    <button type="button" class="btn  btn-secondary cancel-btn" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
    <button type="submit" class="btn btn-primary submit-btn" id="addEditSubmitJobCategory">Submit</button>
  </div>
</form>
<!-- <script src="{{ asset('assets/js/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery-validation/additional-methods.min.js') }}"></script> -->
<script>
  $.validator.addMethod("alphanum", function (value, element) {
      return (
          this.optional(element) || value == value.match(/^[a-zA-Z0-9\s]+$/)
      );
  });

  // $.validator.addMethod("alphanumsymbol", function (value, element) {
  //     return (
  //         this.optional(element) ||
  //         value == value.match(/^[a-zA-Z0-9-.+:;!*@#$%&_=|'"?,/()\s]+$/)
  //     );
  // });

  $.validator.addMethod("validIcon", function (value, element) {
      return this.optional(element) || /^(fa|fas|far|fal|fab|fad)\sfa-[\w-]+$|^bi\sbi-[\w-]+$/.test(value);
  }, "Enter a valid icon class (e.g., fa fa-user, fas fa-home, bi bi-alarm)");


  $('#name').keyup(function() {
    $("#error_name").html('');
  });

  $('#icon').keyup(function() {
    $("#error_icon").html('');
  });

  $("#addUpdateJobCategoryForm").validate({
    rules: {
      name: {
        required: true,
        alphanum: true,
        maxlength: 100,
      },
      icon: {
        required: true,
        validIcon: true
      },
    },
    messages: {
      name: {
        required: "Job category name is required.",
        alphanum: "Please add valid job category name.",
        maxlength: "job category name must be less than 100 characters.",
      },
      icon: {
        required: "Icon is required.",
        alphanumsymbol: "Please add valid icon name.",
        iconvalidation: "Please add icon name like - fas fa-user or bi bi-house."
      },
    },
    errorClass: "text-danger is-invalid",
    errorElement: "label",
    errorPlacement: function(error, element) {
      var placement = $(element).data('error');
      if (placement) {
        $(placement).append(error)
      } else {
        error.insertAfter(element);
      }
    },
    submitHandler: function(form) {
      $('.error').html('');
      $("#error_name").html('');
      $("#error_icon").html('');
      var dName = $('#name').val();
      var matchAlpha = /[a-zA-Z]/.test(dName);
      if (dName != '' && matchAlpha == false) {
          $("#error_name").html('Please add atleast 1 character');
          return false;
      }
      var href = $('#addUpdateJobCategoryForm').attr('action');
      var formData = new FormData(form);
      $.ajax({
        type: 'POST',
        url: href,
        data: formData,
        contentType: false,
        processData: false,
        beforeSend: function() {
          $("#addEditSubmitJobCategory").prop("disabled", true);
          $('#addEditSubmitJobCategory').val('Adding...');
          $("#preloader").show();
        },
        success: function(res) {
          $('.job-category-table').DataTable().ajax.reload();
          if (res.status == true) {
            $('#add_job_category').modal('hide');
            $.notify({
              message: res.msg
            }, {
              type: 'success'
            });
          } else {
            $.notify({
              message: res.msg
            }, {
              type: 'danger'
            });
          }
          $('.job-category-table').DataTable().ajax.reload();
        },
        complete: function() {
          $("#addEditSubmitJobCategory").prop("disabled", false);
          $('#addEditSubmitJobCategory').val('Add New Job Category');
          $("#preloader").hide();
        },
        error: function(err) {
          if (err.status == 422) {
            $errResponse = JSON.parse(err.responseText);
            $.each($errResponse.errors, function(key, value) {
              console.log(key + "----" + value)
              $("#error_" + key).html(value)
            })
          }
        }
      });
    }
  });
</script>