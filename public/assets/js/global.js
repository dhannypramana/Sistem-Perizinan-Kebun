const onLoading = () => {
    Swal.fire({
        html: '<h5>Please Wait....</h5><br><div id="loading-spinner"></div>',
        showConfirmButton: false,
        allowOutsideClick: false
    });
};
