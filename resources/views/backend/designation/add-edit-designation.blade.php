<form action="{{ route('addUpdateDesignation') }}" method="POST" name="addUpdateDesignationForm" id="addUpdateDesignationForm">
  @csrf
  <input type="hidden" name="designationId" id="designationId" value="{{ isset($designationDetails->id) ? $designationDetails->id : '0' }}">
  <div class="form-group">
    <label>Name<span class="text-danger">*</span></label>
    <input class="form-control" name="name" id="name" type="text" maxlength="100" value="{{ isset($designationDetails->name) ? $designationDetails->name : '' }}">
    <span class="error" id="error_name"></span>
  </div>
  <div class="modal-footer mt-3">
    <button type="button" class="btn  btn-secondary cancel-btn" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
    <button type="submit" class="btn btn-primary submit-btn" id="addEditSubmitDesignation">Submit</button>
  </div>
</form>
<script>
    $.validator.addMethod("alphanum", function (value, element) {
        return (
            this.optional(element) || value == value.match(/^[a-zA-Z0-9\s]+$/)
        );
    });

  $('#name').keyup(function() {
    $("#error_name").html('');
  });

  $("#addUpdateDesignationForm").validate({
    rules: {
      name: {
        required: true,
        alphanum: true,
        maxlength: 100,
      }
    },
    messages: {
      name: {
        required: "Designation name is required.",
        alphanum: "Please add valid designation name.",
        maxlength: "Designation name must be less than 100 characters.",
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
      var href = $('#addUpdateDesignationForm').attr('action');
      var formData = new FormData(form);
      $.ajax({
        type: 'POST',
        url: href,
        data: formData,
        contentType: false,
        processData: false,
        beforeSend: function() {
          $("#addEditSubmitDesignation").prop("disabled", true);
          $('#addEditSubmitDesignation').val('Adding...');
          $("#preloader").show();
        },
        success: function(res) {
          $('.designation-table').DataTable().ajax.reload();
          if (res.status == true) {
            $('#add_designation').modal('hide');
            Toast.create({
                title: "Success!",
                message: res.msg,
                status: TOAST_STATUS.SUCCESS,
                timeout: 5000,
            });
          } else {
            Toast.create({
                title: "Error!",
                message: res.msg,
                status: TOAST_STATUS.DANGER,
                timeout: 5000,
            });
          }
          $('.designation-table').DataTable().ajax.reload();
        },
        complete: function() {
          $("#addEditSubmitDesignation").prop("disabled", false);
          $('#addEditSubmitDesignation').val('Add New Designation');
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