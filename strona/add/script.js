function previewImage(event) {
    var reader = new FileReader();
    reader.onload = function(){
        var img = document.getElementById('img-preview');
        img.style.display = 'block';
        img.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
}