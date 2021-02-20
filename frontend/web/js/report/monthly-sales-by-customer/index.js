$('tbody tr[editurl]').click(function (e) {
    if ($(e.target).is('td')) {
        
    }
});

function getRecordAction(viewPageBaseUrl) {

	var bookcode = $('#searchText').val().trim();
    console.log(viewPageBaseUrl);
    if(bookcode!=undefined && bookcode!='') {
		document.getElementById("searchViewContent").innerHTML =  '<iframe style="width:100%; height: 700px" src="' + viewPageBaseUrl + '/book/view?id=&bookcode=' + bookcode + '"></iframe>';
    }
	
    return false;
}

function getDetailAction(id) {

	document.getElementById("searchViewContent").innerHTML =  '<iframe style="width:100%; height: 700px" src="'
	+ 'http://www.sinyuenko-keith.com/opsys' + '/book/view?id=' + id + '"></iframe>';
   
    return false;
}

function closeModal()
{
    $.pjax.reload({
    container:'#w0-pjax',
    url: $('.grid-view li.active a').attr('href')
    });
}
