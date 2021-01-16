function escapeHtml(unsafe) {
    return unsafe
         .replace(/&/g, "&amp;")
         .replace(/</g, "&lt;")
         .replace(/>/g, "&gt;")
         .replace(/"/g, "&quot;")
         .replace(/'/g, "&#039;");
}

function printMessages(ini, offset){
            
    let pointer = {
        "ini":ini,
        "offset":offset
    };

    $.ajax({
        data: pointer,
        type: "POST",
        dataType: "json",
        url: "overflowMessage.php",

        success: result =>{
            let dataObject = result["data"];
            let resultLength = dataObject.length;

            if(resultLength > 0){
                let id, message, localdate;
                const timezoneOffset = new Date().getTimezoneOffset();

                let numberOfMessages = resultLength == offset ? offset : resultLength;

                for(let i = 0; i < numberOfMessages; i++){
                    id = dataObject[i]["id"];
                    message = dataObject[i]["message"];
                    serverdate = new Date(dataObject[i]["ts"]);
                    serverdate.setHours(serverdate.getHours() - timezoneOffset/60);

                    let day = serverdate.getDate();
                    let month = serverdate.getMonth() + 1;
                    let year= serverdate.getFullYear();
                    let time = ("0" + serverdate.getHours()).slice(-2) + ":" + ("0" + serverdate.getMinutes()).slice(-2);

                    localdate =  day + "/" +  month + "/" +  year + " - " + time;

                    let match = message.match(/(#)([0-9])+/g);
                    let response = match == null ? "" : match;
                    
                    if(response.length > 0){
                        response.forEach((code, index) => {
                            message = message.replace(code, "<a href='" + response[index] + "'>" + response[index] +"</a>");
                        });
                    }

                    $("#msg-container").append(
                        "<div id='"+ id +"'>=================================<br>" + 
                        "<div id='message'><i>" + escapeHtml(message).replace(/\n/g, "<br/>") + "</i></div>" +
                        "<div id='date'>" + localdate + " #" + id + "</div>" +
                        "=================================<br></div>"
                    );
                }
            }
        },

        error: e =>{
            if(console && console.log ) {
                console.log("Request failed: " +  e);
            }
        }
    });

    return offset;
}

$(window).on("load", function(){
    printMessages(0, 3);
});

$(document).ready(function() {
    let ini = 3;
    let offset = 1;

    $(window).scroll(function() {
        if ($(window).scrollTop() + window.innerHeight >= document.body.scrollHeight) {
            ini += printMessages(ini, offset);
        }
    });
}); 