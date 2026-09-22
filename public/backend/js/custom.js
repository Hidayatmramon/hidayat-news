(function($) {
    "use strict";
    $('select[name=email_method]').on('change', function () {
        var method = $(this).val();

        $('.configForm').addClass('d-none');
        if (method != 'sendmail') {
            $(`#${method}`).removeClass('d-none');
        }
    }).change();

    $('#navbar_search').on('input', function () {
        var search = $(this).val().toLowerCase();
        var search_result_pane = $('#navbar_search_area .navbar_search_result');
        $(search_result_pane).html('');
        if (search.length == 0) {
            return;
        }

        var match = $('#s7__sidebar-nav .sidebar-link').filter(function (idx, element) {
            return $(element).text().trim().toLowerCase().indexOf(search) >= 0 ? element : null;
        }).sort();

        if (match.length == 0) {
            $(search_result_pane).append('<li class="text-muted">No search result found.</li>');
            return;
        }

        match.each(function (index, element) {
            var item_url = $(element).attr('href') || $(element).data('default-url');
            var item_text = $(element).text().replace(/(\d+)/g, '').trim();
            $(search_result_pane).append(`<li><a href="${item_url}">${item_text}</a></li>`);
        });
    });

    $('.myDeletebtn').on("click", function (e) {
        e.preventDefault();
        var delete_url = $(this).closest("form").attr("action");
        if (typeof delete_url != 'undefined') {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "DELETE",
                        url: delete_url,
                        success: function () {
                            location.reload();
                        }
                    });
                }
            })
        } else {
            Swal.fire(
                'Opps!',
                'Something went wrong!',
                'error'
            )
        }
    });

    $(document).on("click", '.editOptionBtn', function (e) {
        var name = $(this).data('name');
        var invest_amount = $(this).data('invest');
        var return_amount = $(this).data('retrunamo');
        var ratio1 = $(this).data('ratio1');
        var ratio2 = $(this).data('ratio2');
        var bet_ratio = $(this).data('bet');
        var status = $(this).data('status');
        var minamo = $(this).data('minamo');
        var bet_limit = $(this).data('bet_limit');
        var id = $(this).data('id');
        var act = $(this).data('act');

        $(".subro_id").val(id);
        $(".subro_question").val(name);
        $(".subro_invest_amount").val(invest_amount);
        $(".subro_return_amount").val(return_amount);
        $(".subro_ratio1").val(ratio1);
        $(".subro_ratio2").val(ratio2);

        $(".subro_ratio").val(bet_ratio);
        $(".subro_minamo").val(minamo);
        $(".subro_bet_limit").val(bet_limit);
        $(".subro_status").val(status).attr('selected', 'selected');
        $(".abir_act").text(act);

    });

    $(document).on('keypress keyup', '.invest_amount,.return_amount', function () {
        var tr = $(this).parent().parent();
        var investAmount = parseInt(tr.find('.invest_amount').val());
        var returnAmount = parseInt(tr.find('.return_amount').val());
        var ratio = returnAmount / investAmount;
        if (ratio > 0) {
            tr.find('.bet_ratio').val('1:' + ratio);
        }
    });

    $(document).ready(function () {
        $(document).on("click", '.edit_qus_button', function (e) {
            var name = $(this).data('name');
            var end_time = $(this).data('datetime');
            var enddate = $(this).data('enddate');
            var status = $(this).data('status');
            var id = $(this).data('id');


            $(".edit_qus_id").val(id);
            $(".edit_qus_question").val(name);
            $(".edit_qus_time").val(end_time);
            $(".edit_qus_date").val(enddate);
            $(".edit_qus_status").val(status).attr('selected', 'selected');

        });
    });
    
})(jQuery);