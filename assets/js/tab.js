let the_main_div = document.getElementsByClassName('main_academic_div');

the_main_div[0].style.display = 'inline-block'

let shift_batch_btn = document.getElementsByClassName('cl_btn');

shift_batch_btn[0].classList.add('active_cl_btn');

Array.from(shift_batch_btn).forEach((btn_element, btn_index) => {

    btn_element.addEventListener('click', (e) => {

        Array.from(shift_batch_btn).forEach((btn_elem, btn_ind) => {

            btn_elem.classList.remove('active_cl_btn')

            the_main_div[btn_ind].style.display = 'none'

        })

        the_main_div[btn_index].style.display = 'inline-block'

        e.target.classList.add('active_cl_btn');

    })
})