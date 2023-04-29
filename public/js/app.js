import "./bootstrap";

import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();

// name channel
window.Echo.private(`App.Models.User.${userId}`).notification((data) => {
    $('unreadNotifications').append(`
    <div class="main-notification-list Notification-scroll" id="unreadNotifications">
    <a class="d-flex p-3 border-bottom "
        href="${data.url}?notifications_id=${ data.id}">
        <div class="notifyimg bg-pink">
            <i class="la la-file-alt text-white"></i>
        </div>
        <div class="mr-3 ">
            <h5 class="notification-label mb-1 text-bold ">${data.title} :
                ${data.user}</h5>
            <div class="notification-subtext">
                ${data.created_at}</div>
        </div>
        <div class="mr-auto">
            <i class="las la-angle-left text-left text-muted"></i>
        </div>
    </a>
</div>
    `);
    let count = Number($('#notifications_count').text())
    count ++;
    if(count > 99){
        count = '99+';
    }
    $('#notifications_count').text(count)
})
