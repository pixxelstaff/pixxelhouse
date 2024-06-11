// select all input

let sub_form = document.querySelector("#my-form");

// text inputs

let name_field = document.getElementById("std-name-f");
let f_name = document.getElementById("f-name");
let s_address = document.getElementById("s-address");
let s_qualification = document.getElementById("s-qualification");

// number inputs

let s_father_contact = document.getElementById("f-contact");
let s_personal_num = document.getElementById("s-p-num");
let s_emergency_num = document.getElementById("s-e-num");
let s_other_num = document.getElementById("s-o-num");

// gmail input

let email = document.getElementById("email");
let s_father_email = document.getElementById("f-email");

// select boxes and

let gender_opt = document.getElementById("std-gender-sel");
let course_opt = document.getElementById("std-course-sel");
let days_opt = document.getElementById("std-day-sel");
let time_opt = document.getElementById("std-time-sel");
let country = document.getElementById('country');
let city = document.getElementById('city');

// date inputs

let iph_from_submission_date = document.getElementById("s-date");

// checkbox

let apply_addmission_checkbox = document.getElementById("app-add-chk");
let parents_permission_checkbox = document.getElementById("p-per-chk");
let accept_all = document.getElementById("acc-all");

// submit buttons

let iph_form_btn = document.getElementById("std_form_sub_btn");

// for dynamic input msg

let inp_fields = document.querySelectorAll(".iph_inp_field");

// error_msg

let fill_fields_error = document.getElementsByClassName("error-msg");

text_pattern = /^(?:[a-zA-Z 0-9]*)$/;
number_pattern = /^[0-9]+$/;
email_pattern = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@(gmail|yahoo|icloud|hotmail|outlook|mail)\.(com|net|org|gov|edu|co\.uk|ca|us|io)$/i;
weak_pattern = /^(?!\s).*(?<!\s)$/;

//=======================select box func====================
function validate_select(sel_tag, s_err_msg) {
  let error_msg = sel_tag.parentElement.querySelector(".error-msg");

  sel_tag.addEventListener("focus", (e) => {
    e.target.style.borderColor = "#23DC3D";
    document.querySelector('.dob').style.display='none';
  });

  sel_tag.addEventListener("change", (event) => {
    if (event.target.value !== "") {
      event.target.style.borderColor = "#EBEBEB";
      error_msg.textContent = "";
      error_msg.style.display = "none";
    } else {
      event.target.style.borderColor = "red";
      error_msg.textContent = s_err_msg;
      error_msg.style.display = "block";
    }
  });

  sel_tag.addEventListener("blur", (e) => {
    if (e.target.value !== "") {
      e.target.style.borderColor = "#EBEBEB";
      document.querySelector('.dob').style.display='inline';

    } else {
      e.target.style.borderColor = "red";
      error_msg.textContent = s_err_msg;
      error_msg.style.display = "block";
    }
  });
}

//=======================function validation for text fields====================

function updateFieldStyleAndError(inputElement, isValid, errorMessage) {
  let error_msg = inputElement.parentElement.querySelector(".error-msg");
  let borderColor = isValid ? "#EBEBEB" : "red";

  inputElement.style.borderColor = borderColor;
  error_msg.textContent = isValid ? "" : errorMessage;
  error_msg.style.display = isValid ? "none" : "block";
}

function form_validation(inputField, e_msg_p, pattern_p) {
  if (inputField) {
    inputField.addEventListener("focus", (e) => {
      e.target.style.borderColor = "#23DC3D";
    });

    inputField.addEventListener("keyup", (event) => {
      if (event.target.value !== "") {
        let isValid = pattern_p.test(event.target.value);
        updateFieldStyleAndError(event.target, isValid, e_msg_p);
        if (inputField === email) {
          if (event.target.value === s_father_email.value) {
            alert("Student email cannot be the same as father's email")
            iph_form_btn.setAttribute('disabled', 'true');
          }
          else {
            iph_form_btn.removeAttribute('disabled');

          }
        }
        else if (inputField === s_father_email) {
          if (event.target.value === email.value) {
            alert("Father's email cannot be the same as student's email")
            iph_form_btn.setAttribute('disabled', 'true');
          }
          else {
            iph_form_btn.removeAttribute('disabled');

          }
        }
      }
    });

    inputField.addEventListener("blur", (e) => {
      if (e.target.value !== "") {
        let isValid = pattern_p.test(e.target.value);
        updateFieldStyleAndError(e.target, isValid, e_msg_p);
      } else {
        updateFieldStyleAndError(e.target, false, e_msg_p);
      }
    });
  }
}

//=======================checkbox  func====================

function checkbox(chk_inp, chk_err_msg) {
  chk_inp.addEventListener("change", (e) => {
    error_msg =
      e.target.parentElement.parentElement.querySelector(".error-msg");

    if (e.target.checked) {
      error_msg.textContent = "";

      error_msg.style.display = "none";
    } else {
      error_msg.textContent = chk_err_msg;

      error_msg.style.display = "block";
    }
  });
}
//=========================================================

form_validation(
  name_field,
  "Fill The Field Properly Avoid Spaces And Special Characters",
  text_pattern
);

form_validation(
  f_name,
  "Fill The Field Properly Avoid Spaces And Special Characters",
  text_pattern
);

form_validation(
  s_address,
  "Fill The Field Properly Avoid Spaces And Special Characters",
  weak_pattern
);

form_validation(
  s_qualification,
  "Fill The Field Properly Avoid Spaces And Special Characters",
  weak_pattern
);

form_validation(
  s_father_contact,
  "Your Father/Guardian Contact Is Required!",
  number_pattern
);

form_validation(
  s_personal_num,
  "Your Personal Contact Is Required!",
  number_pattern
);
form_validation(
  s_emergency_num,
  "Your Emergency Contact Is Required!.",
  number_pattern
);

form_validation(
  email,
  "Your Email Is Required!\nEmail Pattern Like Ex.abc@gmail.com.",
  email_pattern
);

form_validation(
  s_father_email,
  "Your Father Email Is Required!\nEmail Pattern Like Ex.abc@gmail.com.",
  email_pattern
);
form_validation(s_other_num, "Your Phone Number Is Required!", number_pattern);

validate_select(gender_opt, "Select At Least One Options");

validate_select(course_opt, "Select At Least One Options");

validate_select(days_opt, "Select At Least One Options");

validate_select(time_opt, "Select At Least One Options");

validate_select(country, "Select At Least One country");

validate_select(city, "Select At Least One city");

validate_select(iph_from_submission_date, "select date");

checkbox(
  apply_addmission_checkbox,
  "Please Check The (Apply Admission) Checkbox To Proceed."
);

checkbox(parents_permission_checkbox, "parents permission are required");

checkbox(accept_all, "Accept all Terms & Conditions");

// ======================================image section=================================

let upload_file_input = document.getElementById("iph_file_field");

let uploaded_img = document.querySelector(".iph_uploaded_img");

let up_img_close_btn = document.querySelector(".upload_img_close_btn");

up_img_close_btn.addEventListener("click", () => {
  uploaded_img.style.display = "none";

  upload_file_input.value = "";
});

upload_file_input.addEventListener("change", (e) => {
  let img_file = e.target.files[0];

  let file_error_msg = document.getElementById("file-error");

  var size = img_file.size / 1024 / 1024;

  function f_er(dis, f_msg) {
    file_error_msg.style.display = dis;

    file_error_msg.textContent = f_msg;
  }

  if (
    img_file.type == "image/jpeg" ||
    img_file.type == "image/jpg" ||
    img_file.type == "image/png" ||
    img_file.type == "image/webp"
  ) {
    f_er("none", "");

    if (size < 5) {
      f_er("none", "");

      up_img_close_btn.style.display = "inline-block";

      let img_file_reader = new FileReader();

      img_file_reader.addEventListener("load", (e) => {
        up_img_src = e.target.result; // it is after reading file as read data as url

        uploaded_img.style.display = "inline-block";

        uploaded_img.src = up_img_src;
      });

      img_file_reader.readAsDataURL(img_file);
    } else {
      f_er("block", "file size must less than 5mb");
    }
  } else {
    f_er("block", "file type must jpg,jpeg,png,webp");
  }
});



// ==========================================================submitting form=================================

function empty_msg(item, msg_to_show) {
  item.style.display = "block";

  item.textContent = msg_to_show;
}

sub_form.addEventListener("submit", (e) => {
  // first condition

  if (
    name_field.value != "" &&
    f_name.value != "" &&
    s_father_email.value != "" &&
    s_father_contact.value != "" &&
    iph_from_submission_date.value != "" &&
    s_personal_num.value != "" &&
    s_emergency_num.value != "" &&
    gender_opt.value != "" &&
    s_address.value != "" &&
    s_qualification.value != "" &&
    s_other_num.value != "" &&
    course_opt.value != "" &&
    days_opt.value != "" &&
    time_opt.value != "" &&
    apply_addmission_checkbox.checked &&
    parents_permission_checkbox.checked &&
    accept_all.checked &&
    upload_file_input.value != ""
  ) {
    // nested condition

    if (
      text_pattern.test(name_field.value) &&
      text_pattern.test(f_name.value) &&
      email_pattern.test(s_father_email.value) &&
      number_pattern.test(s_father_contact.value) &&
      number_pattern.test(s_personal_num.value) &&
      number_pattern.test(s_emergency_num.value) &&
      text_pattern.test(s_emergency_num.value) &&
      weak_pattern.test(s_qualification.value) &&
      number_pattern.test(s_other_num.value) &&
      weak_pattern.test(s_address)
    ) {
      // alert("all submitted");
      // window.localStorage.setItem('success_popup','true');
    } else {
      e.preventDefault();

      pop_func("error");
    }
  } else {
    e.preventDefault();

    inp_fields.forEach((elem) => {
      if (elem.getAttribute("type") == "checkbox") {
        elem.checked
          ? ""
          : empty_msg(
            elem.parentElement.parentElement.querySelector(".error-msg"),
            "please check this field"
          );
      } else if (elem.getAttribute("type") == "file") {
        elem.value
          ? ""
          : empty_msg(
            elem.parentElement.parentElement.querySelector(".error-msg"),
            "please upload the image"
          );
      } else {
        elem.value
          ? ""
          : empty_msg(
            elem.parentElement.querySelector(".error-msg"),
            "please fill the fields properly"
          );
        if (elem.value == "") {
          elem.style.borderColor = "red";
        }
      }
    });
  }
});

// ===================================for dynamic name and cousre field

let std_name_dis = document.getElementById("std_name_head");

let std_course_dis = document.getElementById("std_dis_course");

name_field.addEventListener("keyup", (e) => {
  if (e.target.value != "") {
    std_name_dis.textContent = e.target.value;
  } else {
    std_name_dis.textContent = "your name xyz";
  }
});

course_opt.addEventListener("change", (e) => {
  var selectedOption = e.target.options[e.target.selectedIndex];

  if (selectedOption.value !== "") {
    console.log(selectedOption.innerText);
    std_course_dis.textContent = selectedOption.textContent;
  } else {
    std_course_dis.textContent = "your course";
  }
});

// validation code

if (window.localStorage.getItem("success_popup")) {
  pop_func("success");
} else {
  // console.log("hdshg");
}
