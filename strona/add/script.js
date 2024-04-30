function previewImage(event) {
    var reader = new FileReader();
    reader.onload = function(){
        var img = document.getElementById('img-preview');
        img.style.display = 'block';
        img.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
}

function DateForPending(value) {
    if (value === 'pending') {
        document.getElementById('date-label').style.display = 'block';
        document.getElementById('date').style.display = 'block';
    } else {
        document.getElementById('date-label').style.display = 'none';
        document.getElementById('date').style.display = 'none';
    }
}