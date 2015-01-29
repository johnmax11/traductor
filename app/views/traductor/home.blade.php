@extends('traductor.template.master')
@section ('content')
<body>
    <div id="container">
        <form id="formTranslatorAccount" action="#" enctype="multipart/form-data">
            <div>
                <h3>Passsword Update</h3>
                <section>
                        <div>
                            <div>
                                <label for="password">Password *</label>
                                <input id="password" name="password" type="password "/>
                            </div>
                            <div>
                                <label for="confirm">Confirm Password *</label>
                                <input id="confirm" name="confirm" type="password "/> 
                            </div>
                        </div>
                </section>
                <h3>Account Information</h3>
                <section>
                    <div>
                        <div>
                            <label for="firts_name">Firts name: </label>
                            <input type="text" id="first_name" name="first_name" class="required"/>
                        </div>
                        <div>
                            <label for="firts_midle_name">Firts middle name: </label>
                            <input type="text" id="first_middle_name" name="first_middle_name" />
                        </div>
                        <div>
                            <label for="last_name">last name: </label>
                            <input type="text" id="last_name" name="last_name" class="required" />
                        </div>
                        <div>
                            <label for="last_middle_name">last middle name: </label>
                            <input type="text" id="last_middle_name" class="last_middle_name" />
                        </div>
                        <div>
                            <label for="email_notf_1">Email notification 1: </label>
                            <input type="email" id="email_notf_1" class="required email" id="email_notf_1" />
                        </div>
                        <div>
                            <label for="email_notf_2">Email notification 2: </label>
                            <input type="email" id="email_notf_2" class="email" id="email_notf_2" />
                        </div>
                        <div>
                            <label for="phone_number_1">phone number 1: </label>
                            <input type="number" id="phone_number_1" class="required number" id="phone_number_1" />
                        </div>
                        <div>
                            <label for="phone_number_2">phone number 2: </label>
                            <input type="number" id="phone_number_2" class="number" id="phone_number_2" />
                        </div>
                        <div>
                            <label for="phone_number_mobile_1">cellphone number 1: </label>
                            <input type="number" id="phone_number_mobile_1" class="required number" id="phone_number_mobile_1" />
                        </div>
                        <div>
                            <label for="phone_number_mobile_2">cellphone number 2: </label>
                            <input type="number" id="phone_number_mobile_2" class="number" />
                        </div>
                    </div>
                </section>
                <h3>Languajes Skills</h3>
                <section>
                    <div>
                        <div>
                            <label for="nativeLanguaje">Your Native languaje</label>
                            <select id="nativeLanguaje" name="nativeLanguaje" class="required">
                                <option value="">Select languaje</option>
                            </select>
                            <hr />
                        </div>
                        <div>
                            <div>
                                <div>
                                    <label for="sourceLanguaje">Source language</label>
                                </div>
                                <div>
                                    <select id="sourceLanguaje" >
                                        <option value="">Select languaje</option>
                                    </select>
                                </div>
                            </div>
                            <div>
                                <div>
                                    <label for="targetLanguaje">Target language</label>
                                </div>
                                <div>
                                    <select id="targetLanguaje" >
                                        <option value="">Select languaje</option>
                                    </select>
                                </div>
                            </div>
                            <div>
                                <button id="addSourceAndTranslation">Add</button>
                            </div>
                            <div>
                                <table id="translationTable">
                                    <thead></thead>
                                    <tbody></tbody>
                                    <tfoot></tfoot>
                                </table>
                            </div>
                            <hr />
                        </div>
                        <div>
                            <div>
                                <label for="">Proofreading Skills</label>
                            </div>
                            <div>
                                <select id="proofreadingLanguaje">
                                    <option value="">Select languaje</option>
                                </select>
                            </div>
                            <div>
                                <button id="addProofreadingLenguaje">Add</button>
                            </div>
                            <div>
                                <table id="proofreadingTable">
                                    <thead></thead>
                                    <tbody></tbody>
                                    <tfoot></tfoot>
                                </table>
                            </div>
                            <hr />
                        </div>
                    </div>
                </section>
                <h3>Expertise</h3>
                <section>
                    <div>
                        <div>
                            <label>Expertise 
                                <span>Select up to 3</span> 
                            </label>
                        </div>
                        <div>
                            <select id="expertiseCombobox" name="expertiseCombobox" >
                                <option value="">Select languaje</option>
                            </select>
                        </div>
                        <div>
                            <button id="addExpertiseLenguaje">Add</button>
                        </div>
                        <div>
                            <table id="expertiseTable">
                                <thead></thead>
                                <tbody></tbody>
                                <tfoot></tfoot>
                            </table>
                        </div>
                    </div>
                </section>
                <h3>CV and certificates</h3>
                <section>
                    <div>
                        <div>
                            <label>CV and certificates</label>
                        </div>
                        <div>
                            <div>
                                <label>CV</label>
                            </div>
                            <div>
                                <input type="file" name="cv" multiple />
                            </div>
                        </div>
                        <div>
                            <div>
                                <label>Your ID card</label>
                            </div>
                            <div>
                                <input type="file" name="idCard" multiple />
                            </div>
                        </div>
                        <div>
                            <div>
                                <label>Relevant certificates</label>
                            </div>
                            <div>
                                <input type="file" name="relevantCertificates" multiple />
                            </div>
                        </div>
                        <div>
                            <div>
                                <label>Accreditation: </label>
                            </div>
                            <div>
                                <input type="text" name="accreditation" id="accreditation" />
                            </div>
                        </div>
                        <div>
                            <div>
                                <label>MemberShips</label>
                            </div>
                            <div>
                                <input type="text" name="memberShips" id="memberShips" />
                            </div>
                        </div>
                    </div>
                </section>
                <h3>About me</h3>
                <section>
                    <div>
                        <div>
                            <div>
                                <div id="photoUserTrasnlator"></div>
                            </div>
                            <div>
                                <input type="file" id="addPhotoTranslator" multiple />
                            </div>
                        </div>
                        <div>
                            <div>
                                <label for="">Years of experience</label>
                                <select name="yearsExp" id="yearsExp" />
                                    <option value="">Selection Experience</option>
                                </select>        
                            </div>
                            <div>
                                <label for="">Nacionality</label>
                                <select name="nacionality" id="nacionality" />
                                    <option value="">Selection nacionality</option>
                                </select>        
                            </div>
                        </div>
                        <div>
                            <div>
                                <label for="">Please enter a short bio (short professional experience description).</label>
                            </div>
                            <div>
                                <textarea name="descriptionTranslator" id="descriptionTranslator" cols="30" rows="10"></textarea>
                            </div>
                        </div>
                    </div>
                </section>
                <h3>Availability</h3>
                <section>
                        <div>
                            <div>
                                <select name="timeZone" id="timeZone">
                                    <option value="">Selection your Time Zone</option>
                                </select>
                            </div>
                            <div>
                                <select name="cityResidence" id="cityResidence">
                                    <option value="">Selection City</option>
                                </select>
                            </div>
                            <div>
                                <select name="countryResidence" id="countryResidence">
                                    <option value="">SlectionCoubtry</option>
                                </select>
                            </div>
                        </div>
                        <div>
                            <div>
                                <label for="">Availability days:</label>
                            </div>
                            <div>
                                <div>
                                    <label for="">Monday</label>
                                    <input type="checkbox" name="chkMonday" value="1" />
                                </div>
                                <div>
                                    <label for="">Tuesday</label>
                                    <input type="checkbox" name="chkTuesday" value="2" /> 
                                </div>
                                <div>
                                    <label for="">Wednesday</label>
                                    <input type="checkbox" name="chkWednesday" value="3" /> 
                                </div>
                                <div>
                                    <label for="">Thursday</label>
                                    <input type="checkbox" name="chkThursday" value="4" /> 
                                </div>
                                <div>
                                    <label for="">Friday</label>
                                    <input type="checkbox" name="chkFriday" value="5" /> 
                                </div>
                                <div>
                                    <label for="">Saturday</label>
                                    <input type="checkbox" name="chkSaturday" value="6" /> 
                                </div>
                                <div>
                                    <label for="">Sunday</label>
                                    <input type="checkbox" name="chkSunday" value="7" /> 
                                </div>
                            </div>
                        </div>
                        <div>
                            <div>
                                <label for="">Availability hours (in your time-zone): </label>
                            </div>
                            <div>
                                <div>
                                    <label for="08:00-16:00">08:00-16:00 </label>  
                                    <input id="08:00-16:00" type="checkbox" name="08:00-16:00" value="1" />
                                </div>
                                <div>
                                    <label for="16:00-24:00">16:00-24:00 </label>  
                                    <input id="16:00-24:00" type="checkbox" name="16:00-24:00" value="2" />
                                </div>
                                <div>
                                    <label for="24:00-08:00">24:00-08:00 </label>    
                                    <input id="24:00-08:00" type="checkbox" name="24:00-08:00" value="3" />
                                </div>
                            </div>
                        </div>
                </section>
                <h3>References</h3>
                <section>
                        <div>
                            <table>
                                <thead>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <input type="text" name="refereeName" />
                                        </td>
                                        <td>
                                            <input type="text" name="refereeName" />
                                        </td>
                                        <td>
                                            <input type="text" name="refereeName" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="text" name="refereeOrg" />
                                        </td>
                                        <td>
                                            <input type="text" name="refereeOrg" />
                                        </td>
                                        <td>
                                            <input type="text" name="refereeOrg" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="text" name="refereeEmail" />
                                        </td>
                                        <td>
                                            <input type="text" name="refereeEmail" />
                                        </td>
                                        <td>
                                            <input type="text" name="refereeEmail" />
                                        </td>
                                    </tr>
                                    </tbody>
                                <tfoot></tfoot>
                            </table>   
                        </div>
                </section>
                <h3>Software & Services</h3>
                <section>
                        <div>
                            <input type="checkbox" name="chkMonday" value="1" />
                        </div>
                </section>
                <h3>Social Networks</h3>
                <section>
                        <div>
                            <label for="">Skype </label>
                            <input type="text" name="Skype" id="txtSkype" />    
                        </div>
                        <div>
                            <label for="">NN1</label>
                            <input type="text" name="refereeOr" id="refereeOr" />    
                        </div>
                        <div>
                            <label for="">Linked In </label>
                            <input type="text" name="txtLinkedin" id="txtLinkedin" />    
                        </div>
                        <div>
                            <label for="">Yahoo! </label>
                            <input type="text" name="txtYahoo" id="txtYahoo" />    
                        </div>
                        <div>
                            <label for="">MSN</label>
                            <input type="text" name="txtMSN" id="txtMSN" />    
                        </div>
                        <div>
                            <label for="">proZ</label>
                            <input type="text" name="txtProZ" id="txtProZ" />    
                        </div>
                        <div>
                            <label for="">Twitter</label>
                            <input type="text" name="txtTwitter" id="txtTwitter" />    
                        </div>
                        <div>
                            <label for="">YouTube</label>
                            <input type="text" name="txtYoutube" id="txtYoutube" />    
                        </div>
                        <div>
                            <label for="">Google+</label>
                            <input type="text" name="txtGoogle+" id="txtGoogle+" />    
                        </div>
                        <div>
                            <label for="">Translator Cafe</label>
                            <input type="text" name="txtTranslatorCafe" id="txtTranslatorCafe" />    
                        </div>
                        <div>
                            <label for="">BeWords</label>
                            <input type="text" name="txtBeWords" id="txtBeWords" />    
                        </div>
                        <div>
                            <label for="">Online CV</label>
                            <input type="text" name="txtOnlineCV" id="txtOnlineCV" />    
                        </div>
                        <div>
                            <label for="">Profesional Website</label>
                            <input type="text" name="txtProfesionalWebsite" id="txtProfesionalWebsite" />    
                        </div>
                        <div>
                            <label for="">Personal Website</label>
                            <input type="text" name="txtPersonalWebsite" id="txtPersonalWebsite" />    
                        </div>
                        <div>
                            <label for="">Blog</label>
                            <input type="text" name="txtBlog" id="txtBlog" />    
                        </div>
                        <div>
                            <label for="">Others</label>
                            <input type="text" name="txtOthers" id="txtOthers" />    
                        </div>
                </section>
                <h3>Mailing Preferences</h3>
                <section>
                        <p>email</p>
                </section>
                <h3>Thanks</h3>
                <section>
                    <div>
                        
                    </div>
                </section>
            </div>
        </form>
    </div>    
@stop