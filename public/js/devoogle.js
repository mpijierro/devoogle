function htmlSubstring(s, n) {
    var m, r = /<([^>\s]*)[^>]*>/g,
        stack = [],
        lasti = 0,
        result = '';

    //for each tag, while we don't have enough characters
    while ((m = r.exec(s)) && n) {
        //get the text substring between the last tag and this one
        var temp = s.substring(lasti, m.index).substr(0, n);
        //append to the result and count the number of characters added
        result += temp;
        n -= temp.length;
        lasti = r.lastIndex;

        if (n) {
            result += m[0];
            if (m[1].indexOf('/') === 0) {
                //if this is a closing tag, than pop the stack (does not account for bad html)
                stack.pop();
            } else if (m[1].lastIndexOf('/') !== m[1].length - 1) {
                //if this is not a self closing tag than push it in the stack
                stack.push(m[1]);
            }
        }
    }

    //add the remainder of the string, if needed (there are no more tags in here)
    result += s.substr(lasti, n);

    //fix the unclosed tags
    while (stack.length) {
        result += '</' + stack.pop() + '>';
    }

    return result;

}

$(document).ready(function () {
    // Configure/customize these variables.
    var showChar = 150;  // How many characters are shown by default
    var ellipsestext = "...";
    var moretext = "(leer más)";
    var lesstext = "(leer menos)";


    $('.more').each(function () {
        var content = $(this).html();

        if (content.length > showChar) {

            var c = htmlSubstring(content, showChar);

            var h = content.substr(showChar, content.length - showChar);

            var html = c + '<span class="moreellipses">' + ellipsestext + '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';

            $(this).html(html);
        }

    });

    $(".morelink").click(function () {
        if ($(this).hasClass("less")) {
            $(this).removeClass("less");
            $(this).html(moretext);
        } else {
            $(this).addClass("less");
            $(this).html(lesstext);
        }
        $(this).parent().prev().toggle();
        $(this).prev().toggle();
        return false;
    });

    $('.datepicker').datepicker({
        language: 'es',
        format: 'dd-mm-yyyy'
    });


    $(document).on("click", ".open-modal-download-audio", function () {
        var title = $(this).data('title');
        $(".modal-body #modal-resource-title").html(title);

        $('#modal-form-download-audio').attr('action', $(this).data('url'));
        $('.modal-body #modal-channel').attr('href', $(this).data('channel-url'));
        $('.modal-body #modal-channel').html($(this).data('channel-name'));

    });

});