<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <!-- <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> -->
      <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="css/stylesMaterialize.css">
    <script src="js/jquery.min.js"></script>
    <link rel="icon" href="img/favicon.png">
      <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Prueba LDAP</title>

    <link rel="stylesheet" href="css/dataTables.bootstrap4.min.css">
    <link href="vendors/pace-progress/css/pace.min.css" rel="stylesheet">

  </head>
  <body>
    <div class="valign-wrapper whole-page bgImg">
      <div class="valign">
        <div class="container">
          <div class="row">
            <div class="col s10 offset-s1">
              <div class="card-panel black round-corners">
                <div class="row hide-on-large-only">
                  <div class="col s12">
                    <img src="img/Continental_Logo_Yellow_sRGB.svg" class="contiLogo">
                  </div>
                </div>
                <div class="row valign-wrapper" style="margin-bottom:0px">
                  <div class="col l6 hide-on-med-and-down">
                    <img src="img/Continental_Logo_Yellow_sRGB.svg" class="contiLogo">
                  </div>
                  <div class="col s12 m12 l6 grey lighten-2 round-corners">
                    <h5 class="black-text center">Prueba LDAP</h5>
                    <h6 class="black-text center">Bienvenido</h6>
                    <form  id='frml' action="{{ route('login') }}" method="post">
                      @csrf
                      <div class="row">
                        <div class="input-field col s12">
                        <label for="samaccountname" class="black-text">uid</label><br>
                          <input id="samaccountname" type="text" class="orangeInput" name="samaccountname" value="{{ old('samaccountname') }}" requried >
                        </div>

                        <div class="input-field col s12">
                        <label for="password" class="black-text">Password</label><br>
                          <input id="password" type="password" class="orangeInput" name="password" required>
                        </div>
                        <div class="col s12">
                          <button type="submit" class="btn waves-effect waves-light right orange" name="button">Login</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
   
  </body>
</html>
