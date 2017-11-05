var sourceCode = $('#source-code')
var input = $('#input')
var complierResult = $('#complier-result')
var output = $('#output')
var languageButton = $('#language')
var saveButton = $('#save')
var saveModel = $('#save-modal')
var filename = $('#filename')

var csrfToken = $('meta[name="csrf-token"]').attr('content');
var term;
var socket;

languageButton.change(function(event){
    // editor.setOption('mode', 'php')
    // console.log(event.target, $(this).val())
    // if (event.target === $('#language')[0]) {
    //     return
    // }
    // var target = $(event.target)
    // var type = target.attr('id')
    // sourceCode.css(type, target.val())
})

saveButton.click(function () {
    if(sourceCode.val()) {
        saveModel.modal('show');
    } else {
        alert('请输入代码！')
    }
});

$('#run').click(function(){
    var params = {
        language: languageButton.val(),
        source: sourceCode.val(),
        input: input.val()
    };

    $.post({
        url: "/run",
        data: params,
        headers: {'X-CSRF-TOKEN': csrfToken},
        success: function(result) {
            if(result.result) {
                output.text(result.result)
            } else {
                output.text('')
            }
            if(result.error) {
                complierResult.text('编译失败\n' + result.error)
            } else {
                complierResult.text('编译成功')
            }
        }
    });
});

$.ajax({
    url: "/terminals",
    method: 'post',
    headers: {'X-CSRF-TOKEN': csrfToken},
    success: function (result) {
        term = new Terminal({
            cursorBlink: true,
            title: 'online compiler'
        });

        term.open(document.getElementById('terminal'));
        term.fit();
        var protocol = (location.protocol === 'https:') ? 'wss://' : 'ws://';
        var socketURL = protocol + location.hostname + ((location.port) ? (':' + '3000') : '') + '/terminals/';
        socketURL += result.pid;
        socket = new WebSocket(socketURL);
        socket.onopen = runRealTerminal;
    },
    error: function (result) {
        console.log('error', result)
    }
});

//    socket.onclose = runFakeTerminal;
//    socket.onerror = runFakeTerminal;

function runRealTerminal () {
    term.attach(socket);
    term._initialized = true;
}

function submitCode (event) {
    event.preventDefault();

    var params = {
        language: languageButton.val(),
        code: sourceCode.val(),
        filename: filename.val()
    };

    $.post({
        url: "/codes",
        data: params,
        headers: {'X-CSRF-TOKEN': csrfToken},
        success: function(result) {
            saveModel.modal('hide');
        }
    });
}