function previewImage(event) {
    var reader = new FileReader();
    reader.onload = function(){
        var img = document.createElement("img");
        img.src = reader.result;
        var preview = document.getElementById("img-preview");
        preview.innerHTML = '';
        preview.appendChild(img);
        preview.style.display = 'block';
    }
    reader.readAsDataURL(event.target.files[0]);
}

function showDescription() {
    var status = document.getElementById("status").value;
    var descriptionUntil = document.getElementById("description_until");

    if (status === "pending") {
        descriptionUntil.style.display = "block";
    } else {
        descriptionUntil.style.display = "none";
    }
}