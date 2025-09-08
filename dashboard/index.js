
let content = document.getElementById("content")
let prev = document.getElementById("prev");
let next = document.getElementById("next");
let offset = 0;
let limit = 5;
let page = document.getElementById("page");
let edt = document.getElementById("editCont");
let addPro = document.getElementById("addCont");
let orgName ;
content.innerHTML = "";



fetch('result.php', {
  method: 'POST',
  headers: {
    'Content-Type': 'application/json'
  },
  body: JSON.stringify({ command: 'run', offset: offset})
})
.then(res => res.json())
.then(data => {console.log('Server response:', data)
              for(let i = 0; i < data.data.length; i++ ){
                content.innerHTML += `<tr><td>${data.data[i].BARCODE}</td><td>${data.data[i].PRODUCT_NAME}</td><td>${data.data[i].PRICE}</td><td><button id="edit" onclick="eDIT(${data.data[i].BARCODE}, '${data.data[i].PRODUCT_NAME}',${data.data[i].PRICE})">edit</button><button id="del" onclick="del('${data.data[i].PRODUCT_NAME}')">delete</button></td></tr>`
              }
              if(data.status  && data.index > 0){
                next.style.display = "inline";
                prev.style.display = "inline";
              }else if(data.status  && data.index == 0){
                next.style.display = "inline";
                prev.style.display = "none";
              }else if(!data.status && data.index > 0){
                next.style.display = "none";
                prev.style.display = "inline";
              }
              //PAGE NUMBER//
              let Page = offset / limit;
              page.innerText = `Page ${Page+1}`;
})

//////////////////////////////////////////////////////////////

next.addEventListener('click', () => {

    content.innerHTML = "";
    offset = offset + limit;
    fetch('result.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({ command: 'run', offset: offset})
  })
  .then(res => res.json())
  .then(data => {console.log('Server response:', data)

                for(let i = 0; i < data.data.length; i++ ){
                  content.innerHTML += `<tr><td>${data.data[i].BARCODE}</td><td>${data.data[i].PRODUCT_NAME}</td><td>${data.data[i].PRICE}</td><td><button id="edit" onclick="eDIT(${data.data[i].BARCODE}, '${data.data[i].PRODUCT_NAME}',${data.data[i].PRICE})">edit</button><button id="del" onclick="del('${data.data[i].PRODUCT_NAME}')">delete</button></td></tr>`;
                }
                
                if(data.status  && data.index > 0){
                  next.style.display = "inline";
                  prev.style.display = "inline";
                }else if(data.status  && data.index == 0){
                  next.style.display = "inline";
                  prev.style.display = "none";
                }else if(!data.status  && data.index > 0){
                  next.style.display = "none";
                  prev.style.display = "inline";
                }

                //PAGE NUMBER//
                let Page = offset / limit;
                page.innerText = `Page ${Page+1}`;
              })

})


///////////////////////////////////////////////////////////////////////////////////////////////////

prev.addEventListener('click', () => {

    content.innerHTML = "";
    offset = offset - limit;
    fetch('result.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({ command: 'run', offset: offset})
  })
  .then(res => res.json())
  .then(data => {console.log('Server response:', data)

                for(let i = 0; i < data.data.length; i++ ){
                  content.innerHTML += `<tr><td>${data.data[i].BARCODE}</td><td>${data.data[i].PRODUCT_NAME}</td><td>${data.data[i].PRICE}</td><td><button id="edit" onclick="eDIT(${data.data[i].BARCODE}, '${data.data[i].PRODUCT_NAME}',${data.data[i].PRICE})">edit</button><button id="del" onclick="del('${data.data[i].PRODUCT_NAME}')">delete</button></td></tr>`;
                }
                
                if(data.status  && data.index > 0){
                  next.style.display = "inline";
                  prev.style.display = "inline";
                }else if(data.status  && data.index == 0){
                  next.style.display = "inline";
                  prev.style.display = "none";
                }else if(!data.status  && data.index > 0){
                  next.style.display = "none";
                  prev.style.display = "inline";
                }

                //PAGE NUMBER//
                let Page = offset / limit;
                page.innerText = `Page ${Page+1}`;
              })
})




class crud{


  del(code){

  fetch('delete.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({del:code})
  })
  .then(res => res.json())
  .then(data => {console.log('Server response:', data)
                 if(data['status']){
                  location.reload()
                 }
  })
  .catch(err => console.error('Error:', err));
  }


 update(){
  let formData = new FormData();
  let file_input = document.getElementById("imageE");
  formData.append("Code", document.getElementById("codeE").value);
  formData.append("Name", document.getElementById("nameE").value);
  formData.append("Price", document.getElementById("priceE").value);
  formData.append("Img", file_input.files[0] ?? '');
  formData.append("Orgname", orgName);
  
  fetch('update.php', {
    method: 'POST',
    body: formData
  })
  .then(res => res.json())
  .then(data => {console.log('Server response:', data)
                  if(data.status){
                    window.alert("Update was succesful");
                    location.reload();
                  }else{window.alert("Update was unsucceful: " + data.errcode);}
  })
  .catch(err => console.error('Error:', err));
  }


  add(){
      let file_input = document.getElementById("imageA");
      if(!(document.getElementById("codeA").value &&  document.getElementById("nameA").value && document.getElementById("priceA").value && file_input.files[0]) ){
        window.alert("Incomplete form");
        return;
      }
      let formData = new FormData();
      
      formData.append("Code", document.getElementById("codeA").value);
      formData.append("Name", document.getElementById("nameA").value);
      formData.append("Price", document.getElementById("priceA").value);
      formData.append("Img", file_input.files[0]);



      fetch('add.php', {
        method: 'POST',
        body: formData
      })
      .then(res => res.json())
      .then(data => {console.log('Server response:', data)

                    if(data['status']){
                      console.log("Succesfully Uploaded");
                      window.alert(data['Name'] + " " + "had succesfully added!");
                      location.reload();}
                      
                    else{console.log(data['errcode']);
                          window.alert(data['errcode'])
                    }           
                    document.getElementById("code").value = '';
                    document.getElementById("name").value = '';
                    document.getElementById("price").value = '';
                    document.getElementById("image").value = '';
      })
      .catch(err => console.error('Error:', err));
  }
}

const action = new crud();


function add(){
  action.add();
}
function del(code){
  action.del(code);
}
function update(){
  action.update();
}
function eDIT(code, name, price){
  orgName = name;
  document.getElementById("codeE").value = code;
  document.getElementById("nameE").value = name;
  document.getElementById("priceE").value = price;
  edt.style.display = "flex";
}


