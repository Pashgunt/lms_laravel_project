$(() => {
    function getTimeRemaining(endtime) {
        let t = Date.parse(endtime) - Date.parse(new Date());
        let seconds = Math.floor((t / 1000) % 60);
        return {
            total: t,
            seconds: seconds
        };
    }

    function initializeClock(endtime) {
        let secondsSpan = document.querySelector(".timer_confirm");

        function updateClock() {
            let t = getTimeRemaining(endtime);

            if (t.total <= 0) {
                clearInterval(timeinterval);
                let deadline = new Date(Date.parse(new Date()) + 6 * 1000);
                initializeClock('countdown', deadline);
            }
            secondsSpan.innerHTML = ("0" + t.seconds).slice(-2);
        }

        updateClock();
        let timeinterval = setInterval(updateClock, 1000);
    }

    let deadline = new Date(Date.parse(new Date()) + 5 * 1000);

    initializeClock(deadline);

    setTimeout(() => {
        document.querySelector('.repeat_message').style.pointerEvents = 'auto';
        $('.timer_confirm').html('Жми')
    }, 5000)
})
