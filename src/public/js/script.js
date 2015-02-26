$(function () {
    $('#q').autocomplete({
        source: '/autocomplete',
        minLength: 2
    });

    $("#check-all").click(function(event) {
        event.preventDefault();

        if($(".check-all").is(":checked")) {
            $("input[name='institution[]']").prop('checked', false);
        } else {
            $("input[name='institution[]']").prop('checked', true);
        }
    });

    $(".show-hide").click(function(event) {
        event.preventDefault();

        $(".show-hide").toggle();

        $("#search-box").slideToggle();
    });

    $(".highlight-toggle").click(function(event) {
        event.preventDefault();

        var cssClass = $(this).attr('rel-data');
        $("." + cssClass).toggle(100);
        if($(this).find('i').hasClass('fa-plus-square')) {
            $(this).find('i').removeClass('fa-plus-square').addClass('fa-minus-square');
        } else {
            $(this).find('i').addClass('fa-plus-square').removeClass('fa-minus-square');
        }
    });

    $(".highlight-toggle-all").click(function(event) {
        event.preventDefault();

        if($(this).find('i').hasClass('fa-plus-square')) {
            $(".highlight-body").show(100);
            $(this).find('i').removeClass('fa-plus-square').addClass('fa-minus-square');
            $(".highlight-toggle i").removeClass('fa-plus-square').addClass('fa-minus-square');
        } else {
            $(".highlight-body").hide(100);
            $(this).find('i').addClass('fa-plus-square').removeClass('fa-minus-square');
            $(".highlight-toggle i").addClass('fa-plus-square').removeClass('fa-minus-square');
        }
    });


    $('#search-form #from, #search-form #to, .date-picker').datepicker({
        'format' : 'yyyy-mm-dd'
    });
});