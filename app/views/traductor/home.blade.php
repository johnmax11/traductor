@extends('traductor.template.master')
@section ('content')
<!doctype html>
<html lang="en" class="no-js lt-ie9 lt-ie8 lt-ie7">
    <head>
        <meta charset="UTF-8">
        <title>Laravel PHP Framework</title>
    </head>
    <body>
        <div id="container">
            <form id="formTranslatorAccount" action="#" enctype="multipart/form-data">
                <div>
                    <!--TODO -->
                    <h3>Account</h3>
                    <section>
                        <div>
                            <div>
                                <label for="password">Password *</label>
                                <input id="password" name="password" type="password" />
                            </div>
                            <div>
                                <label for="confirm">Confirm Password *</label>
                                <input id="confirm" name="confirm" type="password" /> 
                            </div>
                        </div>
                    </section>
					<h3>Profile</h3>
					<section>
						<div>
							<div>
								<label for="firts_name">Firts name: </label>
								<input type="text" id="first_name" />
							</div>
							<div>
								<label for="firts_midle_name">Firts middle name: </label>
								<input type="text" id="first_middle_name" />
							</div>
							<div>
								<label for="last_name">last name: </label>
								<input type="text" id="last_name" />
							</div>
							<div>
								<label for="last_middle_name">last middle name: </label>
								<input type="text" id="last_middle_name">
							</div>
							<div>
								<label for="email_notf_1">Email notification 1: </label>
								<input type="text" id="email_notf_1">
							</div>
							<div>
								<label for="email_notf_2">Email notification 2: </label>
								<input type="text" id="email_notf_2">
							</div>
							<div>
								<label for="phone_number_1">phone number 1: </label>
								<input type="text" id="phone_number_1">
							</div>
							<div>
								<label for="phone_number_2">phone number 1: </label>
								<input type="text" id="phone_number_1">
							</div>
							<div>
								<label for="phone_number_mobile_1">cellphone number 1: </label>
								<input type="text" id="phone_number_mobile_1">
							</div>
							<div>
								<label for="phone_number_mobile_2">cellphone number 2: </label>
								<input type="text" id="phone_number_mobile_2">
							</div>
						</div>
					</section>
                    <h3>Languajes Skills</h3>
                    <section>
                        <div>
                            <div>
                                <label for="">Your Native languaje</label>
                                <select id="nativeLanguaje">
                                    <option value="">Select languaje</option>
                                    <option value="1">IDIOMA 1</option>
                                    <option value="2">IDIOMA 2</option>
                                    <option value="3">IDIOMA 3</option>
                                </select>
                                <hr /> 
                            </div>
                            <div>
                                <div>
                                    <div>
                                        <label for="">Source language</label>
                                    </div>
                                    <div>
                                        <select id="sourceLanguaje">
                                            <option value="">Select languaje</option>
                                            <option value="1">IDIOMA 1</option>
                                            <option value="2">IDIOMA 2</option>
                                            <option value="3">IDIOMA 3</option>
                                        </select>
                                    </div>
                                </div>
                                <div>
                                    <div>
                                        <label for="">Target language</label>
                                    </div>
                                    <div>
                                        <select id="targetLanguaje">
                                            <option value="">Select languaje</option>
                                            <option value="1">IDIOMA 1</option>
                                            <option value="2">IDIOMA 2</option>
                                            <option value="3">IDIOMA 3</option>
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
                                        <option value="1">IDIOMA 1</option>
                                        <option value="2">IDIOMA 2</option>
                                        <option value="3">IDIOMA 3</option>
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
                                <select id="expertiseCombobox">
                                    <option value="">Select languaje</option>
                                    <option value="1">IDIOMA 1</option>
                                    <option value="2">IDIOMA 2</option>
                                    <option value="3">IDIOMA 3</option>
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
                        </div>
                    </section>
                    <h3></h3>
                    <section>
                    	
                    </section>
                    <h3></h3>
                    <section>
                    	
                    </section>
                    <h3></h3>
                    <section>
                    	
                    </section>
                    <h3></h3>
                    <section>
                    	
                    </section>
                    <h3></h3>
                    <section>
                    	
                    </section>
                </div>
            </form>    
        </div>
    </body>
</html>
@stop