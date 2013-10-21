$(document).ready(function() {

    testservice(
        $("#memcacheform"),
        $("#btnmemcache"),
        $(".memcacheresult")
    );

    testservice(
        $("#couchform"),
        $("#btncouch"),
        $(".couchresult")
    );

    testservice(
        $("#metaform"),
        $("#btnmeta"),
        $(".metaresult")
    );

    testservice(
        $("#reswebform"),
        $("#btnresweb"),
        $(".reswebresult")
    );

    testservice(
        $("#otaresform"),
        $("#btnotares"),
        $(".otaresresult")
    );

    testservice(
        $("#vouchersform"),
        $("#btnvouchers"),
        $(".vouchersresult")
    );

    testservice(
        $("#restform"),
        $("#btnrest"),
        $(".restresult")
    );

    testservice(
        $("#symfform"),
        $("#btnsymf"),
        $(".symfonyresult")
    );

    testservice(
        $("#paramsform"),
        $("#btnparams"),
        $(".paramsresult")
    );

    // Add scrollTo to navigation.
    $('#nav li a').bind('click', function(){
      $.scrollTo( $(this).attr('href'), 800 );
    });
});

function testservice(form, button, result) {
    // This will only work if we added the FOSJsRoutingBundle
    // So instead get it from the form
    // var url=Routing.generate('TestMemcache');
    var url=form.attr("action");

    $.getJSON(
        url,
        function (data) {
            var imgsrc = '';
            if (data.status) {
                imgsrc = $("#passimg").attr('src');
            } else {
                imgsrc = $("#failimg").attr('src')
            }
            if (typeof data.text[1] != 'undefined'){
                if (data.text[1].indexOf("Skip Test") >= 0) {
                    imgsrc = $("#skiptest").attr('src');
                }
            }
            button.attr("src", imgsrc);
            $.each(data.text, function(i, line){
                result.append(" - " + line + "<br />");
            });
            if (typeof data.rows != 'undefined') {
                $.each(data.rows, function(i, line){
                    if (typeof line == 'string') {
                        $('#Parameters + div').find('.appendable > tbody:last').append(
                            '<tr><td colspan="3">' + line + '</td></tr>'
                        );
                    } else if (typeof line['error'] != 'undefined') {
                        $('#Parameters + div').find('.appendable > tbody:last').append(
                            '<tr><td>' + line['error'] + '</td></tr>'
                        );
                    } else {
                        var tr = '<tr>';
                        if (line['status']==2) {
                            tr += '<td>' + line['name'] + '</td>';
                            tr += '<td>' + line['value'] + '</td>';
                            tr += '<td><img src="' + $("#skiptest").attr('src') + '" height="12" widht="12" alt="Info" title="' + line['line'] + '"/></td>';
                        } else if (line['status']) {
                            tr += '<td>' + line['name'] + '</td>';
                            tr += '<td>' + line['value'] + '</td>';
                            tr += '<td><img src="' + $("#passimg").attr('src') + '" height="12" widht="12" alt="Pass" title="' + line['path'] + line['line'] + '"/></td>';
                        } else {
                            tr += '<td>' + line['name'] + '</td>';
                            tr += '<td class="error">' + line['value'] + '</td>';
                            tr += '<td><img src="' + $("#failimg").attr('src') + '" height="12" widht="12" alt="Fail" title="' + line['path'] + line['line'] + '" /></td>';
                        }

                        tr += '</tr>';
                        $('#Parameters + div').find('.appendable > tbody:last').append(tr);
                    }
                });
            }
        }
    );
}
