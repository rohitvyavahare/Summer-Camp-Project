
function resetImg() {
$(':reset').on('click', function(){$('#fileImage')[0].src = '#' ;});
}

function changeFocus() {

    $('#haPhone').on('keypress', function() {
        if($('#haPhone').val().length == 2){
            $('#PInfo').find('input[name=home_prefix_phone]')[0].focus();
        }

    } );

    $('#hpPhone').on('keypress', function() {
        if($('#hpPhone').val().length == 2){
            $('#PInfo').find('input[name=home_phone]')[0].focus();
        }

    } );

    $('#caPhone').on('keypress', function() {
        if($('#caPhone').val().length == 2){
            $('#PInfo').find('input[name=cell_prefix_phone]')[0].focus();
        }

    } );

    $('#cpPhone').on('keypress', function() {
        if($('#cpPhone').val().length == 2){
            $('#PInfo').find('input[name=cell_phone]')[0].focus();
        }

    } );

    $('#saPhone').on('keypress', function() {
        if($('#saPhone').val().length == 2){
            $('#CInfo').find('input[name=prefix_phone]')[0].focus();
        }

    } );

    $('#spPhone').on('keypress', function() {
        if($('#spPhone').val().length == 2){
            $('#CInfo').find('input[name=phone]')[0].focus();
        }

    } );


}

// Checks if atleast one checkbox is selected.
var verifyCheckBoxes = function () {

    var checkboxes = $('#Programs');
    var inputs = checkboxes.find('input');
    var first = inputs.first()[0];

    inputs.on('change', function () {
        this.setCustomValidity('');
    });

    if(checkboxes.find('input:checked').length == 0) {
        first.setCustomValidity('Please choose atleast one program' );
    }
    else{
        first.setCustomValidity('');
    }
};

var validateNumericField = function (x, y) {

    if ($.isNumeric($(y).find(x)[0].value)) {
        $(y).find(x)[0].setCustomValidity('');
    }
    else {
        $(y).find(x)[0].setCustomValidity('Please enter Numeric value');
    }
};

var validatePhoneNumbers = function () {


    var threeDigits = ['input[name=home_area_phone]', 'input[name=home_prefix_phone]','input[name=cell_area_phone]', 'input[name=cell_prefix_phone]' ];

    for(var i=0; i< threeDigits.length; i++){
        if($('#PInfo').find(threeDigits[i])[0].value.length < 3){

            $('#PInfo').find(threeDigits[i])[0].setCustomValidity('Please enter 3 digits');
        }
        else{
            validateNumericField(threeDigits[i], '#PInfo');
        }
    }

    var cThreeDigits = ['input[name=area_phone]', 'input[name=prefix_phone]'];

    for(var i=0; i< cThreeDigits.length; i++){
        if($('#CInfo').find(cThreeDigits[i])[0].value.length < 3){

            $('#CInfo').find(cThreeDigits[i])[0].setCustomValidity('Please enter 3 digits');
        }
        else{
            validateNumericField(cThreeDigits[i],'#CInfo');
        }
    }

    var fourDigits = ['input[name=home_phone]','input[name=cell_phone]' ];

    for(var i=0; i< fourDigits.length; i++){
        if($('#PInfo').find(fourDigits[i])[0].value.length < 4){

            $('#PInfo').find(fourDigits[i])[0].setCustomValidity('Please enter 4 digits');
        }
        else{
            validateNumericField(fourDigits[i], '#PInfo');
        }
    }

    var cfourDigits = ['input[name=phone]'];

    for(var i=0; i< cfourDigits.length; i++){
        if($('#CInfo').find(cfourDigits[i])[0].value.length < 4){

            $('#CInfo').find(cfourDigits[i])[0].setCustomValidity('Please enter 4 digits');
        }
        else{
            validateNumericField(cfourDigits[i], '#CInfo');
        }
    }

};

var  validateZipLength = function (){
    if ($('#PInfo').find('input[name=zip]')[0].value.length != 5) {
        $('#PInfo').find('input[name=zip]')[0].setCustomValidity('Enter 5 digit zip');
    }
    else {
        validateNumericField('input[name=zip]','#PInfo');
        validatePhoneNumbers();
    }
};

var validateName = function () {
    var pname = ['input[name=fname]', 'input[name=mname]', 'input[name=lname]'];

    for(var i=0; i < pname.length; i++){
        if ( $('#PInfo').find(pname[i])[0].value.match('^[a-zA-Z]{2,16}$') == null ) {
            $('#PInfo').find(pname[i])[0].setCustomValidity('Please enter valid name');
        } else {
            $('#PInfo').find(pname[i])[0].setCustomValidity('');
        }
    }

    var name = [ 'input[name=cfname]', 'input[name=cmname]', 'input[name=clname]' ];

    for(var i=0; i < name.length; i++){
        if ( $('#CInfo').find(name[i])[0].value.match('^[a-zA-Z]{2,16}$') == null ) {
            $('#CInfo').find(name[i])[0].setCustomValidity('Please enter valid name');
        } else {
            $('#CInfo').find(name[i])[0].setCustomValidity('');
        }
    }
};

var validateTwoWords = function(nameField) {
    var name = nameField.value;
    var values = name.split(' ').filter(function(v){return v!==''});
    var count =0;
    if (values.length > 1) {
        nameField.setCustomValidity("");
        for(var v=0; v < values.length; v++){
            if(values[v].match('^[a-zA-Z]{2,16}$') == null ){
                nameField.setCustomValidity("Please Enter Valid Name (FirstName LastName)");
                count+=1;
            }
        }
        if(count < 0){
            nameField.setCustomValidity("");
        }
    } else {
        nameField.setCustomValidity("Please Enter Valid Name (FirstName LastName)");
    }
}
var validateAddressLength = function() {
    var addr = ['input[name=address]'];

    if ($('#PInfo').find('input[name=address]')[0].value.length < 5) {
        $('#PInfo').find('input[name=address]')[0].setCustomValidity('Enter at least 5 characters');
    }  else {
        $('#PInfo').find('input[name=address]')[0].setCustomValidity('');
    }

};

var validateCityLength = function() {
    var addr = ['input[name=city]'];

    if ($('#PInfo').find('input[name=city]')[0].value.length < 2) {
        $('#PInfo').find('input[name=city]')[0].setCustomValidity('Enter valid city name.');
    }  else {
        $('#PInfo').find('input[name=city]')[0].setCustomValidity('');
    }

};

var validateDate = function() {
	var dt=$('#CInfo').find('input[name=bday]')[0].value;
    if(isDate(dt)){
		if(!validateAgeRange(dt)){
			$('#CInfo').find('input[name=bday]')[0].setCustomValidity('Age group only from 7 to 12 is allowed');
		}else{
			$('#CInfo').find('input[name=bday]')[0].setCustomValidity('');
		}
    } else{
        $('#CInfo').find('input[name=bday]')[0].setCustomValidity('Please Enter valid date (mm/dd/yyyy)');
    }

};

var validateAgeRange = function(dt) {
	var dob=new Date(dt);
	var today=new Date();

    var age = Math.floor((today-dob) / (365.25 * 24 * 60 * 60 * 1000));
	if(age > 12 || age < 7){
		return false;
	}
	return true;
};

var isDate = function (txtDate)
{
    var currVal = txtDate;
    if(currVal == '')
        return false;

    var rxDatePattern = /^(\d{1,2})(\/|-)(\d{1,2})(\/|-)(\d{4})$/; //Declare Regex
    var dtArray = currVal.match(rxDatePattern); // is format OK?

    if (dtArray == null)
        return false;

    //Checks for mm/dd/yyyy format.
    dtMonth = dtArray[1];
    dtDay= dtArray[3];
    dtYear = dtArray[5];

    if (dtMonth < 1 || dtMonth > 12)
        return false;
    else if (dtDay < 1 || dtDay> 31)
        return false;
    else if ((dtMonth==4 || dtMonth==6 || dtMonth==9 || dtMonth==11) && dtDay ==31)
        return false;
    else if (dtMonth == 2)
    {
        var isleap = (dtYear % 4 == 0 && (dtYear % 100 != 0 || dtYear % 400 == 0));
        if (dtDay> 29 || (dtDay ==29 && !isleap))
            return false;
    }
    return true;
}


//file upload source
//http://stackoverflow.com/questions/12368910/html-display-image-after-selecting-filename


$(document).ready( function() {

    changeFocus();
	resetImg();
    $(':submit').on('click', doAll);

    $('#fileinput').on('change', function (){
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            $('#fileImage').show();
            reader.onload = function (e) {
                $('#fileImage')
                    .attr('src', e.target.result)
                    .width(225)
                    .height(125);
            };

            reader.readAsDataURL(this.files[0]);
        }
    });

    $('input').on('keypress', function() {
        $('#PInfo').find('input[name=zip]')[0].setCustomValidity('');
    });
});

var doAll = function (){
    verifyCheckBoxes();
    validateZipLength();
    validateName();
    validateAddressLength();
	validateCityLength();
    validateDate();
    validateTwoWords($('#CInfo').find('input[name=emeContactname]')[0]);
}
