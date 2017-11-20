<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
    setlocale(LC_ALL,"es_ES");
    session_start();
    if($_SESSION['logueado']){
 ?>
    <html>
        <head>
            <title>Insertar datos - L'Horta Jove</title>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" type="text/css" href="css/insertar_datos.css">
            <!-- vinculando a libreria Jquery-->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
            <!-- Libreria java script de bootstrap -->
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" crossorigin="anonymous"></script>
        </head>
        <body>
            <div class="landing-page">
                <div class="form-appointment">
                    <div class="wpcf7" id="wpcf7-f560-p590-o1">
                        <form action="/landing-page-template-do-not-delete/#wpcf7-f560-p590-o1" method="post" class="wpcf7-form" novalidate="novalidate" _lpchecked="1">
                            <div style="display: none;">
                                <input type="hidden" name="_wpcf7" value="560">
                                <input type="hidden" name="_wpcf7_version" value="3.5">
                                <input type="hidden" name="_wpcf7_locale" value="">
                                <input type="hidden" name="_wpcf7_unit_tag" value="wpcf7-f560-p590-o1">
                                <input type="hidden" name="_wpnonce" value="dbb28877d5">
                            </div>
                            <div class="group">
                                <div style="width: 48%; float: left;">
                                    <h4>Fecha y hora del riego</h4>
                                    <input type="date" name="fecha" value="" size="45">
                                    <input type="time" name="tiempo" value="" size="45"><br>
                                    <h4>Datos del riego</h4>
                                    <p style="margin-left: 15px; margin-bottom: 2px;font-size:14px;"><strong>Parcela: </strong>
                                        <select name="OS">
                                            <option value="1">Parcela nº 1</option> 
                                            <option value="2">Parcela nº 2</option> 
                                            <option value="3">Parcela nº 3</option>
                                        </select>
                                    </p><br>
                                    <p style="margin-left: 15px;margin-top: 2px;font-size:14px;"><strong>Caballón: </strong>
                                        <select name="OS">
                                            <option value="1">Caballón nº 1</option> 
                                            <option value="2">Caballón nº 2</option> 
                                            <option value="3">Caballón nº 3</option> 
                                            <option value="4">Caballón nº 4</option> 
                                            <option value="5">Caballón nº 5</option> 
                                            <option value="6">Caballón nº 6</option>
                                            <option value="7">Caballón nº 7</option>
                                            <option value="8">Caballón nº 8</option>
                                            <option value="9">Caballón nº 9</option>
                                            <option value="10">Caballón nº 10</option>
                                            <option value="11">Caballón nº 11</option>
                                            <option value="12">Caballón nº 12</option>
                                        </select>
                                    </p><br>
                                    <span class="wpcf7-form-control-wrap textarea-398"><textarea name="textarea-398" cols="40" rows="10" class="wpcf7-form-control wpcf7-textarea" placeholder="Special notes, concerns, or requirements"></textarea></span>
                                </div>
                                <div style="width: 48%; float: right;">
                                        <h4>What is the best way to reach you?</h4>
                                            <p><span class="wpcf7-form-control-wrap radio-98"><span class="wpcf7-form-control wpcf7-radio"><span class="wpcf7-list-item">
                                            <label><input type="radio" name="radio-98" value="Phone">&nbsp;<span class="wpcf7-list-item-label">Phone</span></label></span><span class="wpcf7-list-item">
                                            <label><input type="radio" name="radio-98" value="Email">&nbsp;<span class="wpcf7-list-item-label">Email</span></label></span></span></span></p>
                                        <h4>Days of the week you are available for appointment:</h4>
                                            <p><span class="wpcf7-form-control-wrap checkbox-465"><span class="wpcf7-form-control wpcf7-checkbox"><span class="wpcf7-list-item">
                                                            <label><input type="checkbox" name="checkbox-465[]" value="Monday">&nbsp;<span class="wpcf7-list-item-label">Monday</span></label></span><span class="wpcf7-list-item"><label><input type="checkbox" name="checkbox-465[]" value="Tuesday">&nbsp;<span class="wpcf7-list-item-label">Tuesday</span></label></span><span class="wpcf7-list-item"><label><input type="checkbox" name="checkbox-465[]" value="Wednesday">&nbsp;<span class="wpcf7-list-item-label">Wednesday</span></label></span><span class="wpcf7-list-item"><label><input type="checkbox" name="checkbox-465[]" value="Thursday">&nbsp;<span class="wpcf7-list-item-label">Thursday</span></label></span><span class="wpcf7-list-item"><label><input type="checkbox" name="checkbox-465[]" value="Friday">&nbsp;<span class="wpcf7-list-item-label">Friday</span></label></span></span></span></p>
                                        <h4>Best time of day for your appointment:</h4>
                                            <p><span class="wpcf7-form-control-wrap checkbox-246"><span class="wpcf7-form-control wpcf7-checkbox"><span class="wpcf7-list-item"><label><input type="checkbox" name="checkbox-246[]" value="Morning">&nbsp;<span class="wpcf7-list-item-label">Morning</span></label></span><span class="wpcf7-list-item"><label><input type="checkbox" name="checkbox-246[]" value="Afternoon">&nbsp;<span class="wpcf7-list-item-label">Afternoon</span></label></span></span></span></p>
                                </div>
                                </div>
                            <div style="text-align: center; padding-top: 2em; border-top: 1px solid rgb(153, 202, 129); margin-top: 1em;">
                                <input type="submit" value="Request My Appointment" class="wpcf7-form-control wpcf7-submit">
                                <img class="ajax-loader" src="http://www.professionalaudiologicalservices.com/wp-content/plugins/contact-form-7/images/ajax-loader.gif" alt="Sending ..." style="visibility: hidden;">
                            </div>
                            <div class="wpcf7-response-output wpcf7-display-none"></div>
                        </form>
                    </div>
                </div>
            </div>
        </body>
    </html>
       <?php             
		 }
            ?>