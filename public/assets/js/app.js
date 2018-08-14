function validateForm() {
    $('form').each(function () {
        var $form = $(this);
        if ($form.hasClass('formValidate')) {
            $form.submit(function () {
                if ($form.valid()) {
                    $form.find('button[type="submit"]').prop('disabled', true);
                } else {
                    $form.find('button[type="submit"]').prop('disabled', false);
                }
            });
            //setting form validate
            $form.validate({
                highlight: function (element) {
                    $(element).closest('.form-group').addClass('has-error');
                },
                unhighlight: function (element) {
                    $(element).closest('.form-group').removeClass('has-error');
                },
                errorElement: 'span',
                errorClass: 'error',
                errorPlacement: function (error, element) {
                    if (element.parent('.input-group').length) {
                        error.insertAfter(element.parent());
                    } else if (element.hasClass('select2')) {
                        element.parent().append(error);
                    } else if (element.parent().hasClass('radio-option')) {
                        element.closest('.radio-option-group').append(error);
                    } else {
                        error.insertAfter(element);
                    }
                },
                rules: {
                    email: {
                        normalizer: function (value) {
                            return $.trim(value);
                        }
                    }
                }
            });
        }
    });
}

function activeCheckbox()
{
    $('#plan-form').on('change', '.is_active_checkbox', function(){
        if ($(this).is(":checked")) $(this).parent().find('.is_active').val(1);
        else $(this).parent().find('.is_active').val(0);
    })
}

function addMore()
{
    $('#add-more').click(function(){
        var html = '<tr>\n' +
            '                        <td><input type="text" class="form-control" name="option[value][]"></td>\n' +
            '                        <td><input type="number" class="form-control" name="option[position][]" value="0"></td>\n' +
            '                        <td><input type="checkbox" class="is_active_checkbox" checked><input type="hidden" class="is_active" name="option[is_active][]" value="1"></td>\n' +
            '                        <td><button type="button" class="btn btn-danger delete-button">Delete</button</td>\n' +
            '                    </tr>';
        $('#plan-form tbody').append(html);
    });
}

function remove()
{
    $('#plan-options').on('click', '.delete-button', function(){
        $(this).closest('tr').remove();
    })
}

function deletePlan()
{
    $('#dataTable').on('click', '.delete-item', function(){
        var $this = $(this);
        var r = confirm("Are you sure ?");
        if (r == true) {
            $.ajax({
                type: "DELETE",
                dataType: 'json',
                data: {_method: 'DELETE', _token: $('meta[name="csrf-token"]').attr('content') },
                url: $this.data('url'),
                success: function (response) {
                    $('#dataTable').dataTable().api().ajax.reload(null, false);
                    $('html,body').animate({scrollTop: 0}, 500);
                }
            });
        }
    });
}

function scripts()
{
    validateForm();
    activeCheckbox();
    addMore();
    remove();
}
