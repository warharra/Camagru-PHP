function addClass(elem) { 
    elem.classList.remove("hidden");
    elem.classList.add("active");
    elem.classList.add("show");
    elem.classList.remove("none");
}
function delClass(elem) {
    elem.classList.remove("active");
    elem.classList.remove("show");
    elem.classList.add("none");
}
function showMenu(id){
    var menus = ['images', 'parametres'];
    var elem = document.getElementById(id);
    var imageActive = document.getElementById("images-tab");
    var paramActive = document.getElementById("param-tab");
    if (id == menus[0]) {
        var menu = document.getElementById(menus[1]);
        imageActive.classList.add("active");
        paramActive.classList.remove("active");
    }
    else {
        var menu = document.getElementById(menus[0]);
        imageActive.classList.remove("active");
        paramActive.classList.add("active");
    }
    delClass(menu);
    addClass(elem);
    menu.classList.add("hidden");
}
var n = 0;
function showOptions( id ) {
    var elem = document.getElementById('delete-'+id);
    if (n % 2)
        elem.classList.add("hidden");
    else
        elem.classList.remove("hidden");
    n++;
}
function like(img) {
    if (img < 0)
        window.location = "login.php";
    var elem = document.getElementById('heart-'+img);
    var likes = document.getElementById('likes-'+img);
    if (!elem.classList.contains("liked")) {
        elem.classList.add("liked");
        likes.innerHTML++;
    }
    else {
        elem.classList.remove("liked");
        likes.innerHTML--;
    }
    var xhr = new XMLHttpRequest();
    xhr.open("POST", 'functions/like.php', true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=UTF-8");
    xhr.withCredentials = true;
    xhr.send('image_ID='+img);
}

function update_user_preferences(user_ID) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", 'functions/update_user_preferences.php', true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=UTF-8");
    xhr.withCredentials = true;
    xhr.send('user_ID='+user_ID);
}




function chcl(color, id) {
    document.getElementById(id).style.color = color;
}
function uploadImage() {
    var form = document.getElementById('upload');
    var input = document.getElementById('select-img');
    var change_running = false;
    if (input) {
        input.addEventListener('change', function() {
            if(!change_running){
                setTimeout(function(){
                    change_running = true;
                    form.submit();
                    change_running = false;     
                }, 300);
            }
        });
    }
}
function openWebcam() {
 var video = document.querySelector("#videoElement");
 var canvas = document.getElementById('canvas');
 var context = canvas.getContext('2d');
 
  
    if (navigator.mediaDevices.getUserMedia) {       
        navigator.mediaDevices.getUserMedia({video: true})
    .then(function(stream) {
        video.srcObject = stream;
    })
    .catch(function(error) {
    });
    }
}
var src_img = "";
function test(image, a) {
    var video = document.querySelector("#videoElement");
    var canvas = document.getElementById('canvas');
    var context = canvas.getContext('2d');
    if(a != 0)
    {
        src_img = document.getElementById("filter_webcam").src = image.src;
        document.getElementById("filter_webcam").className = image.name;
        document.getElementById("filter_webcam").name = image.alt;
    }
    if(a == 0)
    {
        if (navigator.mediaDevices.getUserMedia) {       
            navigator.mediaDevices.getUserMedia({video: true})
        .then(function(stream) {
            video.srcObject = stream;
        })
        .catch(function(error) {
        });
        context.drawImage(video,0,0);
        }
        var dataURL = canvas.toDataURL(video);
        document.getElementById("capture").value = dataURL+src_img;
    }
}
