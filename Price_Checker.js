let textField = document.getElementById("textField");
let button = document.querySelector(".input-group button");
let outputText = document.querySelector("#result p");
let image = document.getElementById("result");
let barcode ;
let timer ;

//ADD "ENTER" LISTENER
textField.addEventListener("keypress", (e) => {
  if (e.key === "Enter") {
    button.click();
  }
});


//ADD EVENTLISTENER
button.addEventListener("click", () => {

    //CHECK IF TEXTFIELD HAS VALUE
    if(textField.value) {
      button.disabled = true;
      let formdata = new FormData();
      //GET THE VALUE AND ASSIGN
      formdata.append("value", textField.value.trim())
      barcode = textField.value.trim();

      //SEND POST REQUEST TO PHP

      fetch('Price_Checker.php', {
        method: 'POST',
        body: formdata
      })
      .then(res => res.json())
      .then(data => {console.log('Server response:', data);


                     //CHECK IF ERROR RESPONDS
                     if (data.error) {

                        image.innerHTML = `<p style="color: red; font-size: 13px">${data.error}</p>`;
                        
                        //5 seconds to display and reset time
                        clearTimeout(timer);
                        timer = setTimeout(() => {
                          image.innerHTML = '<p>Item details will appear here...</p>';
                        },5000);


                     }

                     //ELSE DISPLAY PRODUCT AND PRICE
                     else {
                        image.innerHTML = "";
                        image.innerHTML = `<img src="img/${data['PRODUCT_NAME']}.jpg" alt="Product">
                                           <p style="color:white; font-size: 13px">${data.PRODUCT_NAME}  $${data.PRICE}</p>`; 

                        //5 seconds to display and reset time
                        clearTimeout(timer);
                        timer = setTimeout(() => {
                          image.innerHTML = '<p>Item details will appear here...</p>';
                        },5000);
                     }  
      })
      .finally(() => {
      button.disabled = false; // Re-enable button
      textField.value = "";
    });

     
    }else{

      //EMPTY FIELD WILL PROMPT ERROR
      outputText.style.color = "red";
      image.innerHTML = `<p style="color: red; font-size: 13px">Please Enter Barcode!</p>`;


      //5 seconds to display and resert time
      clearTimeout(timer);
      timer = setTimeout(() => {
              image.innerHTML = '<p>Item details will appear here...</p>';
              },5000);
    }
})