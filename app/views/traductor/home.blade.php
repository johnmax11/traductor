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
            <form id="formTranslatorAccount" action="#">
                <div>
                    <!--TODO -->
                    <h3>Account</h3>
                    <section>
                        <div>
                            <div>
                                <label for="userName">User name *</label>
                                <input id="userName" name="userName" type="text"  />
                            </div>
                            <div>
                                <label for="password">Password *</label>
                                <input id="password" name="password" type="password"  />
                            </div>
                            <div>
                                <label for="confirm">Confirm Password *</label>
                                <input id="confirm" name="confirm" type="password"  /> 
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
                                        <tbody>
                                            <tr><td>aaaa</td><td>bbbbb</td></tr>
                                            <tr><td>ccccc</td><td>fffff</td></tr>
                                            <input type="hidden" value="mivaluehidden">
                                        </tbody>
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
                                    <select>
                                        <option value="">Select languaje</option>
                                        <option value="1">IDIOMA 1</option>
                                        <option value="2">IDIOMA 2</option>
                                        <option value="3">IDIOMA 3</option>
                                    </select>
                                </div>
                                <div>
                                    <button>Add</button>
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
                                <select>
                                    <option value="">Select languaje</option>
                                    <option value="1">IDIOMA 1</option>
                                    <option value="2">IDIOMA 2</option>
                                    <option value="3">IDIOMA 3</option>
                                </select>
                            </div>
                            <div>
                                <button>Add</button>
                            </div>
                            <div>
                                <table>
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
                                    <button>Upload</button>
                                </div>
                            </div>
                            <div>
                                <div>
                                    <label>Your ID card</label>
                                </div>
                                <div>
                                    <button>Upload</button>
                                </div>
                            </div>
                            <div>
                                <div>
                                    <label>Relevant certificates</label>
                                </div>
                                <div>
                                    <button>Upload</button>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </form>    
        </div>
    </body>
</html>
@stop