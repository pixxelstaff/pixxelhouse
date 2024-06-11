const circular_div = document.getElementsByClassName('circular-progress');

const progress_percantage_shower = document.getElementsByClassName('progress-value');

let bg_num = 0;

Array.from(circular_div).forEach((element, index) => {
    bg_num++;
    let start_val = 0;
    let end_val = parseInt(progress_percantage_shower[index].getAttribute('data-end-val'));
    let duration = 50;
    
    if(end_val != 0){
        let progress = setInterval(() => {
            start_val++;
    
            progress_percantage_shower[index].textContent = `${start_val}%`
    
                element.style.background = `conic-gradient(#1176BC ${start_val * 3.6}deg, #ededed 0deg)`
    
            if (start_val == end_val) {
                clearInterval(progress);
            }
        }, duration);
    }


})

