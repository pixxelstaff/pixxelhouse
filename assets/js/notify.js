
let show = true;
const notificationParent = document.querySelector('.notification-parent');

notificationParent.addEventListener('click', function () {

    this.querySelector('.notification-div').style.display = `${show ? 'inline-block' : 'none'}`

    show = !show;

    let id = this.getAttribute('data-admin-id');
    url = "ajax/notification.php";

    if (notificationParent.getAttribute('requestFetch') == 'true') {
        fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ id: id })
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                // Handle the response data here
                if (data.success) {
                    // Do something on success
                    document.querySelector('.rounded-circle').classList.remove('scale-up-circe');
                    notificationParent.setAttribute('requestFetch', 'false');
                } else {
                    // Handle unsuccessful response
                    console.log('already seen');
                    notificationParent.setAttribute('requestFetch', 'false');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                // Handle errors here
            });
    }



})
document.querySelector('.notification-div').addEventListener('click', (e) => { e.stopImmediatePropagation(); })

