const onLoading = () => {
    Swal.fire({
        html: '<div id="loading-spinner"></div><br><br><h3>Please Wait....</h3><p>Sedang mengirimkan permintaan</p>',
        showConfirmButton: false,
        allowOutsideClick: false
    });
};

function createSlug(text) {
    return text.toLowerCase().replace(/\s+/g, '_');
}

var fileInputs = document.querySelectorAll('.custom-file-input');
var labels = document.querySelectorAll('.custom-file-label');

fileInputs.forEach(function(fileInput, index) {
    fileInput.addEventListener('change', function() {
        labels[index].textContent = this.files[0].name;
    });
});

const sidebarToogler = $('#sidebarToggle')

sidebarToogler.click(() => {
    $('#researchTitle').toggle();
    $('#dataRequestTitle').toggle();
    $('#loanTitle').toggle();
    $('#practicumTitle').toggle();
    $('#letterTitle').toggle();
})

// Swal
const Confirm = (title, text) => {
    return new Promise((resolve, reject) => {
      Swal.fire({
        title,
        text,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
      })
      .then(res => {
        if (res.isConfirmed) {
          resolve(res)
        }
      })
      .catch(e => {
        reject(e)
      })
    });
}

const DialogBox = (title, text, icon = "success") => {
    return new Promise((resolve, reject) => {
        Swal.fire({
            icon,
            title,
            text,
            confirmButtonText: 'OK'
        }).then(res => {
            resolve(res)
        });
    });
}

const Toast = (title, icon = 'success') => {
    return new Promise((resolve, reject) => {
        Swal.fire({
            position: 'top-end',
            icon,
            title,
            showConfirmButton: false,
            timer: 1500,
            timerProgressBar: true,
        }).then(res => {
            resolve(res)
        });
    });
}

const formatDate = (dateString) => {
    const options = {
        day: 'numeric',
        month: 'long',
        year: 'numeric',
        hour: 'numeric',
        minute: 'numeric',
        hour12: true
    };

    const formattedDate = new Date(dateString).toLocaleDateString('en-US', options);
    return formattedDate;
}

const convertDateToTimestamp = (dateString)=>  {
    const dateObject = new Date(dateString);

    const formattedDate =
        dateObject.getFullYear() + '-' +
        ('0' + (dateObject.getMonth() + 1)).slice(-2) + '-' +
        ('0' + dateObject.getDate()).slice(-2) + ' ' +
        ('0' + dateObject.getHours()).slice(-2) + ':' +
        ('0' + dateObject.getMinutes()).slice(-2) + ':' +
        ('0' + dateObject.getSeconds()).slice(-2);

    return formattedDate
}
