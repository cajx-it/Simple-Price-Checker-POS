let user_name = document.getElementById("user_name");
let password = document.getElementById("password");
let login = document.getElementById("login");
let err = document.getElementById("error");

login.addEventListener('submit', (e) => {
    e.preventDefault();
    fetch('login.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({ username: user_name.value, pass: password.value })
    })
    .then(res => res.json())
    .then(data => {console.log('Server response:', data)
                   if(data == "Success"){
                    location.reload();
                   }else{
                    user_name.value = '';
                    password.value = '';  
                    err.innerText = "Log In Error!";
                   }
    })
    .catch(err => console.log(err));
})