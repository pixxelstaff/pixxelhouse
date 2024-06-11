// import { form_validation,pop_func } from "./index_page.js";

let username = document.getElementById('c_user_name')

let useremail = document.getElementById('c_email')

let user_rev_com = document.getElementById('rev_com')

let user_review = document.getElementById('user_review');

let form = document.getElementById('complain-form');

// fordynamic maessages

let inp_fields = document.querySelectorAll('.iph_inp_field')


// patterns 

let text_pattern = /^[^ \W](?:[a-zA-Z 0-9]*)[^ \W]$/;

let email_pattern = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z]+(\.[a-zA-Z]+)+$/

let weak_pattern = /^(?!\s).*(?<!\s)$/


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

form_validation(username, "fill the fields properly", text_pattern)

form_validation(useremail, "fill the email fields properly", email_pattern)

form_validation(user_rev_com,"select one of the option","")

form_validation(user_review, "please write your review", weak_pattern)




function empty_msg(item, msg_to_show) {

    item.style.display = "block";
  
    item.textContent = msg_to_show
  
  }


form.addEventListener('submit', (e) => {

    // first condition
  
    if (username.value != "" && useremail.value != "" && user_rev_com.value != "" && user_review.value) {
  
      // nested condition
  
  
      if (text_pattern.test(username.value) && email_pattern.test(useremail.value) && weak_pattern.test(user_review)) {
  
        // alert('all submitted')
  
        // window.localStorage.setItem('success_popup', 'true');
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