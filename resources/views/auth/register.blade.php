<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Page</title>
</head>
<style>
    body {font-family: Arial, Helvetica, sans-serif;}
    
    /* Full-width input fields */
    input[type=text], input[type=password] {
      width: 100%;
      padding: 12px 20px;
      margin: 8px 0;
      display: inline-block;
      border: 1px solid #ccc;
      box-sizing: border-box;
    }
    .wrapper{
        margin: auto;
        width: 30%;
        border: 3px solid #181718;
        padding: 10px;
        margin-top: 5%;
        border-radius: 10px;
    }
    
    /* Set a style for all buttons */
    button {
      background-color: #7911da;
      color: white;
      padding: 14px 20px;
      margin: 8px 0;
      font-size: 17px;
      border: none;
      cursor: pointer;
      width: 100%;
      border-radius: 5px;
    }
    
    button:hover {
      opacity: 0.8;
    }

    .imgcontainer {
      text-align: center;
      margin: 24px 0 12px 0;
      position: relative;
    }
    
    img.avatar {
      width: 40%;
      border-radius: 50%;
    }
    
    .wrapper .container {
      padding: 16px;
    }
    
    span.psw {
      float: right;
      padding-top: 16px;
    }
    

   /* .wrapper .container {
      position: fixed;
      z-index: 1;
      left: 0;
      top: 0;
      width: 30%; 
      height: 100%;
      overflow: auto;
      padding-top: 60px;
    } */
    input,
.btn {
  padding: 12px 0px;
  border: none;
  border-radius: 4px;
  margin: 5px 0;
  opacity: 0.85;
  display: inline-block;
  font-size: 17px;
  line-height: 20px;
  text-decoration: none; /* remove underline from anchors */
}

input:hover,
.btn:hover {
  opacity: 1;
}

/* add appropriate colors to google buttons */

.google {
  background-color: #dd4b39;
  color: white;
  width: 100%;
  text-align: center;
}

    </style>
<body>
        <div class="wrapper">
          <form action="{{ route('register') }}" method="POST">
            @csrf
            <div class="imgcontainer">
                <h3>Registration Form</h3>
                {{-- <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span> --}}
                <img src="{{ asset('assets/images/login.gif') }}" alt="Avatar" class="avatar">
            </div>
            <div>
                <label for="name"><b>Username</b></label>
                <input type="text" placeholder="Enter Username" name="name" required>
            </div>
            <div>
                <label for="email"><b>Email</b></label>
                <input type="text" placeholder="Enter Username" name="email" required>
                @if ($errors->has('email')) <small
                style="color: red">{{ $errors->first('email') }}</small> @endif
            </div>
            
            <div>
                <label for="password"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="password" required>
                @if ($errors->has('password')) <small
                style="color: red">{{ $errors->first('password') }}</small> @endif
            </div>        
            <div>
                <label for="confirm_password"><b>Retype Password</b></label>
                <input type="password" placeholder="Enter Password" name="confirm_password" required>
            </div>        
                
            <div>
                <button type="submit">Sign in</button>
            </div>
          </form>
            {{-- <div>
                <a href="#" class="google btn"><i class="fa fa-google fa-fw">
                    </i> Login with Google+
                </a>
            </div> --}}
        </div>
</body>
</html>