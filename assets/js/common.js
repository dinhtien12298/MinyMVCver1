var subMenu = document.getElementsByClassName("sub-menu");
var layerOpacity = document.getElementById("layer-opacity");
var subject = document.getElementsByClassName("subject");
let body = document.getElementsByTagName("body")[0];

if (window.outerWidth > 768) {
    if (subMenu.length > 1) {
        for (i = 1; i < subMenu.length; i++) {
            subMenu[i].style.marginLeft = "-1px";
        }
    }

    function menuAppear() {
        layerOpacity.style.height = body.clientHeight + "px";
    }

    function menuDisappear() {
        layerOpacity.style.height = "0px";
    }
}

function isDisplay() {
    layerOpacity.style.height = body.clientHeight + "px";
    setTimeout(function() {
        document.getElementById("nav").style.marginLeft = "0";
        layerOpacity.style.marginLeft = "0";
        body.style.overflow = "hidden";
    }, 1);
}

function isHidden() {
    document.getElementById("nav").style.marginLeft = `-${0.7 * body.clientWidth}px`;
    layerOpacity.style.marginLeft = "-100%";
    body.style.overflow = "unset";
    setTimeout(function() {
        layerOpacity.style.height = "0";
    }, 1000);
}

for (let i = 0; i < subMenu.length; i++) {
    if (i < subMenu.length && i > subMenu.length - 4 && window.outerWidth > 768) {
        subject[i].style.marginLeft = "-222%";
    }
    subMenu[i].onclick = function() {
        var current = subMenu[i];
        var list_menu_active = document.getElementsByClassName('menu-active');
        if (list_menu_active.length) {
            for (let i = 0; i < list_menu_active.length; i++) {
                if (current == list_menu_active[i]) { continue };
                list_menu_active[i].classList.remove('menu-active');
            }
        }

        if(current.classList.contains('menu-active')){
            current.classList.remove('menu-active');
        }
        else {
            current.classList.add('menu-active');
        }
    }
}

// Scroll to Top
if (document.getElementById("scroll-top")) {
    var scrollTopButton = document.getElementById("scroll-top");
    var html = document.documentElement;

    window.onscroll = function() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            scrollTopButton.style.display = "block";
        } else {
            scrollTopButton.style.display = "none";
        }
    };

    function scrollToTop(totalTime, easingPower) {
        var timeLeft = totalTime;
        var scrollByPixel = setInterval(function () {
            var percentSpent = (totalTime - timeLeft) / totalTime;
            if (timeLeft >= 0) {
                var newScrollTop = html.scrollTop * (1 - Math.pow(percentSpent, easingPower));
                html.scrollTop = newScrollTop;
                timeLeft--;
            } else {
                clearInterval(scrollByPixel);
            }
        }, 1);
    }
}

// Border in Footer Menu Tab
var footerMenuItem = document.getElementsByClassName("footer-menu-item");

if (footerMenuItem.length > 1) {
    footerMenuItem[1].classList.add('border-footer');
    for (i = 2; i < footerMenuItem.length - 1; i++) {
        footerMenuItem[i].classList.add('border-footer');
        footerMenuItem[i].style.marginLeft = "-1px";
    }
}

// Login
var formContainer = document.getElementsByClassName('login-container');
var loginForm = document.getElementsByClassName('login-form');
var closeFormButton = document.getElementsByClassName('close-form');
var loginButton = document.getElementsByClassName('login-button');

for (let i = 0; i < loginButton.length; i++) {
    loginButton[i].onclick = function() {
        formContainer[i].style.display = "block";
        formContainer[i].style.background = "rgba(94, 120, 153, 0.9)";
        document.getElementsByTagName('body')[0].style.overflow = "hidden";
        setTimeout(function() {
            loginForm[i].style.opacity = "1.0"
        }, 100);
    }
}

for (let i = 0; i < closeFormButton.length; i++) {
    formContainer[i].onclick = function(event) {
        if (event.clientX < loginForm[i].offsetLeft
            || event.clientX > loginForm[i].offsetLeft + loginForm[i].clientWidth
            || event.clientY < loginForm[i].offsetTop
            || event.clientY > loginForm[i].offsetTop + loginForm[i].clientHeight
            || (
                event.clientX > closeFormButton[i].offsetLeft + loginForm[i].offsetLeft
                && event.clientX < closeFormButton[i].offsetLeft + loginForm[i].offsetLeft + closeFormButton[i].clientWidth
                && event.clientY > closeFormButton[i].offsetTop + loginForm[i].offsetTop
                && event.clientY < closeFormButton[i].offsetTop + loginForm[i].offsetTop + closeFormButton[i].clientHeight
            )
        ) {
            loginForm[i].style.opacity = "0";
            setTimeout(function() {
                formContainer[i].style.display = "none";
                formContainer[i].style.background = "#ffffff";
                document.getElementsByTagName('body')[0].style.overflow = "unset";
            }, 200);
        }
    }
}

var openOther = document.getElementsByClassName('open-other');

for (let i = 0; i < openOther.length; i++) {
    openOther[i].onclick = function() {
        // Closing
        loginForm[i].style.opacity = "0";
        setTimeout(function() {
            formContainer[i].style.display = "none";
            formContainer[i].style.background = "#ffffff";
            document.getElementsByTagName('body')[0].style.overflow = "unset";
        }, 200);
        // Opening
        setTimeout(function() {
            formContainer[1-i].style.display = "block";
            formContainer[1-i].style.background = "rgba(94, 120, 153, 0.9)";
            document.getElementsByTagName('body')[0].style.overflow = "hidden";
            setTimeout(function() {
                loginForm[1-i].style.opacity = "1.0"
            }, 100);
        }, 200)
    }
}

// Link breadcrumbs
var breadcrumbTags = document.getElementsByClassName('breadcrumb-tag');

for (let i = 0; i < breadcrumbTags.length; i++) {
    breadcrumbTags[i].onclick = function() {
        if (i == 0) {
            window.location.href = `/minyMVC/index.php`;
        }
        else if (i == 1) {
            window.location.href = `/minyMVC/index.php?class=${breadcrumbTags[1].innerHTML}`;
        }
        else if (i == 2) {
            window.location.href = `/minyMVC/index.php?class=${breadcrumbTags[1].innerHTML}&subject=${breadcrumbTags[2].innerHTML}&page=1`;
        }
    }
}

// Searching
const searchBar = document.getElementById('search');
var searchContent = document.getElementsByClassName('search-content')[0];
searchBar.oninput = function () {
    axios({
        method: 'GET',
        url: "/minyMVC/api/searchPostAPI.php",
        params: { "keyword": searchBar.value }
    }).then(response => {
        if (response.data && response.data.length > 0) {
            var posts = response.data;
            var postHTML = posts.map(
                post => `<a class="found-post" data-postId="${ post['id'] }" onclick="directTo('/minyMVC/index.php?post=${ post['id'] }')"><p>${ post['title'] }</p></a>`
            );
            searchContent.innerHTML = `${postHTML.join("")}`;
        }
        if (searchBar.value.length < 1 || response.data.length < 1) {
            searchContent.innerHTML = ``;
        }
    }).catch(error => { console.log(error) });
}

function directTo(place) {
    window.location.href = place;
    searchContent.innerHTML = ``;
}

// logOut
function logOut() {
    var confirmCheck = confirm('Bạn có chắc chắn muốn đăng xuất?');
    if (confirmCheck) {
        window.location.href = '/minyMVC/index.php?logout';
    }
}

// loginAPI

if (document.getElementsByClassName('login-user')[0]) {
    var loginUser = document.getElementsByClassName('login-user')[0];
    loginUser.onclick = function(event) {
        event.preventDefault();
        var username = document.getElementsByClassName('username-input-login')[0].value;
        var password = document.getElementsByClassName('password-input-login')[0].value;
        var loginMessages = document.getElementsByClassName('login-messages')[0];
        axios({
            method: 'GET',
            url: '/minyMVC/api/loginAPI.php',
            params: {
                'username': username,
                'password': password
            }
        }).then(response => {
            if (response.data) {
                var message = response.data;
                if (message == 'Đăng nhập thành công!') {
                    window.location.href = `/minyMVC/index.php?loginAction&username=${username}`;
                } else {
                    loginMessages.innerHTML = message;
                }
            }
        }).catch(error => console.log(error));
    }
}

// signupAPI
if (document.getElementsByClassName('signup-user')[0]) {
    var loginUser = document.getElementsByClassName('signup-user')[0];
    loginUser.onclick = function(event) {
        event.preventDefault();
        var confirmCheck = confirm('Bạn đã chắc với thông tin của mình chưa?');
        if (confirmCheck) {
            const username = document.getElementsByClassName('username-input')[0].value;
            const fullname = document.getElementsByClassName('fullname-input')[0].value;
            const password = document.getElementsByClassName('password-input')[0].value;
            const confirmPassword = document.getElementsByClassName('confirm-password-input')[0].value;
            const birth = document.getElementsByClassName('birth-input')[0].value;
            const phone = document.getElementsByClassName('phone-input')[0].value;
            const email = document.getElementsByClassName('email-input')[0].value;
            const working = document.getElementsByClassName('working-input')[0].value;
            var signupMessages = document.getElementsByClassName('signup-messages')[0];
            axios({
                method: 'GET',
                url: '/minyMVC/api/signupAPI.php',
                params: {
                    'username': username,
                    'fullname': fullname,
                    'password': password,
                    'confirm_password': confirmPassword,
                    'birth': birth,
                    'phone': phone,
                    'email': email,
                    'working': working
                }
            }).then(response => {
                if (response.data) {
                    var message = response.data;
                    if (message == 'Đăng ký thành công!') {
                        window.location.href = `/minyMVC/index.php?loginAction&username=${username}`;
                    } else {
                        signupMessages.innerHTML = message;
                    }
                }
            }).catch(error => console.log(error));
        }
    }
}