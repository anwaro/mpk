/* global url */

function addTramStop(el) {
    var div = $("#example").clone();
    div.attr("id", "").addClass('tramS');

    div.find(".iconp").click(function () {
        addTramStop($(this));
    });

    div.find('.iconm').click(function () {
        remove($(this));
    });

    el.parent().parent().after(div);
}

function remove(el) {
    el.parents('.tramS').remove();
}




$(function () {

    $(".iconp").click(function () {
        addTramStop($(this));
    });

    $("#captcha").click(function () {
        $(this).css("background", "#197D62");
        $("input[type=submit]").show().prop('disabled', false);
    });

    $(".settime").click(function () {setTime();});

    $('.iconh').click(function () { removeTime($(this));});


    $('.iconhp').click(function () {
        addNewTime();
    });
    
    $('.icone').click(function () {
         editTime($(this));
    });
    
    $(".iconhe").click(function(){
        $(".iconhp").show();
        $(".iconhe").hide();
        removeTime($( "input[value='" + $(".valhidden").val()+"'].tim" ));
        addNewTime();
    });

});


function setTime(){
    var select = $("select");
    $("input.input1").val("").prop('disabled', true);
    var tr = [];
    for (var i = 0; i < select.length - 1; i++) {
        tr.push(select[i].value);
    }
    $.post(url + 'line/times', {tramstop: JSON.stringify(tr)}, function (data) {
        var data = JSON.parse(data);
        var input = $("input.input1");
        for (var i = 0; i < input.length - 1; i++) {
            if (data[i]) {
                input[i].value = data[i];
            }
            else {
                input[i].disabled = false;
            }

        }
    });
    
}

function removeTime(el){
    if (el.parents(".row-mins").children().length === 1) {
        el.parents(".row").remove();
    }
    else {
        el.parent().remove();
    }
}

function editTime(el){

    var root = el.parent();
    var time = root.find('.tim').val();  
    var tram = root.find('.tra').val();
    var driver = root.find('.dri').val();
    $(".iconhp").hide();
    $(".iconhe").show();

    $("#newtime").val(time);
    $("#tram").val(tram);
    $("#driver").val(driver);
    $(".valhidden").val(time);
    
}

function addNewTime(){
    var val = $("#newtime").val();
    var driver = $("#driver").val();
    var tram =  $("#tram").val();
    
    if (/[0-9]{1,2}:[0-9]{0,2}/.test(val)) {
        var tim = val.split(':');
        var h = tim[0].length < 2 ? ("0" + tim[0]) : tim[0];
        var m = tim[1].length < 2 ? ("0" + tim[1]) : tim[1];
        
        var cell = createCell(m, val, driver, tram);


        var rows = $('.column6').children();
        var len = rows.length;

        if(len ===0 ){
            var row = newRow(h, cell);
            $('.column6').append(row);

        }
        for (var i = 0; i < len; i++) {
            var el = $(rows[i]);

            if (parseInt(el.data('h')) === parseInt(h)) {
                insertInRow(el, m, cell);
                break;
            }
            else if(i===0 && parseInt(el.data('h')) > parseInt(h)){
                var row = newRow(h,cell);
                el.before(row);
                break;
            }                
            else if (i === len - 1 || 
                    (parseInt(el.data('h')) < parseInt(h) && parseInt($(rows[i + 1]).data('h')) > parseInt(h))) {

                var row = newRow(h, cell);
                el.after(row);
                break;

            }
        }

    } else {

    }
}


function newRow(h, kom) {
    var div = $("<div data-h='"+h+"'></div>");
    div.addClass("row");
    div.append($("<div></div>")
            .addClass("row-hour").text(h))
            .append($("<div class='row-mins'></div>")
                .append(kom));
    
    return div;
}

function insertInRow(cell,min, kom) {
    var cells = cell.find('.row-mins').children();
    var len = cells.length;
    
    if(len === 0){
        cells.find('.row-mins').append(kom);
    }

    for (var i = 0; i < len; i++) {
        var el = $(cells[i]);
        if (parseInt(el.text()) === parseInt(min)) {
            break;
        }
        else if(i===0 && parseInt(el.text()) > parseInt(min)){
            $(cell.find('.row-mins').children()[i]).before(kom);
            break;
        }  
        else if (i === len - 1 || 
                (parseInt(el.text()) < parseInt(min) && parseInt($(cells[i + 1]).text()) > parseInt(min))) {
            $(cell.find('.row-mins').children()[i]).after(kom);
            break;
        }
    }
    
    return cell;

}


function createCell(m, time, driver, tram){
    
    var el = $('<span class="cell-min">') ;
        el.text(m);
        el.append('<input class="tra" type="hidden" name="tramid[]" value="'+tram+'">') ;
        el.append('<input class="dri" type="hidden" name="driverid[]" value="'+driver+'">' );
        el.append('<input class="tim" type="hidden" name="schedule[]" value="'+time+'">');
        el.append($('<span class="icons iconh icon-minus-sign"></span>').click(function(){removeTime($(this));}));
        el.append($('<span class="icons icone icon-edit"></span>').click(function(){editTime($(this));}));
        
        
        return el;
     
}

function writeTime(evt, el) {
    var string = String.fromCharCode(evt.charCode);

    if (el.value.length === 5) {
        return;
    }
    else if (el.value.length === 1 && string === ":"){
        el.value = "0" + el.value + ":";
    }
    else if (string === ":" && el.value.length === 2) {
        el.value = parseInt(el.value) % 60 + ":";

    }
    else if (/\d/.test(string)) {
        if (el.value.length === 0) {
            string = string > 2 ? "0" + string + ":" : string;
        }
        if (el.value.length === 1){
            if(el.value == 2){
                string = string > 3 ? 4  + ":": string + ":";
            }else{
                string = string + ":";
            }
            
        }
        if (el.value.length === 3) {
            string = string > 5 ? 5 : string;
        }
        el.value = el.value + string;

    }
}