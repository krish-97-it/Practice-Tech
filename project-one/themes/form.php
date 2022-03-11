<form class="blc-popup-form" name="blc-popup-form" data-blc-mobile-form>
                            <div class="row">
                                <div class="col-sm-12 modal-form-field">
                                    <div class="row">
                                        <div class="col-sm-12 input-text">
                                            <input name="name" type="text" class="form-control name-input" id="name-input" placeholder="Name" data-error="Enter Your Name Correctly" 
                                            onchange="customValidation.nameValidation(this)" onblur="customValidation.nameValidation(this)">
                                        </div>
                                        <div class="col-sm-12 invalid_name"></div>
                                    </div>
                                </div>
                                <div class="col-sm-12 modal-form-field">
                                    <div class="row mobile-otp-row">
                                        <div class="col-sm-10 col-xs-9 phone-no-col">
                                            <div class="row">
                                                <div class="col-sm-12 input-text">
                                                    <input name="mobile" type="text" class="form-control name-input" id="name-input" placeholder="Mobile Number" data-error="Enter Your Name Correctly"
                                                    data-phone-number-input="" onchange="customValidation.phoneValidation(this)" onblur="customValidation.phoneValidation(this)" data-phone-number-input>
                                                </div>
                                                <div class="col-sm-12 form-group hidden" data-otp-input-field-voice-call-option="">
                                                    <div class="otp-input-field-voice-call-option">
                                                        <input name="otp" type="text" data-otp-number-input=""
                                                            class="form-control otp-input-field" placeholder="OTP" maxlength="4"
                                                            size="4" disabled selected="" required="">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 invalid_mobile"></div>
                                            </div>
                                        </div>
                                        <div class="col-sm-2 col-xs-3 otp-btn-col">
                                            <button type="button" class="otp-btn" data-send-otp>Send OTP</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-6 modal-form-field form-city-col">
                                    <select name="cityname" id="formCity" size="1" class="city-center city-field" 
                                        onchange="customValidation.cityValidation(this, '', 'selectcity')" onblur="customValidation.cityValidation(this,'', 'selectcity')" required>
                                        <option value="" disabled selected>City</option>
                                    </select>
                                    <div class="invalid_city"></div>
                                </div>
                                <div class="col-sm-6 col-xs-6 modal-form-field form-center-col">
                                    <select name="centername" id="formCenter" size="1" class="city-center center-field" 
                                        onchange="customValidation.centerValidation(this, '', 'selectcenter')" onblur="customValidation.centerValidation(this, '', 'selectcenter')" required>
                                        <option value="" disabled selected>Center</option>
                                    </select>
                                    <div class="invalid_center"></div>
                                </div>
                                <div class ="col-sm-12 col-xs-12 modal-form-field select-class-label">
                                    <div class="row">
                                        <div class="col-sm-4 col-xs-3 before-txt"><div class=text-line></div></div>
                                        <div class="col-sm-4 col-xs-6 selext-class-txt-area"><P class="select-class-txt">Select your class</p></div>
                                        <div class="col-sm-4 col-xs-3 after-txt"><div class=text-line></div></div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-xs-12 modal-form-field">
                                    <div class="row">
                                        <div class="col-sm-12 col-xs-12 class-name-btn">
                                            <ul class="class-btn">
                                                
                                                <li class="list-one">
                                                    <input type="radio" id="class-four" name="className" value="Class-4" checked="checked"/>
                                                    <label for="class-four">Class 4</label>
                                                </li>
                                            
                                                <li class="list-two">
                                                    <input type="radio" id="class-five" name="className" value="Class-5"/>
                                                    <label for="class-five">Class 5</label>
                                                </li>
                                            
                                                <li class="list-three">
                                                    <input type="radio" id="class-six" name="className" value="Class-6"/>
                                                    <label for="class-six">Class 6</label>
                                                </li>
                                            
                                                <li class="list-four">
                                                    <input type="radio" id="class-seven" name="className" value="Class-7" checked="checked"/>
                                                    <label for="class-seven">Class 7</label>
                                                </li>
                                            
                                                <li class="list-one">
                                                    <input type="radio" id="class-eight" name="className" value="Class-8" checked="checked"/>
                                                    <label for="class-eight">Class 8</label>
                                                </li>
                                            
                                                <li class="list-two">
                                                    <input type="radio" id="class-nine" name="className" value="Class-9"/>
                                                    <label for="class-nine">Class 9</label>
                                                </li>
                                            
                                                <li class="list-three">
                                                    <input type="radio" id="class-ten" name="className" value="Class-10"/>
                                                    <label for="class-ten">Class 10</label>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>