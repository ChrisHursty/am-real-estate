document.addEventListener("scroll", function() {
    var scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
    var scrollHeight = document.documentElement.scrollHeight || document.body.scrollHeight;
    var clientHeight = document.documentElement.clientHeight || document.body.clientHeight;
    var scrolled = (scrollTop / (scrollHeight - clientHeight)) * 100;

    document.getElementById("progressBar").style.width = scrolled + '%';
});
