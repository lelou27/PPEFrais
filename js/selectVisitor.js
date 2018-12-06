if ($('.formSending')[0].value == 0) {
    $('#lstMois').addClass('hidden');
    $('.lstMois').addClass('hidden');
    $('.send').addClass('hidden');
}

$('#visiteurs').change(function () {
    var idUser = this.value;

    $.ajax({
        url : 'demanderMois.php?idUser=' + idUser,
        type : 'GET',
        success : function(data){
            $('#lstMois option').remove();
            $('#lstMois').append('<option selected hidden>Sélectionnez un mois</option>');

            $('#lstMois').removeClass('hidden').addClass('visible');
            $('.lstMois').removeClass('hidden').addClass('visible');

            data = JSON.parse(data);
            var select = $('#lstMois');

            for (var i = 0 ; i < data.length ; i++) {
                var option;
                option = '<option value="'+data[i].mois+'">'+data[i].numMois+'/'+data[i].numAnnee+'</option>';
                select.append(option);
            }

            $('#lstMois').change(function () {
                $('.send').removeClass('hidden').addClass('visible');
            });
        },
        error: function (error) {
            console.error(error);
        }
    });
});