<?php
include "FH3/src/class.FormHandler.php";
fh_conf('FH_FHTML_DIR', 'FH3/src/FHTML/');

//crea un nuevo objeto FormHandler
$form = new FormHandler();

//some fields.. (see manual for examples)
$form -> addLine("Campo de texto: ");

$form->textField("Nombre", "name");
$form->textField("Nombre", "name8");
$form->textField("Nombre6", "name6", FH_STRING);
$form->textField("Nombre", "name7", FH_STRING ,"form-control-sm");
$form->textField("Nombre5", "name5", null, "form-control-sm",'onclick="alert(\'sopa de pollo\')"');
$form->textField("Nombre5", "name9", null, null,'onclick="alert(\'sopa de pollo\')"');
$form -> setHelpText('name', 'Nombre completo');
/*
// set a hidden field
$form -> hiddenField("language", "nl");

// a textfield
$form -> addLine("Campo de clave: ");
$form -> passField("Your password", "pass", _FH_PASSWORD);
// set the help message for the field 
$form -> setHelpText('pass', 'Ingrese la clave');
// addHTML! 
$form -> addHTML( 
  "<hr size='1' />" 
);

// textarea
$form -> addLine("Area de texto: ");
$form -> textArea("Descripcion", "message", _FH_TEXT);
$form -> setMaxLength("message", 30);

// Opciones de navegadores
$browsers = array(
    ""             => "-- Select --",
    "__LABEL(IE)__" => "Microsoft Internet Explorer",
    "msie3"         => "Microsoft Internet Explorer 3",
    "msie4"         => "Microsoft Internet Explorer 4",
    "msie5"         => "Microsoft Internet Explorer 5",
    "msie55"        => "Microsoft Internet Explorer 5.5",
    "msie6"         => "Microsoft Internet Explorer 6",
    "__LABEL(MO)__" => "Mozilla",
    "moz1"          => "Mozilla 1",
    "__LABEL(NN)__" => "Netscape Navigator",
    "nn3"           => "Netscape Navigator 3",
    "nn4"           => "Netscape Navigator 4",
    "nn6"           => "Netscape Navigator 5",
    "nn6"           => "Netscape Navigator 6",
    "nn7"           => "Netscape Navigator 7",
    "__LABEL(OP)__" => "Opera",
    "op3"           => "Opera 3",
    "op35"          => "Opera 3.5",
    "op4"           => "Opera 4",
    "op5"           => "Opera 5",
    "op6"           => "Opera 6",
    "op7"           => "Opera 7"
);

// Campo de seleccion
$form -> addLine("Campo de seleccion: ");
$form -> selectField("Navegadores", "browser1", $browsers);

//Checkbox variable
// Opciones for the checkbox
$animals = array(
  "Dog",
  "Cat",
  "Cow"
); 

// Checkbox
$form -> addLine("Seleccione: ");
$form -> checkBox("Animal Favorito", "animal", $animals, null, false); 

// opcione radiobutton
$gender = array(
  "m" => "Male",
  "f" => "Female"
); 


//Genero
$form -> addLine("Genero: ");
// make the radiobutton
$form -> radioButton("Gender", "gender", $gender);

//PRUEBA DE CARGA DE IMAGENES
// The upload configuration
// NOTE: You dont have to set every value!
// Like below, we have not set the "size", so the default configuration
// value is used (max size which is possible).
$cfg = array(
  "path"       => $_SERVER['DOCUMENT_ROOT'].dirname($_SERVER['PHP_SELF']).'/uploads/images',  
  "type"       => "jpg jpeg",
  "name"       => "", // <-- keep the original name
  "required"   => true,
  "exists"     => "rename"
);

// upload field
$form -> addLine("Cargue su imagen: ");
$form -> uploadField("Image", "image", $cfg);

// the values for the listfield
$values = array(
  1 => "PHP",
  2 => "MySQL database",
  3 => "Frontpage extensions",
  4 => "ASP",
  5 => "10 MB extra webspace",
  6 => "Webmail",
  7 => "Cronjobs"
); 

// the listfield
$form -> addLine("Listas: ");
$form->ListField("Products", "products", $values);


// make the editor  
 $config = array(
  "contentsCss" => "cms.css"
);
 
$form -> addLine("Editor de texto: ");
$form -> editor("Message", "message2", null, "images/uploads/");

// make the datefield 
$form -> addLine("Fecha de nacimiento: ");
$form -> dateField("Birthdate", "birthdate1");

// Datefield con calendario js
$form -> addLine("Fecha con JS: ");
$form -> jsdateField("Birthdate", "birthdate2");

// make the datefield
$form -> addLine("Fecha en texto: ");  
$form -> dateTextField("Birthdate", "birthdate3");

// make the datefield con js
$form -> addLine("Fecha en texto con JS: "); 
$form -> jsDateTextField("Birthdate", "birthdate4"); 

// a timefield 
$form -> timeField("Time", "time"); 


// make the browser field
$form->BrowserField('Image','image1', "/uploads/Image");

// a ColorPicker 
$form->colorpicker("Color", "colorselect"); 

// set the options array
$aOptions = array( 'Red', 'Green' );

// new TextSelect field
$form->TextSelectField( 'Color', 'color', $aOptions );


// a textfield
$form -> addLine("No muestra la imagen error");
$form->CaptchaField("Verify the code", "code");


//BOTONES

// the button 
$form -> button("Test", "btnTest", "onclick='alert(this.name)'"); 

// image button! 
$form -> imageButton("images/boton.png");

// the reset button 
$form -> resetButton(); 
// go to ../index.php when the button is pressed 
$form -> cancelButton("Cancel", "../index.php");

//back button
$form -> backButton("Atras", "Regresar");

// star for required fields 
$star = ' <font color="red">sopa</font>'; 

// some fields 
$form -> textField("Name".$star, "name1"); 
$form -> textField("Age".$star, "age"); 

// add a line that every field with a red * is required 
$form -> addLine($star); 


// some options used in the form 
$brow = array( 
  "IE"  => "Microsoft Internet Explorer", 
  "NN"  => "Netscape Navigator", 
  "MOZ" => "Mozilla", 
  "FF"  => "Firefox", 
  "OP"  => "Opera", 
  "-1"  => "Other..." 
);
// start a fieldset! 
//$form -> borderStart("Browser"); 



// browsers to select from 
$form -> radioButton("Select the browser you use", "browswer", $brow); 
// which version of the browser?  
$form -> textField("Version", "version"); 

// stop the border 
//$form -> borderStop();



// some fields 
$form -> textField("Name", "name3", _FH_STRING); 
$form -> textField("Age", "age3", _FH_INTEGER); 
$form -> selectField("Gender", "gender3", array('M', 'F'), null, false);

// a textfield + custom error message!!! 
$form -> textField("First Name", "fname", _FH_STRING); 
$form -> setErrorMessage( "fname", "You have to enter a first name!");

// the auto complete items 
$colors = array ( "red", "orange", "yellow", "green", "blue", "indigo", "violet", "brown", "rood" ); 
// the textfield used for auto completion 
$form -> textField("Type a color", "color2", _FH_STRING); 

// set the auto completion for the field Color 
$form -> setAutoComplete("color2", $colors); 

// the auto complete items 
$providers = array ( "hotmail.com", "live.com", "php-globe.nl", "freeler.nl" ); 
// the textfield used for auto completion after
$form -> textField("Type your email", "email", _FH_STRING); 

// set the auto completion for the field Color 
$form -> setAutoCompleteAfter("email", "@", $providers); 

//NEW PAGE
//Funciona, falta prueba por validaciones en el capcha y al cargar imagen

//first page... 
//$form -> textField("Question 1", "q1", _FH_STRING, 30, 50); 
//$form -> submitButton("Next page"); 

// second page 
//$form -> newPage(); 
//$form -> textArea("Question 2", "q2", _FH_TEXT); 
//$form -> submitButton("Next Page"); 

// third and last page 
//$form -> newPage(); 
//$form -> textField("Question 3", "q3", _FH_STRING);


//TABINDEX

// some fields + button
$form -> textField("Field 1", "fld1");
$form -> textField("Field 2", "fld2");
$form -> textField("Field 3", "fld3");
$form -> submitButton("Submit", "submitBtn");

// the tabs!
$tabs = array(
  3 => "fld1",
  1 => "fld2",
  2 => "fld3",
  4 => "submitBtn"
);

// set the tabs
$form -> setTabIndex($tabs); 

//No hay prueba debido a que debe crearse un archivo aparte con lenguaje y demas contenido
// set the language to dutch
$form -> setLanguage( 'nl' );

// a textfield  + submit button
$form -> textField    ("Your name", "name", FH_STRING);
$form -> submitButton ("Save"); 

//MENSAJE DE ERROR PRUEBA
//Mensaje de error para campos incorrectos
// textfield
$form -> textField("Name", "name25", FH_STRING);

// submitbutton
$form -> submitButton("Save");

// get the errors of invalid fields
$errors = $form->catchErrors();



// any errors?
if( sizeof($errors) > 0 ) 
{
    // create a JS message
    $msg = "Some fields are incorrect!\\n";

    foreach($errors as $field => $error) 
    {
        $msg .= "- ". $form -> getTitle( $field )."\\n";
    }
    echo
    "<script language='javascript'>\n".
    "alert('".$msg."');\n".
    "</script>\n";
}

// FOCUS
$form -> textField("Username", "username", FH_STRING);
$form -> passField("Password", "password", FH_PASSWORD);

// set the focus to the password
$form -> setFocus("password"); 




// set another type of mask 
//$form -> setMask( 
  //"  <tr><td>%title% %seperator%</td></tr>\n". 
  //"  <tr><td>%field% %error%</td></tr>\n", 
  //true  # repeat this mask! 
//); 
// set a mask for the upcoming field 
//$form -> setMask( 
  //"  <tr><td>%title%:</td></tr>\n". 
  //"  <tr><td>%field% %error%</td></tr>\n", 
  //1 # repeat it once (so for the upcoming 2 fields!!) 
//); 
*/

//button for submitting
$form->submitButton();



//the 'commit-after-form' function
function doRun($data) {
	echo "Hello " . $data['name'] . ", you are " . $data['age'] . " years old!";
}

