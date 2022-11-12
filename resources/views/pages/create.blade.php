@extends('layouts.app_admin')
   
@section('content')
<style>
    
fieldset {
    border: 1px solid #912790;
    border-radius: 5px;
    padding: 15px;
    margin-bottom: 10px;
}

fieldset legend {
	text-align: center;
    color: #912790;
    border-radius: 1px;
    margin-left: 20px;
	float: none!important;
	width: auto;
	font-size: 16px;
}
</style>
<div class="container">
    <div class="row d-flex justify-content-center align-items-center">
        <div class="col-md-6">
            <form id="regForm" action="{{route('employee.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <h3 id="register">Employee Ragistration Form</h3>
                <div class="all-steps" id="all-steps"> <span class="step"></span> <span class="step"></span> <span class="step"></span> <span class="step"></span> </div>
                <div class="tab">
                    <h3 style="border-bottom: 2px solid #212529;">Employee Sign In</h3>
                    <div class="mb-3">
                        <label class="form-label" for="inputPassword">First Name</label>
                        <input type="test" class="form-control" id="firstname" name="first_name" placeholder="First Name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="inputPassword">Full Name</label>
                        <input type="test" class="form-control" id="fullname" name="full_name" placeholder="Full Name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="inputPassword">Email</label>
                        <input type="test" class="form-control" id="email" name="email" placeholder="Email" required>
                    </div>                    
                    
                    <div class="row">
                        <label class="form-label" for="inputPassword">Status</label>
                        <div class="col-12">
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" name="status" value="1" id="status" checked>
                                Active
                            </div>
                            <div class="form-check form-check-inline ms-3">
                                <input type="radio" class="form-check-input" value="0" name="status" id="status">
                                Inactive
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <input type="hidden" class="form-control" id="password" name="password" value="12345678" required>
                    </div>

                   
                </div>
                <div class="tab">
                    <h3 style="border-bottom: 2px solid #212529;">Employee Detail</h3>
                        <div class="mb-3">
                            <label class="form-label" for="inputPassword">Address</label>
                            <textarea name="address" class="form-control" id="" cols="30" rows="3"></textarea>
                            <!-- <input type="test" class="form-control" id="firstname" name="first_name" placeholder="First Name" required> -->
                        </div>
                        <div class="mb-3">
                            <label for="formFileMultiple" class="form-label">Phone</label>
                            <input class="form-control" type="text" name="phone" id="formFileMultiple" required/>
                        </div>
                        <div class="mb-3">
                            <label for="formFileMultiple" class="form-label">Photo</label>
                            <input class="form-control" type="file" name="photo" id="formFileMultiple" multiple />
                        </div>
                    </div>
                <div class="tab">
                    <h3 style="border-bottom: 2px solid #212529;">Employee Contact Information</h3>
                    <fieldset>
                        <div class="append-form">
                            <h4>Contact Person</h4>
                            <div class="copied-form contact-0">
                                <div class="mb-3">
                                    <label class="form-label" for="inputPassword">Name: </label>                        
                                    <input type="test" class="form-control" id="contact_name" name="contact_name[]" placeholder="Full Name" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="inputPassword">Phone: </label>                        
                                    <input type="test" class="form-control" id="contact_phone" name="contact_phone[]" placeholder="Phone" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="inputPassword">Email: </label>                        
                                    <input type="test" class="form-control" id="contact_email" name="contact_email[]" placeholder="Email" required>
                                </div>
                                <input type="hidden" value="0" id="key">
                                <input type="hidden" value="0" id="row_count">
                                <button type="button" class="btn btn-danger remove-more position-absolute text-center d-none">Remove</button>
                            </div>
                            <button type="button" class="btn btn-primary add-more  text-center"><i class="fa fa-plus"></i> Add More</button>
                        </div>                        
                    </fieldset> 
                </div>
                <div class="tab">
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox">
                            <label class="form-check-label">Agree for Submission</label>
                        </div>
                    </div>
                </div>

                <div class="thanks-message text-center" id="text-message"> <img src="{{asset('assets/images/success.png')}}" width="100" class="mb-4">
                    <h3>Thanks for your Submision!</h3>
                </div>
                <div style="overflow:auto;" id="nextprevious">
                    <div style="float:right;"> <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button> <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button> </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    //your javascript goes here
var currentTab = 0;
document.addEventListener("DOMContentLoaded", function(event) {
    showTab(currentTab);
});

function showTab(n) {
    var x = document.getElementsByClassName("tab");
    x[n].style.display = "block";
    if (n == 0) {
        document.getElementById("prevBtn").style.display = "none";
    } else {
        document.getElementById("prevBtn").style.display = "inline";
    }
    if (n == (x.length - 1)) {
        document.getElementById("nextBtn").innerHTML = "Submit";
    } else {
        document.getElementById("nextBtn").innerHTML = "Next";
    }
    fixStepIndicator(n)
}

function nextPrev(n) {
    var x = document.getElementsByClassName("tab");
    if (n == 1 && !validateForm()) return false;
    x[currentTab].style.display = "none";
    currentTab = currentTab + n;
    if (currentTab >= x.length) {
        document.getElementById('nextBtn').type = 'submit';
        document.getElementById("nextprevious").style.display = "none";
        document.getElementById("all-steps").style.display = "none";
        document.getElementById("register").style.display = "none";
        document.getElementById("text-message").style.display = "block";

    }
    showTab(currentTab);
}

function validateForm() {
    var x, y, i, valid = true;
    x = document.getElementsByClassName("tab");
    y = x[currentTab].getElementsByTagName("input");
    for (i = 0; i < y.length; i++) {
        if (y[i].value == "") {
            y[i].className += " invalid";
            valid = false;
        }
    }
    if (valid) { document.getElementsByClassName("step")[currentTab].className += " finish"; }
    return valid;
}

function fixStepIndicator(n) {
    var i, x = document.getElementsByClassName("step");
    for (i = 0; i < x.length; i++) { x[i].className = x[i].className.replace(" active", ""); }
    x[n].className += " active";
}

$('.remove-more:first').hide();
$(document).on('click', '.add-more', function (ev) {
   
   var row_count = $('#row_count').val();
   alert(row_count);
   
   row_count++;
//    $('#row_count').val(row_count);
 
 

       var formdata =   `<div class="copied-form contact-${row_count}">
                                <h4>Contact Person</h4>
                                <div class="mb-3">
                                    <label class="form-label" for="inputPassword">Name: </label>                        
                                    <input type="test" class="form-control" id="contact_name" name="contact_name[]" placeholder="Full Name" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="inputPassword">Phone: </label>                        
                                    <input type="test" class="form-control" id="contact_phone" name="contact_phone[]" placeholder="Phone" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="inputPassword">Email: </label>                        
                                    <input type="test" class="form-control" id="contact_email" name="contact_email[]" placeholder="Email" required>
                                </div>
                                <input type="hidden" value="${row_count}" id="key">
                                <input type="hidden" value="${row_count}" id="row_count-${row_count}">
                                <button type="button" class="btn btn-danger remove-more position-absolute text-center">Remove</button>
                            </div>
                            <button type="button" class="btn btn-primary add-more text-center" style="float:right;"><i class="fa fa-plus"></i> Add More</button></br></br>`;
                            
           

   // alert($formdata);
    $('.append-form').append($(formdata));
    // $clone.appendTo($('.append-form'));
    $('.remove-more').show();
    $(this).hide();
});
$(document).on('click', '.remove-more', function () {
    $(this).parent().remove();
});
</script>
@endsection