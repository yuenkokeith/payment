$('tbody tr[editurl]').click(function (e) {
    if ($(e.target).is('td')) {
        
    }
});

function getRecordAction(viewPageBaseUrl) {
    var bookcode = $('#searchText').val().trim();
    console.log(viewPageBaseUrl);
    if (bookcode != undefined && bookcode != '') {
        document.getElementById("searchViewContent").innerHTML = '<iframe style="width:100%; height: 700px" src="' + viewPageBaseUrl + '/book/view?id=&bookcode=' + bookcode + '"></iframe>';
    }
    return false;
}

function viewDetail(id, controller) {
    var height = Math.round(screen.height / 10);
    var width = Math.round(screen.width / 4);
    window.open(controller + "/view?id=" + id, "_blank", "location=no,titlebar=no,status=no,menubar=no,toolbar=no,top=" + height + ",left=" + width + ",width=800,height=800", false);
}

function getViewAction(id, controller, viewPageBaseUrl) {
    document.getElementById("searchViewContent").innerHTML = '<iframe style="width:100%; height: 700px" src="' + viewPageBaseUrl + '/' + controller + '/view?id=' + id + '"></iframe>';
    return false;
}

function getCreateAction(controller, viewPageBaseUrl) {

    console.log(controller);
    console.log(viewPageBaseUrl);

    document.getElementById("searchViewContent").innerHTML = '<iframe style="width:100%; height: 700px" src="' + viewPageBaseUrl + '/' + controller + '/create"></iframe>';
    return false;
}

function closeModal() {
    $.pjax.reload({ // w0-pjax
        container: '#w0-pjax',
        url: $('.grid-view li.active a').attr('href')
    });
}
