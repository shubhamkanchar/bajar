<script src="https://cdnjs.cloudflare.com/ajax/libs/toastify-js/1.6.1/toastify.min.js"
    integrity="sha512-79j1YQOJuI8mLseq9icSQKT6bLlLtWknKwj1OpJZMdPt2pFBry3vQTt+NZuJw7NSd1pHhZlu0s12Ngqfa371EA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    document.addEventListener('notify', event => {
        console.log(event);
        Toastify({
            text: event.detail[0].message,
            duration: 3000,
            gravity: "top",
            position: "right",
            backgroundColor: event.detail[0].type === 'success' ? "green" : "black",
        }).showToast();
    });
</script>
