function toast({
    title = '',
    message = '',
    type = '',
    duration = 3000
}) {
    const main = document.getElementById('toast');
    if (main) {
        const toast = document.createElement('div');
        const icons = {
            success : 'fa-sharp fa-regular fa-circle-check',
            info : 'fa-solid fa-circle-info',
            warning : 'fa-solid fa-circle-exclamation',
            error : 'fa-solid fa-circle-exclamation'
        };

        // remove toast after duration time
        const autoRemoveId = setTimeout(function() {
            main.removeChild(toast);
        }, duration + 1000);
        
        //remove toast when clicked close button
        toast.onclick = function(e) {
            if (e.target.closest('.toast__close')) {
                main.removeChild(toast);
                clearTimeout(autoRemoveId);
            }
        }

    
        const icon = icons[type];
        const delay = (duration / 1000).toFixed(2);

        toast.classList.add('toast', `toast--${type}`);
        toast.style.animation = `SlideInLeft ease 0.6s, FadeOut linear 1s ${delay}s forwards`;
        toast.innerHTML = `
        <div class="toast__icon">
            <i class="${icon}"></i>
        </div>
        <div class="toast__body">
            <h3 class="toast__title">${title}</h3>
            <p class="toast__mess">${message}</p>
        </div>  
        <div class="toast__close">
            <i class="fa-solid fa-xmark"></i>
        </div>
        `;
        main.appendChild(toast);
    }


}


function ShowSuccess() {
    toast({
        title : 'Thành công',
        message : 'Bạn đã đăng kí thành công !',
        type : 'success',
        duration : 3000
    });
}

function ShowError() {
    toast({
        title : 'Thất bại',
        message : 'Có lỗi xảy ra, vui lòng thử lại sau!',
        type : 'error',
        duration : 3000
    });
}

function ShowWarn() {
    toast({
        title : 'Nguy hiểm',
        message : 'Hãy chắc là bạn muốn làm điều này!',
        type : 'warning',
        duration : 3000
    });
}


