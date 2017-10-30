var sourceCode = $('#source-code')
var input = $('#input')
var complierResult = $('complier-result')
var output = $('#output')
var language = $('#language')

$('select').change(function(event){
    if (event.target === $('#language')[0]) {
        return
    }
    var target = $(event.target)
    var type = target.attr('id')
    console.log(target.val())
    sourceCode.css(type, target.val())
})

$('#run').click(function(){
    var params = {
        language: language.val(),
        source: sourceCode.val(),
        input: input.val()
    }

    $.post({
        url: "/run",
        data: params,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(result) {
            output.text(result.result)
        }
    });
})