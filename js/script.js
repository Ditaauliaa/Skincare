$(document).ready(function(){

    // hidden
    $('#tombol-cari').hide();

    // event ketika keyword ditulis
    $('#keyword').on('keyup', function() {

        // munculkan icon load
        $('.loader').show();


        // ajax menggunakan load
        // $('#container').load('ajax/skincare.php?keyword=' + $('#keyword').val());

        // $.get()
        $.get('ajax/skincare.php?keyword=' + $('#keyword').val(), function(data) {
            
            $('#container').html(data);
            $('.loader').hide();
        });

    });
});