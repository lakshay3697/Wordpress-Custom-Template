<?php /* Template Name: CustomForm */ ?>

<?php

get_header(); ?>

<div id="primary" class="content-area container">


  <div id="custom-form">
    <div class="tabnames-content">
      <ul class="nav nav-tabs invisible" id="sign-step-nav">
        <li class="active"><a data-toggle="tab" href="#tab-step-1">Get Details</a></li>
        <li><a data-toggle="tab" href="#tab-step-2">Verify OTP</a></li>
      </ul>
      <div class="tab-content">
        <div id="tab-step-1" class="tab-pane fade in active">
          <form action="#" id="form-step-1">
            <h1 class="text-center">Step 1 :- User Information Acquisition</h1>
            <hr>
            <div class="form-group">
              <label>Name</label>
              <input type="text" class="form-control" placeholder="Enter name" name="name" required>
            </div>
            <div class="form-group">
              <label>Email</label>
              <input type="email" class="form-control" placeholder="Enter email" name="email" required>
            </div>

            <div class="form-group">
              <label>Phone Number</label>
              <input type="text" class="form-control" placeholder="Enter phone number" name="pnumber" onkeypress="return isNumberKey(event)" required>
            </div>
            <button type="submit" class="btn btn-block btn-primary">Submit</button>
          </form>
        </div>
        <div id="tab-step-2" class="tab-pane fade">
          <form action="#" id="form-step-2">
            <h1 class="text-center">Step 2 :- Verify OTP</h1>
            <hr>
            <div class="form-group">
              <label>Enter OTP</label>
              <input type="text" class="form-control" name="otp" placeholder="Enter OTP received via mail" onkeypress="return isNumberKey(event)" required>
            </div>
            <input id="verify_user" type="text" class="form-control" name="user_verify" value="" hidden>
            <button type="submit" class="btn btn-block btn-primary">Continue</button>
          </form>
        </div>
      </div>
    </div>
  </div>



</div>

<?php get_footer(); ?>