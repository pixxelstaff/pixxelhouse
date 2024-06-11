$(document).ready(() => {
  const stars = $('.rating-star');

  const ratingInp = $('.rating_value_taker');

  stars.click(function () {
    

    const starLength = parseInt($(this).attr('rate'));

    ratingInp.val(starLength)

   var h_err = ratingInp.next();

   h_err.css({
    'display':'none'
   })



    stars.each(function (index) {
      const star = $(this);
      if (index < starLength) {
        star.css({
          'color': '#F7A530',
          'stroke': '#F7A530'
        });
      } else {
        star.css({
          'color': 'transparent',
          'stroke': '#545454'
        });
      }
    });
  });
});


// javascript

let username = document.getElementById('tr_user_name')

let useremail = document.getElementById('tr_email')

let select_class = document.getElementById('tr_sel_class')

let sel_date = document.getElementById('class_date');

let t_rel_review = document.getElementById('std_review');

let rating = document.getElementById('rating');

let form = document.getElementById('tr_from');

// fordynamic maessages

let inp_fields = document.querySelectorAll('.iph_inp_field')

// patterns 

text_pattern = /^[^ \W](?:[a-zA-Z 0-9]*)[^ \W]$/;

email_pattern = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z]+(\.[a-zA-Z]+)+$/

weak_pattern = /^(?!\s).*(?<!\s)$/


// input type text and other

function form_validation(inp_f_p, e_msg_p, pattern_p) {

    inp_f_p.addEventListener('focus', (e) => {

        let error_msg = e.target.parentElement.querySelector('.error-msg');

        e.target.style.borderColor = '#23DC3D';

        if (e.target.getAttribute('type') != 'select') {

            e.target.addEventListener('keyup', (event) => {

                if (event.target.value != "") {

                    if (pattern_p.test(event.target.value)) {

                        error_msg.textContent = ""

                        error_msg.style.display = 'none'

                        event.target.style.borderColor = '#EBEBEB'

                    }

                    else {
                        event.target.style.borderColor = 'red'

                        error_msg.textContent = e_msg_p

                        error_msg.style.display = 'block'

                    }

                }

            })
        }
        else {

            e.target.addEventListener('change', (event) => {

                if (event.target.value != "") {

                    event.target.style.borderColor = '#23DC3D';

                    error_msg.textContent = ""

                    error_msg.style.display = 'none'


                }

                else {

                    event.target.style.borderColor = 'red';

                    error_msg.textContent = s_err_msg

                    error_msg.style.display = 'block'

                }

            })
        }


    })

    inp_f_p.addEventListener('blur', (e) => {

        let error_msg = e.target.parentElement.querySelector('.error-msg');

        if (e.target.value != "") {

            e.target.style.borderColor = '#EBEBEB'

            error_msg.textContent = ""

            error_msg.style.display = 'none'

            if (e.target.getAttribute('type') != 'select') {

                if (pattern_p.test(e.target.value)) {

                    e.target.style.borderColor = '#EBEBEB'

                    error_msg.textContent = ""

                    error_msg.style.display = 'none'


                }

                else {
                    e.target.style.borderColor = 'red'

                    error_msg.textContent = e_msg_p

                    error_msg.style.display = 'block'

                }
            }

        }

        else {

            e.target.style.borderColor = 'red'

            error_msg.textContent = e_msg_p

            error_msg.style.display = 'block'

        }

    })

}


form_validation(username,"please fill the field properly",text_pattern)

form_validation(useremail,"please write the email carefully",email_pattern)

form_validation(select_class,"select one of the class","")

form_validation(sel_date,"select the date","")

form_validation(t_rel_review,"please write your review carefully",weak_pattern)

form_validation(rating,"please give rating",text_pattern)





function empty_msg(item, msg_to_show) {

    item.style.display = "block";
  
    item.textContent = msg_to_show
  
  }


form.addEventListener('submit', (e) => {

    // first condition
  
    if (username.value != "" && useremail.value != "" && select_class.value != "" && sel_date.value && t_rel_review.value != "" && rating.value != "") {
  
      // nested condition
  
  
      if (text_pattern.test(username.value) && email_pattern.test(useremail.value) && weak_pattern.test(t_rel_review) ) {
  
        // alert('all submitted')
  
        // window.localStorage.setItem('success_popup', 'true');

        console.log('hello')
      }
  
      else {
  
        e.preventDefault()
        
        error_pop('error')
  
      }
  
  
    }
    else {

      e.preventDefault();
  
      inp_fields.forEach((elem) => {
  
          elem.value ? '' : empty_msg(elem.parentElement.querySelector('.error-msg'), 'please fill the fields properly')

          if (elem.value == '') {
            elem.style.borderColor = 'red'
          }
  
      })
  
    }
  })


let back_button = document.querySelector('.bck_btn');

back_button.addEventListener('click',()=>{
  history.back();
})