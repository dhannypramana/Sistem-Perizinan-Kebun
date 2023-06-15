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
