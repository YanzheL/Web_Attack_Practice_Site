function PostData(formObjId) {
    var childmsg = document.getElementById('post-success-msg-tmp');
    if (childmsg) {
        childmsg.parentNode.removeChild(childmsg);
    }
    var allStr = "";
    var formObj = document.getElementById(formObjId);
    var inputElemsObj = formObj.elements;
    var obj;
    if (inputElemsObj) {
        for (var i = 0; i < inputElemsObj.length; i += 1) {
            obj = inputElemsObj[i];
            if (obj.name != undefined && obj.name != "") {
                allStr += "&" + obj.name + "=" + encodeURIComponent(obj.value);
            }
        }
    }
    $.ajax({
        type : "POST",
        url : formObj.action,
        data : allStr,
        success : function(msg) {
            var successSpan = document.getElementById('success-msg');
            if (successSpan) {
                var msgObj = document.createElement("strong");
                msgObj.innerHTML = "Success";
                msgObj.setAttribute('name', 'msg');
                msgObj.setAttribute('id', 'post-success-msg-tmp');
                successSpan.appendChild(msgObj);
            }

        }
    });
    return false;
}

function DeleteRes(location) {
    var childmsg = document.getElementById('del-success-msg-tmp');
    if (childmsg) {
        childmsg.parentNode.removeChild(childmsg);
    }
    $.ajax({
        type : "DELETE",
        url : location,
        success : function(msg) {
            // alert('success');
            var successSpan = document.getElementById('success-msg');
            var msgObj;
            if (successSpan) {
                msgObj = document.createElement("strong");
                msgObj.innerHTML = "Success";
                msgObj.setAttribute('id', 'del-success-msg-tmp');
                successSpan.appendChild(msgObj);
            }
            var id = location.slice(location.lastIndexOf('/') + 1);
            var child = document.getElementById("article-id-" + id);
            child.parentNode.removeChild(child);
        }
    });
}

function isPicture(inputId) {
    var file = document.getElementById(inputId)
    var check_str = file.value;
    // alert(check_str);
    if (check_str === "") {
        alert("You haven't selected a file");
        return false;
    }

    var file_type = check_str.substring(check_str.lastIndexOf('.') + 1,
        check_str.length);
    file_type = file_type.toLowerCase();
    var allowed = ['jpg', 'jpeg', 'bmp', 'png', 'gif'];
    if (allowed.indexOf(file_type) != -1)
        return true;
    else {
        alert("File Type Error");
        return false;
    }
}

function sha256pass(inputId) {
    var inputObj=document.getElementById(inputId);
    var message=inputObj.value;
    inputObj.value=sha256_digest(message);
    return true;
}
