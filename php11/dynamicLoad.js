class LoadProfile {
    constructor () {
        this.profile = document.getElementById ('profile');
        this.templateStatus = 'pending';
        this.userStatus = 'pending';
    }
    sendTemplateRequest () {
        const loadProfile = this;
        const xhr = new XMLHttpRequest ();
        xhr.timeout = 10_000;
        xhr.responseType = 'text';
        xhr.open ('GET', 'index.php?template=profile');
        xhr.onload = function () {
            if (xhr.status >= 200 && xhr.status < 300) {
                loadProfile.templateStatus = 'success';
                loadProfile.template = xhr.response;
                loadProfile.showProfile ();
            }
            else
                loadProfile.fail ();
        };
        xhr.onerror = this.fail;
        xhr.send ();
    }
    sendUserRequest () {
        const loadProfile = this;
        const xhr = new XMLHttpRequest ();
        xhr.timeout = 10_000;
        xhr.responseType = 'json';
        xhr.open ('GET', 'index.php?get=user');
        xhr.onload = function () {
            if (xhr.status >= 200 && xhr.status < 300) {
                loadProfile.userStatus = 'success';
                loadProfile.user = xhr.response;
                loadProfile.showProfile ();
            }
            else
                loadProfile.fail ();
        };
        xhr.onerror = this.fail;
        xhr.send ();
    }
    fail () {
        this.templateStatus = 'failed';
        this.userStatus = 'failed';
        this.profile.innerHTML = '<img src="img/sadFace.png" />';
    }
    showProfile () {
        if (this.templateStatus === 'success' && this.userStatus === 'success') {
            this.profile.innerHTML = this.template
                .replace ('{{name}}', this.user.name)
                .replace ('{{avatar}}', this.user.avatar);
        }
    }
}

function loadPosts () {
    
}

document.addEventListener ('DOMContentLoaded', function () {
    const load = new LoadProfile ();
    load.sendTemplateRequest ();
    load.sendUserRequest ();

    loadPosts ();
});
