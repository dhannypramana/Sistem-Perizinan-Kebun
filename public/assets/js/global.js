const onLoading = () => {
    Swal.fire({
        html: '<div id="loading-spinner"></div><br><br><h3>Please Wait....</h3><p>Sedang mengirimkan permintaan</p>',
        showConfirmButton: false,
        allowOutsideClick: false
    });
};
