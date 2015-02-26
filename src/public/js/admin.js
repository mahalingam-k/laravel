$(function() {
    $('.documentEdit #date, #in_force_from, #in_force_until, .date-picker').datepicker({
        'format' : 'yyyy-mm-dd'
    });

    $('#documentCreate').bootstrapValidator({
        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            date: {
                validators: {
                    date: {
                        format: 'YYYY-MM-DD',
                        message: 'The value is not a valid date'
                    }
                }
            },
            in_force_from: {
                validators: {
                    date: {
                        format: 'YYYY-MM-DD',
                        message: 'The value is not a valid date'
                    }
                }
            },
            in_force_until: {
                validators: {
                    date: {
                        format: 'YYYY-MM-DD',
                        message: 'The value is not a valid date'
                    }
                }
            }
        }
    });

    $('.subdivision.info').hide();

    $(".open-subdivisions").click(function(event) {
        event.preventDefault();

        var id = $(this).attr('id');
        var i_element = $(this).find('i');
        if(i_element.hasClass('fa-plus-square')) {
            $('.' + id).slideDown(300);
            $(this).find('i').removeClass('fa-plus-square').addClass('fa-minus-square');
        } else {
            $('.' + id).slideUp(300);
            $(this).find('i').addClass('fa-plus-square').removeClass('fa-minus-square');
        }
    });

    $("#declarations-add-row .btn").click(function(event) {
        event.preventDefault();
        var element = $(this);
        var rowNumber = parseInt($('#nr_of_declarations').val());
        rowNumber += 1;

        $.get("/admin/document/ajax/declaration/" + rowNumber, function(html) {
            $("#declarations-add-row").before(html);
        });
        $('#nr_of_declarations').val(rowNumber)
    });

    $("#ratifications-add-row .btn").click(function(event) {
        event.preventDefault();
        var element = $(this);
        var rowNumber = parseInt($('#nr_of_ratifications').val());
        rowNumber += 1;

        $.get("/admin/document/ajax/ratification/" + rowNumber, function(html) {
            $("#ratifications-add-row").before(html);
        });
        $('#nr_of_ratifications').val(rowNumber)
    });



    function showHideFields() {
        var selectedDocumentType = $('#type').find(":selected").val();
        if(selectedDocumentType == 'decision') {

            $('.treaty, .commentary').hide();
            $('#title_short').parent("div").hide();
        } else if(selectedDocumentType == 'treaty') {
            $('.decision, .commentary').hide();
            $('#title_short').parent("div").show();
        } else {
            $('.decision, .treaty').hide();
            $('#title_short').parent("div").show();
        }

        $('.' + selectedDocumentType).show();
    }

    showHideFields();

    $('.documentEdit #date, #in_force_from, #in_force_until').datepicker({
        'format' : 'yyyy-mm-dd'
    });

    $('select#type').on('change', function (e) {
        showHideFields();
    });

    $('select#institution').on('change', function (e) {
        var selectedInstitution = $(this).find(":selected").val();

        $.get("/admin/document/ajax/institution/" + selectedInstitution, function(data) {

            $("select#institution_subdivision option").remove();
            var typeData = JSON.parse(data);

            $.each(typeData, function(value, name) {
                $("select#institution_subdivision").append('<option value="'+ value +'">'+ name +'</option>');
            });
        });
    });


    $(".delete-document").click(function(e) {
        e.preventDefault();
        var button = $(this);
        bootbox.confirm("Are you sure you want to delete this document?", function(confirmed) {
            if(confirmed) {
                button.parent('form').submit();
                //return true;
            }

        });
    });


});