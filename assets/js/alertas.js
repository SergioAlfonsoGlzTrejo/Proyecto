let errors = document.querySelectorAll('.error');
let oks = document.querySelectorAll('.ok');
let infos = document.querySelectorAll('.info');
let warnings = document.querySelectorAll('.warning');

if (errors.length > 0) {
    setTimeout(() => {
        errors.forEach(error => {
            error.style.transition = 'opacity 0.5s';
            error.style.opacity = '0';
        });
        setTimeout(() => {
            errors.forEach(error => error.remove());
        }, 500);
    }, 3000);
}

if (oks.length > 0) {
    setTimeout(() => {
        oks.forEach(ok => {
            ok.style.transition = 'opacity 0.5s';
            ok.style.opacity = '0';
        });
        setTimeout(() => {
            oks.forEach(ok => ok.remove());
        }, 500);
    }, 3000);
}

if (infos.length > 0) {
    setTimeout(() => {
        infos.forEach(info => {
            info.style.transition = 'opacity 0.5s';
            info.style.opacity = '0';
        });
        setTimeout(() => {
            infos.forEach(info => info.remove());
        }, 500);
    }, 5000);
}

if (warnings.length > 0) {
    setTimeout(() => {
        warnings.forEach(warning => {
            warning.style.transition = 'opacity 0.5s';
            warning.style.opacity = '0';
        });
        setTimeout(() => {
            warnings.forEach(warning => warning.remove());
        }, 500);
    }, 3000);
}