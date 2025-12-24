// core.js
function showMyToast(message, status) {
    var toastEl = document.getElementById("liveToast");
    var toastBody = document.getElementById("toastMessage");
    toastBody.innerText = message;
    toastEl.classList.remove('text-bg-success', 'text-bg-danger');
    
    if(status === 'success') {
        toastEl.classList.add('text-bg-success');
    } else {
        toastEl.classList.add('text-bg-danger');
    }
    var toast = new bootstrap.Toast(toastEl, {
        autohide: true,
        delay: 3000
    });
    toast.show();
}