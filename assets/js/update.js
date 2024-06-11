$(document).ready(() => {
    $('.btn_shower').click(() => {
        $('.upload_btn_group').toggleClass('move_down_class');
    })
    $('.remove_up_img').click(() => {

        $('.iph_dash_update_img').css({
            'display': 'none'
        })

        $('#upd_img_inp').val('');

    })

    $('#upd_img_inp').change((e) => {

        let upd_img_file = e.target.files[0];

        let upd_file_reader = new FileReader();

        upd_file_reader.onload = (e) => {
            let upd_img_src = e.target.result;

            $('.iph_dash_update_img').css({
                'display': 'inline-block'
            });

            $('.iph_dash_update_img').attr('src', upd_img_src);
        };


        upd_file_reader.readAsDataURL(upd_img_file);

    })
})