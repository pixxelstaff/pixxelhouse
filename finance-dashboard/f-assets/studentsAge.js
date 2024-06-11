$(document).ready(() => {

    function pagination_display(parent, actionDiv) {
        parent.val() ? actionDiv.addClass('d-none') : actionDiv.removeClass('d-none');

    }

    $('#searchInp').on('keyup', function () {
        pagination_display($('#searchInp'), $('#pagination'));
        $('#student-card-div').html('');
        let search_val = ($('#searchInp').val()).toLowerCase();
        let offVal = $('#searchInp').attr('data-offset');
        $.ajax({
            url: 'ajax/searchData.php',
            method: 'POST',
            dataType: 'JSON',
            data: { val: search_val, offset: offVal },
            success: function (searchData) {
                Array.from(searchData).forEach((item) => {
                    let searchCard = document.createElement('div');
                    searchCard.className = 'col-lg-3 col-md-6 col-sm-12 p-2'
                    searchCard.innerHTML = `
                        <a href="student-report.php?student-id=${item.id}">
                            <div class="col-12 student-ins-card">
                            <div class="student-img-div">
                                    <img src="../images/${item.studentImage}" alt="">
                            </div>
                            <div class="std-data">
                             <h2 class="stdName text-center">${item.name}</h2>
                             <ul>
                                 <li>
                                    <span class="label-span"> <i>Father :</i> </span>
                                    <span class="data-span">${item.fathername}</span>
                                </li>
                                 <li>
                                     <span class="label-span"> <i>Course :</i> </span>
                                     <span class="data-span">${item.courseName}</span>
                                </li>

                                <li>
                                    <span class="label-span"> <i>Batch :</i> </span>
                                    <span class="data-span">${item.batchName}</span>
                                </li>
                                <li>
                                    <span class="label-span"> <i>Teacher :</i> </span>
                                    <span class="data-span">${item.teacherName}</span>
                                </li>
                            </div>
                        </a>
                    `;
                    $('#student-card-div').append(searchCard);
                })
            },
            error: function (error) {
                console.log(error);
            }
        })
    })

    $('#selectCourse').on('change', function () {
        let courseVal = $(this).val();
        if (courseVal != '') {
            $.ajax({
                url: 'ajax/getBatch.php',
                method: 'POST',
                dataType: 'JSON',
                data: { id: courseVal },
                success: function (resp) {
                    $('#selectBatch').empty();
                    let default_opt = document.createElement('option');
                    default_opt.value = ``;
                    default_opt.textContent = `select Batch`;
                    $('#selectBatch').append(default_opt);
                    Array.from(resp).forEach((elem) => {
                        let opt = document.createElement('option');
                        opt.value = `${elem.id}`;
                        opt.textContent = `${elem.name}`;
                        $('#selectBatch').append(opt);
                    })
                },
                error: function (error) {
                    console.log(error);
                }
            })
        }
        else{
            $('#selectBatch').empty()
        }

    });



    function getBatchName(batchId) {
        return new Promise((resolve, reject) => {
            $.ajax({
                url: 'ajax/batchData.php',
                method: 'POST',
                dataType: 'JSON',
                data: { batch: batchId },
                success: function (response2) {
                    const insData = Array.from(response2).map((elem) => ({
                        'batchname': elem.batchName,
                        'teacherName': elem.teacherName,
                        'course': elem.course
                    }));
                    resolve(insData);

                },
                error: function (error) {
                    reject(error);
                }
            });
        });
    }

    async function fetchAjaxData() {
        const batchSelVal = $('#selectBatch').val();
        // const courseSelVal = $('#selectCourse').val();
        const sortVal = $('#searchBySort').val();

        try {
            const response = await $.ajax({
                url: 'ajax/studentsData.php',
                method: 'POST',
                dataType: 'JSON',
                data: {
                    batch: batchSelVal,
                    sort: sortVal
                }
            });
            console.log('check working')
            console.log(response)
            for (const item of response) {
                try {
                    console.log(item)
                    const res = await getBatchName(item.batch);
                    console.log(res);

                    let card = document.createElement('div');
                    card.className = 'col-lg-3 col-md-6 col-sm-12 p-2'
                    card.innerHTML = `
                        <a href="student-report.php?student-id=${item.sno}">
                            <div class="col-12 student-ins-card">
                            <div class="student-img-div">
                                    <img src="../images/${item.student_image}" alt="">
                            </div>
                            <div class="std-data">
                             <h2 class="stdName text-center">${item.student_name}</h2>
                             <ul>
                                 <li>
                                    <span class="label-span"> <i>Father :</i> </span>
                                    <span class="data-span">${item.father_name}</span>
                                </li>
                                 <li>
                                     <span class="label-span"> <i>Course :</i> </span>
                                     <span class="data-span">${res[0].course}</span>
                                </li>

                                <li>
                                    <span class="label-span"> <i>Batch :</i> </span>
                                    <span class="data-span">${res[0].batchname}</span>
                                </li>
                                <li>
                                    <span class="label-span"> <i>Teacher :</i> </span>
                                    <span class="data-span">${res[0].teacherName}</span>
                                </li>
                            </div>
                        </a>
                    `;
                    $('#student-card-div').append(card);
                } catch (error) {
                    console.error('Error in getBatchName:', error);
                }
            }
        } catch (error) {
            console.error('Error in fetchAjaxData:', error);
        }
    }

    $('#selectBatch').on('change', function () {
        $('#student-card-div').empty();
        pagination_display($('#selectBatch'), $('#pagination'));
        fetchAjaxData();
    });

    $('#searchBySort').on('change', function () {
        $('#student-card-div').empty();
        pagination_display($('#searchBySort'), $('#pagination'));
        fetchAjaxData();
    });
});





// $(document).ready(() => {

//     function getBatchName(batchId) {
//         // var batchN = '';
//         // var teacherN ='';
//         var insData = [];
//         $.ajax({
//             url: 'ajax/batchData.php',
//             method: 'POST',
//             dataType: 'JSON',
//             data: { batch: batchId },
//             success: function (response2) {
//                 Array.from(response2).forEach((elem)=>{
//                     insData = [{
//                         'batchname':elem.batchName,
//                         'teacherName':elem.teacherName
//                     }]

//                 })
//                 return insData;
//                 // response2
//             //   console.log(insData)
//             },
//             error: function (error) {
//                 console.log(error);
//             }
//         })
//     }

//     function fetchAjaxData() {
//         batchSelVal = $('#selectBatch').val();
//         courseSelVal = $('#selectCourse').val();
//         sortVal = $('#searchBySort').val();

//         $.ajax({
//             url: 'ajax/studentsData.php',
//             method: 'POST',
//             dataType: 'JSON',
//             data: {
//                 batch: batchSelVal,
//                 course: courseSelVal,
//                 sort: sortVal
//             },
//             success: function (response) {
//                 Array.from(response).forEach((item) => {
//                    var res = getBatchName(item.batch);
//                     console.log(res)
//                     let card = document.createElement('div');
//                     card.className = 'col-lg-3 col-md-6 col-sm-12 p-2'
//                     card.innerHTML = `
//                     <a href="student-report.php?student-id=${item.sno}">
//                     <div class="col-12 student-ins-card">
//                         <div class="student-img-div">
//                             <img src="../images/${item.student_image}" alt="">
//                         </div>
//                         <div class="std-data">
//                             <h2 class="stdName text-center">${item.student_name}</h2>
//                             <ul>
//                                 <li>
//                                     <span class="label-span"> <i>Father :</i> </span>
//                                     <span class="data-span">${item.father_name}</span>
//                                 </li>
//                                 <li>
//                                     <span class="label-span"> <i>Course :</i> </span>
//                                     <span class="data-span">web developemnt</span>
//                                 </li>
//                                 <li>
//                                     <span class="label-span"> <i>Batch :</i> </span>
//                                     <span class="data-span">${'batchName'}</span>
//                                 </li>
//                                 <li>
//                                     <span class="label-span"> <i>Teacher :</i> </span>
//                                     <span class="data-span">${'teacherName'}</span>
//                                 </li>
//                             </ul>
//                         </div>
//                     </div>
//                 </a>
//                     `;
//                     $('#student-card-div').append(card);

//                 })

//             },
//             error: function (error) {
//                 console.error('Error:', error);
//             }
//         })
//     }

//     $('#selectBatch').on('change', function () {
//         $('#student-card-div').empty();
//         fetchAjaxData()
//     })
//     $('#selectCourse').on('change', function () {
//         $('#student-card-div').empty();
//         fetchAjaxData()
//     })
//     $('#searchBySort').on('change', function () {
//         $('#student-card-div').empty();
//         fetchAjaxData()
//     })


// })