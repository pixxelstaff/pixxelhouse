$(document).ready(() => {
    $('.view_assign').click(function () {
        $.ajax({
            url: 'modal.php',
            type: 'POST',
            dataType: 'json',
            data: { id: $(this).attr('data-id') },
            success: function (res) {
                console.log(res)
                $('.assignment_popup').css({ 'display': 'flex' })
                setTimeout(() => {
                    $('.assignment_popup').css({ 'opacity': '1' })
                    $('.assignment_content').css({ 'display': 'inline-block' })
                    setTimeout(() => {
                        $('.assignment_content').css({ 'transform': 'translateY(0px)', 'opacity': '1' })
                    }, 200);
                }, 200);
                $('#assign').empty();
                $('#assign').append(`<span>Assignment :</span>${res.name}`)
                $('#assign_date').empty();
                $('#assign_date').append(`<span>Date :</span>${res.date}`)
                $('#assign_des').empty();
                $('#assign_des').append(`<span>Description :</span>${res.des}`)

            },
            error: function () {
                console.log('error')
            }
        })
    })
    $('.c_assign_popup').click(() => {
        $('.assignment_popup').css({ 'display': 'none', 'opacity': '0' })
        $('.assignment_content').css({ 'dispaly': 'none', 'transform': 'translateY(-200px)', 'opacity': '0' })
    })
})