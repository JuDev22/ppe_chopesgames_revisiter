function loader(){
    if (window.onload) {
        document.getElementById('body').classList.add('d-none');
        document.getElementById('loader').classList.remove('d-none');
    } else{
        document.getElementById('body').classList.remove('d-none');
        document.getElementById('loader').classList.add('d-none');
    }
}
window.addEventListener("load", function() {
    alert("Your page is loaded");
}, false);