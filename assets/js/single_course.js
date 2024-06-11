let anc_btn = document.querySelector('.single_page_btn');

let popup_p_div = document.querySelector('.confirm_popup_parent');

let pop_box = document.querySelector('.child_popup_div');

let cancel_btn = document.querySelector('.cancel_btn');

anc_btn.addEventListener('click', () => {

    popup_p_div.style.display = 'flex';

    setTimeout(() => {

        popup_p_div.style.opacity = '1'

        setTimeout(() => {
            pop_box.style.transform = 'translateY(0)';
        }, 300)

    }, 100);

})

cancel_btn.addEventListener('click', () => {

    pop_box.style.transform = 'translateY(-200%)';

    setTimeout(() => {

        popup_p_div.style.opacity = '0'

        setTimeout(() => {
            popup_p_div.style.display = 'none';
        }, 300)

    }, 100);

})