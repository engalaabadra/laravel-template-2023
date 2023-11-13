if (AuthId != null) {
    window.Echo.channel(`events-${AuthId}`)
        .listen('.RealTimeMessage', (e) => {
            let data = e.data;

            let locale = LANG === 'ar' ? 'ar-EG' : 'en-GB';
            let created_at_date = new Date().toLocaleDateString(locale, {
                day: 'numeric',
                month: 'long',
                year: 'numeric'
            });

            let created_at_time = new Date().toLocaleTimeString('en-US', {
                hour: '2-digit',
                minute: '2-digit'
            }).replace('AM', 'am').replace('PM', 'pm');

            if (LANG === 'ar') {
                created_at_time = created_at_time.replace('am', 'ص').replace('pm', 'م');
            }

            let NotificationElm = $('.notification-number');
            if (Number.parseInt(NotificationElm.text().trim()) >= 99) {
                NotificationElm.text('99+');
                NotificationElm.css({
                    'width': '22px',
                    'height': '22px',
                    'line-height': '22px',
                    'font-size': '.8rem'
                });
            } else {
                NotificationElm.text(+NotificationElm.text().trim() + 1);
            }

            if ($('.notification-img').length !== 0) {
                $('.notification-img').parent().remove();
                $('.notification-footer').css('display', 'block');
            }

            let fullUrl = 'javascript:;';
            if (data.url !== 'javascript:;' || data.url !== undefined) {
                fullUrl = HOST_URL + data.url;
            }

            let NotificationMarkup = `<a href="${fullUrl}" class="dropdown-item new-notification">
                <div class="content-cont">
                    <h4 class=" title">${data.title}</h4>
                    <p class="content">${data.message}</p>
                    <div class="time">
                        <span class="text-muted  mt-1">
                            <i class="flaticon-event-calendar-symbol" ></i>
                            ${created_at_date}
                        </span>
                        <span class="text-muted  mt-1">
                            <i class="fa fa-clock" aria-hidden="true"></i>
                             ${created_at_time}
                        </span>
                    </div>
                </div>
            </a>`

            if ($('.notification-dropdown .dropdown-items-container').children().length >= 15) {
                $('.notification-dropdown .dropdown-items-container').children().last().remove();
            }
            $('.notification-dropdown .dropdown-items-container').prepend(NotificationMarkup);
        });
}
