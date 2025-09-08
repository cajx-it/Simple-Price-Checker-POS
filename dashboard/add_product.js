
let form = document.getElementById("form");
form.addEventListener('submit', (e) => {
    e.preventDefault();
    let formData = new FormData();
    let file_input = document.getElementById("image");
    formData.append("Code", document.getElementById("code").value);
    formData.append("Name", document.getElementById("name").value);
    formData.append("Price", document.getElementById("price").value);
    formData.append("Img", file_input.files[0]);



    fetch('add.php', {
      method: 'POST',
      body: formData
    })
    .then(res => res.json())
    .then(data => {console.log('Server response:', data)

                   if(data['status']){
                    console.log("Succesfully Uploaded");
                    window.alert(data['Name'] + " " + "had succesfully added!");}
                   
                   else{console.log(data['errcode']);
                         window.alert(data['errcode'])
                   }

                  
                   document.getElementById("code").value = '';
                   document.getElementById("name").value = '';
                   document.getElementById("price").value = '';
                   document.getElementById("image").value = '';
    })
    .catch(err => console.error('Error:', err));
})
