//ajax script for getting state data
$(document).on('change', '#state', function(){
    var stateId = $(this).val();
    if(stateId){
        $.ajax({
            type: 'POST',
            url:'server.php',
            data: {'id': stateId},
            success:function(result){
                $('#lga').html(result);
                console.log(result);
            }
        });
    }

    else{
        $('#state').html('<option value="">states</option>');
        $('#lga').html('<option value="">LGA</option>')
    }
});

