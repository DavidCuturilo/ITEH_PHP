$('#dodajForm').submit(function(){
    event.preventDefault;
    const $form = $(this);
    const $input = $form.find('input, select, button, textarea');
    
    const serijalizacija = $form.serialize();
    console.log(serijalizacija);

    $input.prop('disabled',true);
    req = $.ajax({
        url: 'handler/add.php',
        type: 'post',
        data: serijalizacija
    })

    req.done(function(res,textStatus, jqXHR){
        if(res=="Success"){
            alert("Novo iznajmljivanje uspesno dodato!");
            location.reload(true);
        }else console.log("Iznajmljivanje nije dodato");
    })

    req.fail(function(jqXHR,textStatus,errorThrown){
        console.log("Error happened: "+textStatus,errorThrown);
    })

})

$('#btn-obrisi').click(function(){
    const checked = $('input[name=checked]:checked');

    req = $.ajax({
        url: 'handler/delete.php',
        type: 'post',
        data: {'id': checked.val()}
    })

    req.done(function(res,textStatus, jqXHR){
        if(res=="Success"){
            checked.closest('tr').remove();
            alert("Obrisano izdavanje");
            console.log("Obrisano izdavanje")
        }else console.log("Izdavanje nije obrisano");
    })

    req.fail(function(jqXHR,textStatus,errorThrown){
        console.log("Error happened: "+textStatus,errorThrown);
    })

})

$('#btn-sortiraj').click(function(){
    req = $.ajax({
        url: 'handler/sort.php',
        type: 'post',
    })

    req.done(function(res,textStatus, jqXHR){
        if(res=="Success"){
            console.log("Uspesan sort")
            location.reload(true);
        }else console.log("Sort neuspesan "+res);
    })
})

$('#izmeniForm').submit(function(){
    event.preventDefault;
    const checked = $('input[name=checked]:checked');
    const id = checked.val();
    const $form = $(this);
    const $input = $form.find('input, select, button');
    
    let serijalizacija = $form.serialize();
    serijalizacija += "&id=" + encodeURIComponent(id);
    $input.prop('disabled',true);
    
    req = $.ajax({
        url: 'handler/update.php',
        type: 'post',
        data: serijalizacija
    })

    req.done(function(res,textStatus, jqXHR){
        if(res=="Success"){
            alert("Iznajmljivanje uspesno azurirano!");
            location.reload(true);
        }else alert("Iznajmljivanje nije azurirano!");
    })

    req.fail(function(jqXHR,textStatus,errorThrown){
        console.log("Error happened: "+textStatus,errorThrown);
    })

})