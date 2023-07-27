// things to do

// forgot password

window.onload = function(){

    let links = document.querySelectorAll(".link");
    links.forEach(btn =>{
        btn.addEventListener('click',(event)=>{
            event.preventDefault();
        })
    });

    let login = document.querySelectorAll(".login-btn");
    login.forEach(btn =>{
        btn.addEventListener('click',()=>{
            loginSetup();
        })
    });
    
    let signup = document.querySelectorAll(".signup-btn");
    signup.forEach(btn =>{
        btn.addEventListener('click',()=>{
            signupSetup();
        })
    });

    let loginform = document.querySelector(".login-form");
    loginform.addEventListener('submit',(evnt)=>{
        let email = document.querySelector("input[name='email']").value;
        let password = document.querySelector("input[name='password']").value;

        if (email === ""){
            alert("Please, Enter your Email!");
            evnt.preventDefault();
        }
        else if (password === ""){
            alert("Please, Enter your Password!");
            evnt.preventDefault();
        }
        else if ( ! ValidateEmail(email)){
            alert("Please, Enter a valid email!");            
            evnt.preventDefault();
        }
    });

    let signupform = document.querySelector(".signup-form");
    signupform.addEventListener('submit',(evnt)=>{
        let name = document.querySelector("input[name='name']").value;
        let email = document.querySelectorAll("input[name='email']")[1].value;
        let password = document.querySelectorAll("input[name='password']")[1].value;
        let confpassword = document.querySelector("input[name='confpassword']").value;

        if (name === ""){
            alert("Please, Enter your name!");
            evnt.preventDefault();
        }
        else if (email === ""){
            alert("Please, Enter your Email!");
            evnt.preventDefault();
        }
        else if (password === ""){
            alert("Please, Enter a Password!");
            evnt.preventDefault();
        }
        else if ( ! ValidateEmail(email)){
            alert("Please, Enter a valid email!");            
            evnt.preventDefault();
        }
        else if (confpassword === ""){
            alert("Please, Confirm the password!");
            evnt.preventDefault();
        }
        else if (confpassword !== password){
            alert("Password and Password Confirmation aren't matching. Please, Confirm the password correctly!");
            evnt.preventDefault();
        }

    });

}

function loginSetup(){
    let heading = document.querySelector("h1");
    heading.innerHTML = "Login";

    let toploginbtn = document.querySelector(".switch .login-btn");
    toploginbtn.classList.add("active");

    let topsignupbtn = document.querySelector(".switch .signup-btn");
    topsignupbtn.classList.remove("active");

    let loginform = document.querySelector(".login-form");
    loginform.classList.remove("d-none");
    
    let signupform = document.querySelector(".signup-form");
    signupform.classList.add("d-none");
}

function signupSetup(){
    let heading = document.querySelector("h1");
    heading.innerHTML = "Sign Up";

    let toploginbtn = document.querySelector(".switch .login-btn");
    toploginbtn.classList.remove("active");

    let topsignupbtn = document.querySelector(".switch .signup-btn");
    topsignupbtn.classList.add("active");

    let loginform = document.querySelector(".login-form");
    loginform.classList.add("d-none");
    
    let signupform = document.querySelector(".signup-form");
    signupform.classList.remove("d-none");
}

function ValidateEmail(mail) 
{
    if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(mail))
        return (true);
    return (false);
}
