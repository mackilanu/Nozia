



              <div class="panel with-nav-tabs panel-default" >
                <div class="panel-heading">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab1default" data-toggle="tab">Om mig</a></li>
                            <li><a href="#tab2default" data-toggle="tab">Mina favoritföretag</a></li>
                            <li><a href="#tab3default" data-toggle="tab">Byt lösenord</a></li>
                            
                        </ul>
                </div>
                <div class="panel-body">
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="tab1default">
                            
                              <label for="txt_Username">Användarnamn:</label>
             <input type="text" id="txt_Username"  class="form-control txt_dimentions" disabled>

             <label for="txt_Firstname">Förnamn:</label>
             <input type="text" id="txt_Firstname" class="form-control txt_dimentions" disabled>

             <label for="txt_Email">Email:</label>
             <input type="text" id="txt_Email" class="form-control txt_dimentions">

             <label for="txt_Gender">Födelsedag:</label>
             <input type="text" id="txt_Bday" class="form-control txt_dimentions" disabled>

             <label for="txt_Gender">Kön:</label>
             <input type="text" id="txt_Gender" class="form-control txt_dimentions" disabled>

             <label for="txt_Registereds">Registrerad:</label>
             <input type="text" id="txt_Registered" class="form-control txt_dimentions" disabled>
             <br>
             <button class="btn btn-success" onclick="check_Email()">Ändra</button>
                        </div>
                        <div class="tab-pane fade" id="tab2default">Denna funktion är under uppbyggnad. Du kan läsa mer om detta <a href="#">här.</a></div>
                        <div class="tab-pane fade" id="tab3default">
                        	

                        	    <label for="pw_current">Nuvarande lösenord:</label>
                                <input type="password" id="pw_current" class="form-control txt_dimentions">

                                <label for="pw_new">Nytt lösenord:</label>
                                <input type="password" id="pw_new" class="form-control txt_dimentions">

                                 <label for="pw_newAgain">Nytt lösenord igen:</label>
                                <input type="password" id="pw_newAgain" class="form-control txt_dimentions">
                                <br>
                                <button class="btn btn-success" onclick="change_pw()">Genomför</button>
                        </div>
                    
                    </div>
                </div>
            </div>
        </div>



  
            
    