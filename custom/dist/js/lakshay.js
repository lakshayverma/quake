function showPopup(url) {
    newwindow = window.open(url, "Checklist", 'height=480,width=320,top=50,left=200,location=0,resizable');
    if (window.focus) {
        newwindow.focus()
    }
}

function openEvent(event) {
    if (event > 0) {
        window.location = "http://localhost/events/view_event.php?event=" + event;
    }
}

function modify_task(task_id, status) {
    $.post("./logic/modify_task.php",
            {
                task_id: task_id,
                status: status
            },
            function (response) {
//                alert("Updated :" + response.title + " to " + response.status);
                $("#span-task-" + task_id).html("Updated");
            }, 'json'
            );

}


var notificationsCount = 0;
function attend_event(invitation_id, status) {
    $.post("./logic/attend.php",
            {
                invitation_id: invitation_id,
                status: status
            },
            function (response) {
                $('#invite-' + invitation_id + " div.response").html(response.msg);
            }, 'json'
            );
    notificationsCount--;
    updateNotificationsCount();
}
function notifications(nf) {
    notificationsCount = nf;
    updateNotificationsCount();
}

function updateNotificationsCount() {
    $("#notificationsCount").html(notificationsCount);
}
function fetch_items_of_type(event, type) {
    $.post("./logic/item_options.php",
            {
                type: type,
                event: event
            },
            function (response) {
                $('#item').html(response);
                return response;
            }
    );
}