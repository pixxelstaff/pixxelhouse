let back_btn = document.getElementById('bck-btn');
let capture_image_btn = document.getElementById('cap-image-btn');
// backbutton
back_btn.addEventListener('click', () => { history.back() })

// capture image code


function downloadImage(canvas, filename, format) {
    const dataUrl = canvas.toDataURL(`image/${format}`);
    const link = document.createElement('a');
    link.href = dataUrl;
    link.download = filename;
    link.click();
}
capture_image_btn.addEventListener('click', () => {
    const body = document.querySelector('#b-card');
    const captureOptions = {
        width: body.offsetWidth, // Set the desired width
        height: body.offsetHeight, // Set the desired height
    };
    html2canvas(body, captureOptions)
        .then(canvas => {
            // Download the captured image
            downloadImage(canvas, "birth-day", "png");
        })
        .catch(err => {
            console.error(err);
        });

})
