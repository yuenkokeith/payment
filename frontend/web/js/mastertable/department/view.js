function showBookcode() {
    $("#book-synopsis").text('udpate data........!!!!!!!!!!');
    return false;
}

function showCustomAction() {
    $("#book-synopsis").text('');
    return false;
}

function updateTextModalAction(id, data) {
    console.log(id + ' | ' +data);
    $("#book-author").val(data);
    $('#book-author_id').val(id);
    return false;
}

function getRecordAction(id) {
    var bookcode = $('#bookcode').val();
    window.location.assign("view?id=" + id + "&bookcode=" + bookcode);
    return false;
}

// show/hide custom element
$( ".kv-attribute" ).each(function( index ) {
    if($(this).find('#showCustomRaw').length >0) {
        $(this).css('display', 'block');
    } 

    if($(this).find('#hideCustomRaw').length >0) {
        $(this).closest("tr").css('display', 'none');
    } 
});


