(function($) {
    'use strict';
    $(function() {

        $(document).ready(function () {
            $('.editBlogCatBtn').on('click',function () {
                $('#editBlogCat').attr('action',$(this).data('route'));
                $('#editBlogName').val($(this).data('name'));
            });

            $('.editFaqBtn').on('click',function () {
                $('#editFaq').attr('action',$(this).data('route'));
                $('#editFaqQuestion').val($(this).data('question'));
                $('#editFaqAnswer').val($(this).data('answer'));
            });

            $('.editServiceBtn').on('click',function () {
                $('#editService').attr('action',$(this).data('route'));
                $('#image-preview2').attr('src',$(this).data('image'));
                $('#editServiceTitle').val($(this).data('title'));
                $('#editServiceDescription').val($(this).data('description'));
            });

            $('.editSliderBtn').on('click',function () {
                $('#editSlider').attr('action',$(this).data('route'));
                $('#image-preview2').attr('src',$(this).data('image'));
                $('#editSliderHeader').val($(this).data('header'));
                $('#editSliderTitle').val($(this).data('title'));
            });

            $('.editSocialBtn').on('click',function () {
                $('#editSocial').attr('action',$(this).data('route'));
                $('#editSocialIcon').val($(this).data('icon_name'));
                $('#editSocialLink').val($(this).data('link'));
            });

            $('.editTestimonialBtn').on('click',function () {
                $('#editTestimonial').attr('action',$(this).data('route'));
                $('#image-preview2').attr('src',$(this).data('image'));
                $('#editTstmnlName').val($(this).data('name'));
                $('#editTstmnlDesignation').val($(this).data('designation'));
            });

            $('.editExtenBtn').on('click', function () {
                var modal = $('#editExtentionBtn');
                var shortcode = $(this).data('shortcode');

                modal.find('.extension-name').text($(this).data('name'));
                modal.find('form').attr('action', $(this).data('action'));

                var html = '';
                $.each(shortcode, function (key, item) {
                    html += `<div class="form-group">
                        <strong>${item.title}<span class="text-danger">*</span></strong>
                        <div class="col-md-12">
                            <input name="${key}" class="form-control" placeholder="--" value="${item.value}" required>
                        </div>
                    </div>`;
                })
                modal.find('.modal-body').html(html);

                modal.modal('show');
            });
            
            $('.activateBtn').on('click', function () {
                var modal = $('#activateModal');
                modal.find('.extension-name').text($(this).data('name'));
                modal.find('input[name=id]').val($(this).data('id'));
            });

            $('.deactivateBtn').on('click', function () {
                var modal = $('#deactivateModal');
                modal.find('.extension-name').text($(this).data('name'));
                modal.find('input[name=id]').val($(this).data('id'));
            });

            $(document).ready(function () {
                $('.editLangBtn').on('click',function () {
                    $('#editLang').attr('action',$(this).data('route'));
                    $('#editLangName').val($(this).data('name'));
                });
            });

            $(document).on("click", '.edit_awaiting_ques', function (e) {
                var name = $(this).data('name');
                var end_time = $(this).data('datetime');
                var end_date = $(this).data('enddate');
                var status = $(this).data('status');
                console.log(status);
                false;
                var id = $(this).data('id');
                var mid = $(this).data('mid');
                var act = $(this).data('act');
                var match_end_date = $(this).data('matchenddate');

                $(".edit_awaiting_id").val(id);
                $(".edit_awaiting_question").val(name);
                $(".edit_awaiting_time").val(end_time);
                $(".edit_awaiting_date").val(end_date);
                $(".edit_awaiting_match_id").val(mid);
                $(".awaiting_match_end_date").text(match_end_date);
                $(".edit_awaiting_status").val(status).attr('selected', 'selected');

            });

            $(document).on("click", '.refund_bet', function (e) {
                var id = $(this).data('id');
                var mid = $(this).data('mid');
                var act = $(this).data('act');

                $(".refund_id").val(id);
                $(".refund_match_id").val(mid);

            });

            $(document).on("click", '.refund_prelist_bet', function (e) {
                var id = $(this).data('id');
                var act = $(this).data('act');
                $(".refund_prelist_id").val(id);
            });

            $(document).on("click", '.edit_threat_btn', function (e) {
                var ques_id = $(this).data('ques_id');
                var match_id = $(this).data('matchid');
                var id = $(this).data('id');
                var act = $(this).data('act');
                $(".threat_id").val(id);
                $(".threat_match_id").val(match_id);
                $(".threat_ques_id").val(ques_id);
                $(".subro_act").text(act);
            }); 
        });
    });
})(jQuery);
