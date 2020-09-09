/* 
 * Created By Udaaan Digital Team
 * Anurag/  21-Feb-2017 7:37:34 PM
 * All Rights Reserved (c)
 */

//Global Variables
//var $website = 'http://members.udaaan.org/';
var $website = 'http://localhost/portal/';

$(document).ajaxStart($.blockUI).ajaxStop($.unblockUI);
//function toolTipText(){
//    console.log("asdad");
//    $('[data-toggle="tooltip"]').tooltip(); 
//    console.log("xzxzxxzzx");
//}


//// Tooltip only Text
//$('.toolTip').hover(function(){
//        // Hover over code
//        var title = $(this).attr('title');
//        console.log (title);
//        $(this).data('tipText', title).removeAttr('title');
//        $('<p class="tooltip"></p>')
//        .text(title)
//        .appendTo('body')
//        .fadeIn('slow');
//}, function() {
//        // Hover out code
//        $(this).attr('title', $(this).data('tipText'));
//        $('.tooltip').remove();
//}).mousemove(function(e) {
//        var mousex = e.pageX + 20; //Get X coordinates
//        var mousey = e.pageY + 10; //Get Y coordinates
//        $('.tooltip')
//        .css({ top: mousey, left: mousex });
//});
//}


//Call functions when Page is loaded completely
//$(document).ready(
//        toolTipText()
//        );

$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
});


//id, on which error has to be applied
//state, if is to add error or to remove
//1=>True(for error)
//0=>False(to remove error)
function input_error(id, state){
    var div = $('#'+id).closest('div');
    console.log(div);
//    var span = $('#'+id).closest('span');
    if(state==='1'){
        div.addClass("has-error");
//        span.addClass("error");
    }else if(state==='0'){
        div.removeClass("has-error");
//        span.removeClass("error");
    }
    return false;
}

function approve(uid,approver){
    var mem_dep = $("#"+uid+"_dep").find(":selected").text();
    var mem_des = $("#"+uid+"_des").find(":selected").text();
    if(mem_dep==="Udaaan" || mem_des==="New Member"){
        alert('Please Choose Appropriate Department and Designation');
    }else{
        $.ajax({
            type:'POST',
            url: $website+'profile/ajax/approve.php',
            cache: false,
            data: "uid="+uid+"&dep="+mem_dep+"&des="+mem_des+"&approver="+approver,
            success: function(data){
                if(data === "Success"){
                    alert("Data Updated Successfully..!!");
                    window.location.href = $website+"profile/action.php?action=approval";
                }else if(data === "TO"){
                    window.location.href = $website+"profile/timedout.php";
                }else{
                    alert(data+"<br/>Some error occured in updating data, please contact administrator..!!");
                }
                console.log(data);
            }
        });
    }
}

function reject(uid,rejector){
    $.ajax({
        type:'POST',
        url: $website+'profile/ajax/reject.php',
        cache: false,
        data: "uid="+uid+"&rejector="+rejector,
        success: function(data){
            if(data === "Success"){
                alert("Rejected Successfully..!!");
                window.location.href = $website+"profile/action.php?action=approval";
            }else if(data === "TO"){
                    window.location.href = $website+"profile/timedout.php";
            }else{
                alert(data+"<br/>Some error occured in updating data, please contact administrator..!!");
            }
        }
    });
}

function createMail(uname,uid){
    var created_mail = $("#"+uname+"_mail").val();
    var created_pwd = $("#"+uname+"_pwd").val();
    if(created_mail==="" || created_pwd===""){
        alert('Please Enter Email and Password Both');
    }else{
        $.ajax({
            type:'POST',
            url: $website+'profile/ajax/createMailCreds.php',
            cache: false,
            data: "email="+created_mail+"&pwd="+created_pwd+"&uid="+uid,
            success: function(data){
                if(data === "Success"){
                    alert("Mail sent Successfully..!!");
                    window.location.href = $website+"profile/action.php?action=sendCreds";
                }else if(data === "TO"){
                    window.location.href = $website+"profile/timedout.php";
                }else{
                    alert(data+"<br/>Some error occured in updating data, please contact administrator..!!");
                }
                console.log(data);
            }
        });
    }
}

function openModal(uname){
    $.ajax({
        type:'POST',
        url: $website+'profile/ajax/openModal.php',
        cache: false,
        data: "uname="+uname,
        success: function(data){
            if(data === uname){
                alert(uname);
            }else if(data === "TO"){
                alert("To");
            }else{
                alert(data+"<br/>Some error occured in updating data, please contact administrator..!!");
            }
            console.log(data);
        }
    });
}