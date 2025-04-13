<form action="{{ route('addUpdateJobType') }}" method="POST" name="addUpdateJobTypeForm" id="addUpdateJobTypeForm">
  @csrf
  <input type="hidden" name="jobTypeId" id="jobTypeId" value="{{ isset($jobTypeDetails->id) ? $jobTypeDetails->id : '0' }}">
  <div class="form-group">
    <label>{{ trans('job-type.name') }}<span class="text-danger">*</span></label>
    <input class="form-control" name="name" id="name" type="text" maxlength="100" value="{{ isset($jobTypeDetails->name) ? $jobTypeDetails->name : '' }}">
    <span class="error" id="error_name"></span>
  </div>
  <div class="modal-footer mt-3">
    <button type="button" class="btn  btn-secondary cancel-btn" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
    <button type="submit" class="btn btn-primary submit-btn" id="addEditSubmitJobType">Submit</button>
  </div>
</form>
<script src="{{ asset('assets/js/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery-validation/additional-methods.min.js') }}"></script>
<script>
    $.validator.addMethod("alphanum", function (value, element) {
        return (
            this.optional(element) || value == value.match(/^[a-zA-Z0-9\s]+$/)
        );
    });

  $('#name').keyup(function() {
    $("#error_name").html('');
  });
  $("#addUpdateJobTypeForm").validate({
    rules: {
      name: {
        required: true,
        alphanum: true,
        maxlength: 100,
      }
    },
    messages: {
      name: {
        required: "Job type name is required.",
        alphanum: "Please add valid job type name.",
        maxlength: "job type name must be less than 100 characters.",
      }
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
      var dName = $('#name').val();
      var matchAlpha = /[a-zA-Z]/.test(dName);
      if (dName != '' && matchAlpha == false) {
          $("#error_name").html('Please add atleast 1 character');
          return false;
      }
      var href = $('#addUpdateJobTypeForm').attr('action');
      var formData = new FormData(form);
      $.ajax({
        type: 'POST',
        url: href,
        data: formData,
        contentType: false,
        processData: false,
        beforeSend: function() {
          $("#addEditSubmitJobType").prop("disabled", true);
          $('#addEditSubmitJobType').val('Adding...');
          $("#preloader").show();
        },
        success: function(res) {
          $('.job-type-table').DataTable().ajax.reload();
          if (res.status == true) {
            $('#add_job_type').modal('hide');
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
          $('.job-type-table').DataTable().ajax.reload();
        },
        complete: function() {
          $("#addEditSubmitJobType").prop("disabled", false);
          $('#addEditSubmitJobType').val('Add New Job Type');
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