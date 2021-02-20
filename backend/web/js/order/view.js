function getRecordAction(id) {
    var bookcode = $('#bookcode').val();
    window.location.assign("view?id=" + id + "&bookcode=" + bookcode);
    return false;
}

// required to show custom element
$( ".kv-attribute" ).each(function( index ) {
    if($(this).find('#showCustomRaw').length >0) {
        $(this).css('display', 'block');
    } 
});